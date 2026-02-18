/**
 * Initialize the Swiper.js slider for the frontend.
 */
document.addEventListener('DOMContentLoaded', function () {
    const swiper = new Swiper('.ci-main-slider', {
        loop: true,
        speed: 800, // Smooth transition
        autoplay: {
            delay: 4000, // 4 seconds per slide
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});