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
} );