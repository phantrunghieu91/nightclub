document.addEventListener( 'DOMContentLoaded', () => {
  const imageCarouselController = {
    init () {
      const swiperContainerEls = [ ...document.querySelectorAll( '.image-carousel' ) ];
      if ( swiperContainerEls.length === 0 || typeof Swiper === 'undefined' ) {
        return;
      }
      this.swipers = [];

      swiperContainerEls.forEach( swiperContainer => {
        const swiperEl = swiperContainer.querySelector('.swiper');
        const prevEl = swiperContainer.querySelector('.jins-swiper-nav-btn__prev');
        const nextEl = swiperContainer.querySelector('.jins-swiper-nav-btn__next');
        const options = {
          slidesPerView: 1,
          spaceBetween: 10,
          navigation: { prevEl, nextEl },
          breakpoints: {
            550: {
              slidesPerView: 2,
              spaceBetween: 20,
            },
            850: {
              slidesPerView: swiperContainer.classList.contains( 'menu' ) ? 4 : 3,
              spaceBetween: 20,
            }
          }
        };
        this.swipers.push( new Swiper( swiperEl, options ) );
      } );

      this.initFancyBox();
    },
    initFancyBox() {
      if( typeof Fancybox === 'undefined' ) {
        return;
      }
      Fancybox.bind('[data-fancybox]', {
        Thumbs: { type: 'classic', }
      });
    }
  };
  imageCarouselController.init();

  const otherClubsCarouselController = {
    init() {
      const swiperEl = document.querySelector('.other-clubs .swiper');
      if( !swiperEl || typeof Swiper === 'undefined' ) {
        return;
      }
      this.swiper = new Swiper( swiperEl, {
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
          prevEl: swiperEl.querySelector('.jins-swiper-nav-btn__prev'),
          nextEl: swiperEl.querySelector('.jins-swiper-nav-btn__next'),
        },
        breakpoints: {
          550: {
            slidesPerView: 2,
          },
          850: {
            slidesPerView: 3,
          }
        } 
      });
    }
  };
  otherClubsCarouselController.init();
} );