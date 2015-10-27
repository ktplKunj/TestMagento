define([
    'jquery',
    'Ktpl_Slider/js/jquery-cycle2-min',
    'Ktpl_Slider/js/jquery-cycle2-swipe-min'
], function($, $t) {
    $('.slideshow-container .slideshow').cycle({
        slides: '> li',
        pager: '.slideshow-pager',
        pagerTemplate: '<span class="pager-box"></span>',
        speed: 600,
        pauseOnHover: true,
        swipe: true,
        prev: '.slideshow-prev',
        next: '.slideshow-next',
        fx: 'scrollHorz'
    });

});
