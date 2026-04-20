jQuery(window).on('elementor/frontend/init', function () {
    const addSwiper = function ($scope) {
        const $carousel = $scope.find('.testi-wrap');
        if (!$carousel.length) return;

        // Elementor provides Swiper via 'elementorFrontend.utils.swiper' or global 'Swiper'
        const SwiperClass = (typeof elementorFrontend.utils.swiper === 'function') ? elementorFrontend.utils.swiper : Swiper;

        if (!SwiperClass) {
            console.warn('Swiper not found, retrying...');
            setTimeout(() => addSwiper($scope), 500);
            return;
        }

        const runInit = () => {
            new SwiperClass($carousel[0], {
                slidesPerView: 'auto',
                spaceBetween: 180,
                loop: true,
                centeredSlides: true,
                speed: 800,
                grabCursor: true,
                watchSlidesProgress: true,
                navigation: {
                    prevEl: $scope.find('.nav-prev')[0],
                    nextEl: $scope.find('.nav-next')[0],
                },
                breakpoints: {
                    // Adjust if needed for smaller screens
                    768: {
                        spaceBetween: 60
                    },
                    1024: {
                        spaceBetween: 90
                    },
                    1200: {
                        spaceBetween: 180
                    }
                }
            });
        };

        setTimeout(runInit, 300);
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/am_home_testimonials.default', addSwiper);
});
