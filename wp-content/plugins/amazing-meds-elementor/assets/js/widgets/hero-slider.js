jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/am_hero.default', function ($scope) {
        const $main = $scope.find('.am-hero-main-slider');
        const $thumbs = $scope.find('.am-hero-thumbs-slider');

        if (!$main.length || !$thumbs.length) return;

        // Clean up previous instances
        if ($main[0].swiper) $main[0].swiper.destroy(true, true);
        if ($thumbs[0].swiper) $thumbs[0].swiper.destroy(true, true);

        const initSliders = () => {
            // Check if container is actually visible and has width
            if ($main.width() === 0) {
                setTimeout(initSliders, 100);
                return;
            }

            const thumbSlider = new Swiper($thumbs[0], {
                spaceBetween: 12,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesProgress: true,
                observer: true,
                observeParents: true,
                resizeObserver: true,
                centerInsufficientSlides: true,
            });

            const mainSlider = new Swiper($main[0], {
                spaceBetween: 0,
                effect: 'fade',
                speed: 400,
                fadeEffect: {
                    crossFade: true
                },
                thumbs: {
                    swiper: thumbSlider,
                },
                observer: true,
                observeParents: true,
                resizeObserver: true,
                updateOnWindowResize: true,
            });

            $scope.on('remove', () => {
                thumbSlider.destroy(true, true);
                mainSlider.destroy(true, true);
            });
        };

        // Small delay to ensure Elementor has rendered the containers
        setTimeout(initSliders, 250);
    });
});
