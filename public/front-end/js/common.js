$(document).ready(function(){
 
  var pushLeftBtn = $('#btn-menu-mobile');
  var pushRightBtn = $('#btn-discover');
  pushLeftBtn.on('click', function(e) {
    $('#menu-mobile').addClass('is-active');
    $('#review-wrapper').removeClass('is-active');
    $('#c-mask').addClass('is-active');
    $('body').addClass('overflow-hidden');
    e.preventDefault;
  });
  $('#c-mask').on('click',function() {
    $('#menu-mobile').removeClass('is-active');
    $('#login-wrapper').removeClass('is-active');
    $('#review-wrapper').removeClass('is-active');
    $('#c-mask').removeClass('is-active');
    $('body').removeClass('overflow-hidden');
  });
  pushRightBtn.on('click', function(e) {
    $('#search-mobile').addClass('is-active');
    $('#review-wrapper').removeClass('is-active');
    $('#menu-mobile').removeClass('is-active');
    $('#c-mask').removeClass('is-active');
    $('body').addClass('overflow-hidden');
    e.preventDefault;
  });
  $('.news-slider').slick({
    dots: false,
    autoplay: true,
    autoplaySpeed: 5000,
    arrows: true,
    infinite: true,
    speed: 500,
    fade: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    variableWidth: true
  });
  $('.btn-menu-display').on('click', function(e) {
    $(this).toggleClass('expanded');
    $('aside').toggleClass('expanded');
    $('.main-wrapper header').toggleClass('side-expanded');
    $('.main-wrapper').toggleClass('side-expanded');
    $('.header-menu').toggleClass('side-expanded');
  });
  $('.search-mobile').on('click', function(e) {
    $('.main-wrapper form').toggleClass('open');
    $('.c-mask').toggleClass('show');
    $(this).toggleClass('close');
    $('.upload-video').toggleClass('hide');
    $('.notification').toggleClass('hide');
  });
  $('.c-mask').on('click', function(e) {
    $(this).removeClass('show');
    $('.main-wrapper form').removeClass('open');
    $('.upload-video').removeClass('hide');
    $('.notification').removeClass('hide');
  });
})