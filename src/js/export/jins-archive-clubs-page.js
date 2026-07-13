document.addEventListener( 'DOMContentLoaded', () => {
  const clubsController = {
    REST_URL: `${wpApiSettings.root}wp/v2/clubs`,
    PREV_TEXT: '<i class="fa-solid fa-angle-left"></i>',
    NEXT_TEXT: '<i class="fa-solid fa-angle-right"></i>',
    DEFAULT_QUERY: {
      _embed: 'wp:featuredmedia',
      per_page: jins_settings.per_page ?? 10,
      page: 1,
    },
    async init () {
      try {
        if( typeof jins_settings === 'undefined' ) {
          throw new Error('Settings is missing!');
        }
        this.cacheElements();
        this.initializeControllerState();

        this.formEl.addEventListener('submit', this.handleFilter.bind(this));
        this.clubsPagination.addEventListener('click', this.handlePagination.bind(this));

        // Render clubs list first time page load
        const clubs = await this.fetchClubs();

        if( clubs !== null ) {
          this.renderClubsList( clubs );
        }
      } catch ( error ) {
        console.warn( 'CLUBS FILTER ERROR: ', error );
      }
    },
    cacheElements() {
      this.formEl = document.querySelector( '.clubs-filter' );
      if ( !this.formEl ) {
        throw new Error( 'Can NOT find clubs filter form!' );
      }
      this.formMessageEl  = this.formEl.querySelector( '.clubs-filter__message' );
      this.formSubmitBtn  = this.formEl.querySelector( '.jins-button' );
      this.formSubmitBtnText = this.formSubmitBtn.querySelector('.jins-button__text');

      this.clubsSectionEl = document.querySelector('section.clubs-content');
      if ( !this.clubsSectionEl ) {
        throw new Error( 'Can NOT find clubs list section!' );
      }
      this.clubsListEl = this.clubsSectionEl.querySelector('.clubs-content__list');
      this.clubCardTemplateEl = this.clubsSectionEl.querySelector('#club-card-template');
      this.clubsPagination = this.clubsSectionEl.querySelector('.pagination');
      this.clubsPaginationNavLinks = this.clubsPagination.querySelector('.nav-links');
    },
    initializeControllerState() {
      this.initState = {
        btnText: String(this.formSubmitBtnText.textContent).trim(),
        currentPage: 1,
        maxPages: 1,
        totalClubs: 0,
        queryParams: new URLSearchParams(this.DEFAULT_QUERY).toString(),
        message: {
          status: 'info',
          text: '',
        },
      };

      this.controllerState = new Proxy( {...this.initState}, {
        set: async ( target, prop, newValue ) => {
          switch( prop ) {
            case 'message':
              target[ prop ] = newValue;
              this.renderMessage( newValue );
              break;
            case 'maxPages':
            case 'currentPage':
              target[ prop ] = newValue;
              this.renderPagination();
              break;
            case 'queryParams':
              if( target[prop] === newValue ) {
                this.isFetching( false );
                break;
              }
              target[ prop ] = newValue;
              this.isFetching( true );

              const clubs = await this.fetchClubs();
              if( clubs !== null ) {
                this.renderClubsList( clubs );
              }

              this.isFetching( false );
              break;
            default:
              target[ prop ] = newValue;
              break;
          }
          
          return true;
        }
      } );
    },
    async fetchClubs () {
      this.abortCtrl?.abort();
      this.abortCtrl = new AbortController();
      try {
        if( this.controllerState.message.text !== '' ) {
          this.controllerState.message = { ...this.initState.message };
        }

        const res = await fetch( `${this.REST_URL}?${this.controllerState.queryParams}`, { signal: this.abortCtrl.signal } );
        if( ! res.ok ) {
          throw new Error(`Error while fetching data [${res.status}]: ${res.statusText}` );
        }

        const totalPages = parseInt( res.headers.get('X-WP-TotalPages'), 10) || 1;
        const total = parseInt( res.headers.get('X-WP-Total'), 10) || 0;
        if( totalPages != this.controllerState.maxPages ) {
          this.controllerState.maxPages = totalPages;
        }
        if( total != this.controllerState.totalClubs ) {
          this.controllerState.totalClubs = total;
        }
        return await res.json();
      } catch ( error ) {
        if ( error.name === 'AbortError' ) return null;
        console.warn( 'CLUBS FILTER FETCHING ERROR: ', error );
        this.controllerState.message = { text: jins_settings.messages.QUERY_ERROR, status: 'error' };
        return [];
      }
    },
    isFormDataEmpty ( formData ) {
      for ( const value of formData.values() ) {
        if ( value !== null && value !== undefined && String( value ).trim() !== '' ) {
          return false;
        }
      }
      return true;
    },
    isFetching ( state = true ) {
      this.clubsPagination.ariaBusy = state;

      if( ! state && this.formSubmitBtnText.textContent !== this.controllerState.btnText ) {
        this.formSubmitBtn.disabled = state;
        this.formSubmitBtnText.textContent = this.controllerState.btnText;
      }
    },
    renderMessage ( { text, status } ) {
      this.formMessageEl.removeAttribute( 'data-status' );
      if( text !== '' ) {
        this.formMessageEl.setAttribute( 'data-status', status );
        this.formMessageEl.textContent = text;
      }
    },
    getClubCardFragment() {
      if( ! this.clubCardTemplateEl ) {
        throw new Error( 'Can NOT find club card template!' );
      }
      return this.clubCardTemplateEl?.content.cloneNode(true);
    },
    getClubImageData( club, preferredSize = 'medium_large' ) {
      const media = club._embedded?.['wp:featuredmedia']?.[0];

      if( !media || !media.source_url ) {
        return { src: jins_settings.PLACEHOLDER_IMAGE_URL, alt: '' };
      }

      const sizes = media.media_details.sizes ?? {};
      return { 
        src: sizes[preferredSize]?.source_url ?? sizes.full?.source_url ?? media.source_url,
        alt: media.alt_text,
      }
    },
    renderClubsList( clubs ) {
      try {
        if( !this.clubsListEl ) {
          throw new Error( 'Can NOT find clubs list element!' );
        }
        
        this.clubsListEl.innerHTML = '';

        if( clubs.length === 0 ) {
          const notFoundParagraph = document.createElement('p');
          notFoundParagraph.textContent = jins_settings.messages.NO_CLUBS_FOUND;
          this.clubsListEl.append(notFoundParagraph);
          return;
        }

        const clubsFrag = new DocumentFragment();

        clubs.forEach( club => {
          const clubCardEl = this.generateClubCard( club );

          clubsFrag.appendChild( clubCardEl );
        } );

        this.clubsListEl.append( clubsFrag );

      } catch( error ) {
        console.warn( 'CLUBS LIST RENDER ERROR: ', error );
      }
    },
    generateClubCard( club ) {
      const clubCardFragment = this.getClubCardFragment();
      const clubMedia = this.getClubImageData( club );
      
      const clubCard = clubCardFragment.querySelector('.jins-card');
      const thumbnailLink = clubCard.querySelector('.jins-card__thumbnail');
      const thumbnailImg = thumbnailLink.querySelector('img');
      const titleLink = clubCard.querySelector('.jins-card__title > a');
      const excerpt = clubCard.querySelector('.jins-card__excerpt');

      club.class_list?.length > 0 && clubCard.classList.add( ...club.class_list );
      thumbnailLink.href = club.link;
      titleLink.href = club.link;
      titleLink.textContent = club.title.rendered;
      excerpt.innerHTML = club.excerpt.rendered;
      thumbnailImg.src = clubMedia.src;
      thumbnailImg.alt = clubMedia.alt ?? club.title.rendered;

      return clubCard;
    },
    renderPagination() {
      this.clubsPaginationNavLinks.innerHTML = '';
      if( this.controllerState.maxPages === 1 ) {
        this.clubsPagination.setAttribute('aria-hidden', 'true');
        return;
      } else {
        this.clubsPagination.removeAttribute('aria-hidden');
      }

      const paginationFrag = new DocumentFragment();

      if( this.controllerState.currentPage > 1 ) {
        const prevBtn = this.generatePaginationItem( this.controllerState.currentPage - 1, true, this.PREV_TEXT );
        paginationFrag.appendChild( prevBtn );
      }
      for( let i = 1; i <= this.controllerState.maxPages; i++ ) {
        const item = this.generatePaginationItem( i );
        paginationFrag.appendChild(item);
      }
      if( this.controllerState.currentPage < this.controllerState.maxPages ) {
        const nextBtn = this.generatePaginationItem( this.controllerState.currentPage + 1, true, this.NEXT_TEXT );
        paginationFrag.appendChild( nextBtn );
      }
      this.clubsPaginationNavLinks.append( paginationFrag );
    },
    generatePaginationItem( pageNumber, isNotNumber = false, text = '' ) {
      const isCurrent = pageNumber === this.controllerState.currentPage;
      const item = document.createElement( isCurrent ? 'span' : 'a' );
      item.classList.add('page-numbers');

      item.innerHTML = isNotNumber ? text : pageNumber;

      if( isCurrent ) {
        item.classList.add('current');
        item.ariaCurrent = 'page';
      } else {
        item.href = 'javascript:void(0);';
        item.dataset.page = pageNumber;
      }
      return item;
    },
    handleFilter ( event ) {
      event.preventDefault();
      this.formSubmitBtn.disabled = true;
      this.formSubmitBtnText.textContent = jins_settings.messages.FILTERING_TEXT;

      const formData = new FormData( this.formEl );
      if ( this.isFormDataEmpty( formData ) ) {
        this.isFetching( false );
        this.controllerState.message = { ...this.controllerState.message, text: jins_settings.messages.NO_FILTER_SELECTED };
        return;
      }
      const query = new URLSearchParams(this.DEFAULT_QUERY);
      for( const [key, value] of formData.entries() ) {
        if ( value !== 'all' && value !== null && value !== undefined && String( value ).trim() !== '' ) {
          query.append(key, value);
        };
      }
      this.controllerState.queryParams = query.toString();
      this.controllerState.currentPage = 1;
    },
    handlePagination( event ) {
      const target = event.target;
      if( target.closest('span') ) {
        return;
      }
      const page = parseInt(target.dataset.page, 10);
      if( Number.isNaN(page)) return;

      this.controllerState.currentPage = page;
      const query = new URLSearchParams( this.controllerState.queryParams );
      query.set('page', page);
      this.controllerState.queryParams = query.toString();
    }
  };
  clubsController.init();
} );