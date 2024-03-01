/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************************************!*\
  !*** ./resources/js/pages/product-filter-range.init.js ***!
  \*********************************************************/
/*
Template Name: Borex - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Property list filter init js
*/
var slider = document.getElementById('priceslider');
noUiSlider.create(slider, {
  start: [250, 800],
  connect: true,
  tooltips: true,
  range: {
    'min': 1,
    'max': 1000
  }
}); // slider

var swiper = new Swiper(".slider", {
  nextButton: '.swiper-button-next',
  prevButton: '.swiper-button-prev',
  autoplay: {
    delay: 2000
  },
  loop: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  },
  breakpoints: {
    768: {
      slidesPerView: 1
    },
    1024: {
      slidesPerView: 1
    }
  }
});
/******/ })()
;