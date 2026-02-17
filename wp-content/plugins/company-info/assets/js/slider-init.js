document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.ci-main-slider', {
        loop: true,
        pagination: {el: '.swiper-pagination'},
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {delay: 5000},
    });
});