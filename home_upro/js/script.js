jQuery(document).ready(function ($) {


  /*upload foto*/

  /*if($('.dropzone').length > 0){
    Dropzone.autoDiscover = false;
    $("#dZUpload").dropzone({
      url: "/img",
      addRemoveLinks: true,

    });
  }*/

  /*popup*/
  $(".fancybox-scroll").fancybox({
    touch:false,
    autoFocus:false,
    beforeShow: function () {
      $(".popup-scroll .form-select").niceScroll("ul",{
        cursorcolor: "#7B93FF",
        cursorwidth: "16px",
        cursorborder: "0 solid #7B93FF",
        horizrailenabled: false,
        autohidemode: "scroll",
        cursoropacitymin: 1,
        railpadding: { top: 0, right: 0, left: 0, bottom: 0 },
        zindex: 9999999,
        cursorborderradius: "16px",
        background: "#D9D9D9",
      });

      $(".popup-select .form-select").getNiceScroll().resize();
      $('html').addClass('no-scroll');
    },
    afterShow: function () {
      $(".popup-select .form-select").getNiceScroll().resize();
    },
    afterClose:function () {
      $('html').removeClass('no-scroll');
    }
  });

  $(".fancybox").fancybox({
    touch:false,
    autoFocus:false,
    beforeShow: function () {
      $('html').addClass('no-scroll');
    },
    afterClose:function () {
      $('html').removeClass('no-scroll');
    }

  });

  /*number item +/-*/
  $(".btn-count-plus").click(function () {
    var e = $(this).parent().find("input");
    return e.val(parseInt(e.val()) + 1), e.change(), !1
  }), $(".btn-count-minus").click(function () {
    var e = $(this).parent().find("input"), t = parseInt(e.val()) - 1;
    return t = t < 1 ? 0 : t, e.val(t), e.change(), !1
  });

  /*autocomplete*/
  $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "Java2",
      "Java3",
      "Java4",
      "Java5",
      "Java6",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( ".street" ).autocomplete({
      source: availableTags
    });
  });


  /*open filter*/
  $(document).on('click', '.filter-btn', function (e){
    e.preventDefault();
    $(this).toggleClass('is-open');
    if($(this).hasClass('is-open')){
      $('.full-filter').slideDown();
    }else{
      $('.full-filter').slideUp();
    }
  });

  /*add like*/
  /*$(document).on('click', '.like-item a', function (e){
    e.preventDefault();
    let itemLike = $(this).parent('.like-item'),
        item = $(this).closest('.item-home');
    if(itemLike.hasClass('is-like')){
      itemLike.removeClass('is-like')
    }else{
      $('.send-block').removeClass('is-active').slideUp();
      item.find('.like-block').slideDown();
      setTimeout(function() {
        item.find('.like-block').addClass('is-active')
      }, 1000);
    }
  });*/

  /* send product*/
  $(document).on('click', '.btn-send', function (e){
    e.preventDefault();
    let item = $(this).closest('.text-wrap').find('.send-block');

    item.slideDown();
    setTimeout(function() {
      item.addClass('is-active')
    }, 1000);
  });

  /*close active block product item*/
  $(document).on('click', '.close-wrap a', function (e) {
    e.preventDefault();
    $(this).closest('.block-active').removeClass('is-active').slideUp();
  });








  /*open info block*/
  $(document).on('click', '.btn-info', function (e){
    e.preventDefault();

    $('.home-block .block-active').removeClass('is-active');
    $('.send-block').slideUp();

    let item = $(this).closest('.item-home');
    item.find('.send-block').slideDown();
    setTimeout(function() {
      item.find('.send-block').addClass('is-active')
    }, 1000);
  });


  /*open info block*/
  $(document).on('click', '.btn-create', function (e){
    e.preventDefault();
    let item = $(this).closest('.item-home');
    $('.send-block').removeClass('is-active').slideUp();
    item.find('.like-block').slideDown();
    setTimeout(function() {
      item.find('.like-block').addClass('is-active')
    }, 1000);
  });





  /*open info block*/
  $(document).on('click', '.btn-user', function (e){
    e.preventDefault();
    let item = $(this).closest('.item-user');
    item.find('.send-block').slideDown();
    setTimeout(function() {
      item.find('.send-block').addClass('is-active')
    }, 1000);
  });









  /*cuttr text*/
  $('.item-home .text-wrap .text-info p').Cuttr({
    truncate: 'words',
    length: 17
  });

  $('.item-home .text-info').Cuttr({
    truncate: 'words',
    length: 25
  });

  /*sliders*/
  var swiperMini = new Swiper(".mini-slider", {
    /*loop: true,*/
    spaceBetween: 10,
    slidesPerView: 6,
    freeMode: true,
    watchSlidesProgress: true,
    direction: "vertical",
  });
  var swiperBig = new Swiper(".big-slider", {
    /*loop: true,*/
    spaceBetween: 10,

    thumbs: {
      swiper: swiperMini,
    },
  });


//TABS
  (function($){
    jQuery.fn.lightTabs = function(options){

      var createTabs = function(){
        tabs = this;
        i = 0;

        showPage = function(i){
          $(tabs).find(".tab-content").children("div").hide();
          $(tabs).find(".tab-content").children("div").eq(i).show();
          $(tabs).find(".tabs-menu").children("li").removeClass("is-active");
          $(tabs).find(".tabs-menu").children("li").eq(i).addClass("is-active");
        }

        showPage(0);

        $(tabs).find(".tabs-menu").children("li").each(function(index, element){
          $(element).attr("data-page", i);
          i++;
        });

        $(tabs).find(".tabs-menu").children("li").click(function(){
          showPage(parseInt($(this).attr("data-page")));
        });
      };
      return this.each(createTabs);
    };
  })(jQuery);
  $(".tabs").lightTabs();



  /*edit img account*/
  $(document).on('click', '.btn-edit-img a', function (e){
    e.preventDefault();
    $(this).toggleClass('is-active');
    if($(this).hasClass('is-active')){
      $(this).closest('.img-wrap').find('.user-photo').hide();
      $(this).closest('.img-wrap').find('.dropzone').show();
    }else{
      $(this).closest('.img-wrap').find('.user-photo').show();
      $(this).closest('.img-wrap').find('.dropzone').hide();
    }

  });


  /* edit tel account*/
  /*$(document).on('click', '.btn-edit-tel', function (e){
    e.preventDefault();
    $(this).toggleClass('is-active');
    if($(this).hasClass('is-active')){
      $(this).closest('.text-wrap').find('input').prop("disabled",false);
    }else{
      $(this).closest('.text-wrap').find('input').prop("disabled",true);
    }

  });*/

  //open info
  $(document).on('click', '.show-more', function (e){
    e.preventDefault();
    $(this).toggleClass('is-open');
    if($(this).hasClass('is-open')){
      $(this).siblings('.wrap').slideDown();
    }else{
      $(this).siblings('.wrap').slideUp();
    }
  });


  //close popup in select
  $(document).on('click', '.popup-select ul li input', function (e){
    if($(this).is(':checked')){

      setTimeout(function() {
        $.fancybox.close();
      }, 1000);

    }
  });

  //copy in buffer
  $(document).on('click', '.share', function (e){
    e.preventDefault();
    let copyText = $(this).attr('href');
    document.addEventListener('copy', function(e) {
      e.clipboardData.setData('text/plain', copyText);
      e.preventDefault();
    }, true);

    document.execCommand('copy');
    console.log('copied text : ', copyText);

    $(this).closest('.item-photo ').find(".wrap-photo").prepend("<p class='info-show'>Посилання в буфері обміну</p>");
    setTimeout(function() {
      $('.selection-inner .item-photo .wrap-photo .info-show').hide()
    }, 1000);

  });

  //copy in buffer
  $(document).on('click', '.btn-share', function (e){
    e.preventDefault();

    $('.block-active').removeClass('is-active').slideUp();

    let copyText = $(this).attr('href');
    document.addEventListener('copy', function(e) {
      e.clipboardData.setData('text/plain', copyText);
      e.preventDefault();
    }, true);

    document.execCommand('copy');
    console.log('copied text : ', copyText);

    $(this).closest('.item-share ').prepend("<p class='info-show'>Посилання в буфері обміну</p>");
    setTimeout(function() {
      $('.item-share .info-show').hide()
    }, 1000);

  });

  //copy in buffer
  $(document).on('click', '.share-link', function (e){
    e.preventDefault();

    let copyText = $(this).attr('href');
    document.addEventListener('copy', function(e) {
      e.clipboardData.setData('text/plain', copyText);
      e.preventDefault();
    }, true);

    document.execCommand('copy');
    console.log('copied text : ', copyText);

    $(this).closest('.home-block ').find('.share-info').prepend("<p class='info-show'>Посилання в буфері обміну</p>");
    setTimeout(function() {
      $('.share-info .info-show').hide()
    }, 1000);

  });

  //copy in buffer
  $(document).on('click', '.account-share', function (e){
    e.preventDefault();

    $('.block-active').removeClass('is-active').slideUp();

    let copyText = $(this).attr('href');
    document.addEventListener('copy', function(e) {
      e.clipboardData.setData('text/plain', copyText);
      e.preventDefault();
    }, true);

    document.execCommand('copy');
    console.log('copied text : ', copyText);


    $(this).closest('.item-home').prepend("<p class='info-show'>Посилання в буфері обміну</p>");

    setTimeout(function() {
      $('.item-home .info-show').remove();
    }, 1300);

  });


  //btn-selection
  $(document).on('click', '.btn-selection', function (e){
    e.preventDefault();

    $('.block-active').removeClass('is-active').slideUp();


    $(this).closest('.item-home').prepend("<p class='info-show'>Об’єкт успішно додано у підбір</p>");

    setTimeout(function() {
      $('.item-home .info-show').remove();
    }, 1300);

  });





//SELECT
  $('select').niceSelect();


  $(".nice-select .list").niceScroll(" .new",{
    cursorcolor: "#7B93FF",
    cursorwidth: "16px",
    cursorborder: "0 solid #7B93FF",
    horizrailenabled: false,
    autohidemode: "scroll",
    cursoropacitymin: 1,
    railpadding: { top: 0, right: 0, left: 0, bottom: 0 },
    zindex: 9999999,
    cursorborderradius: "16px",
    background: "#D9D9D9",
  });


  /*page add*/
  $('.select-input-block-add input').on('change', function() {

    let indexItem = $(".select-input-block-add input:checked").attr("data-value");


    if(indexItem == 1 || indexItem == 5 || indexItem == 7){
      $('.page-add-form').removeClass('add-select-2 add-select-3 add-select-4 add-select-5');
      $('.page-add-form').addClass('add-select-1');
      console.log(1)

    }else if(indexItem == 2){
      $('.page-add-form').removeClass('add-select-1 add-select-3 add-select-4 add-select-5');
      $('.page-add-form').addClass('add-select-2');
      console.log(2)

    }else if(indexItem == 3){
      $('.page-add-form').removeClass('add-select-1 add-select-2 add-select-4 add-select-5');
      $('.page-add-form').addClass('add-select-3');
      console.log(3)

    }else if(indexItem == 4 || indexItem == 6){
      $('.page-add-form').removeClass('add-select-1 add-select-2 add-select-3 add-select-5');
      $('.page-add-form').addClass('add-select-4');
      console.log(4)

    }else if(indexItem == 8){
      $('.page-add-form').removeClass('add-select-1 add-select-2 add-select-3 add-select-4');
      $('.page-add-form').addClass('add-select-5');
      console.log(5)

    }

  });

  //filter
  $('.select-input-block input').on('change', function() {

    let indexItem = $(".select-input-block input:checked").attr("data-value");
    console.log(indexItem)

    $('.full-filter').removeClass('sel-0 sel-1 sel-2 sel-3 sel-4 sel-5');
    $('.full-filter .input-dis-1 input').prop('disabled', true);
    $('.full-filter .input-dis-2 input').prop('disabled', true);


    if(indexItem == 1 || indexItem == 5 || indexItem == 7){
      $('.full-filter').addClass('sel-1');
      $('.full-filter .input-dis-1 input').prop('disabled', false);

    }else if(indexItem == 2){
      $('.full-filter').addClass('sel-2');
      $('.full-filter .input-dis-1 input').prop('disabled', false);
    }else if(indexItem == 3){
      $('.full-filter').addClass('sel-3');
      $('.full-filter .input-dis-1 input').prop('disabled', false);
      $('.full-filter .input-dis-2 input').prop('disabled', false);
    }else if(indexItem == 4 || indexItem == 6){
      $('.full-filter').addClass('sel-4');
      $('.full-filter .input-dis-1 input').prop('disabled', false);
      $('.full-filter .input-dis-2 input').prop('disabled', false);
    }else if(indexItem == 8){
      $('.full-filter').addClass('sel-5');
      $('.full-filter .input-dis-2 input').prop('disabled', false);
    }else if(indexItem == 0){
      $('.full-filter').addClass('sel-0');
      $('.full-filter .input-dis-1 input').prop('disabled', false);
    }

  });



  //add object - favorites page
  var url  = window.location.search;

  if (url.length > 2){
    $('.page-template-page-templatesfavourite-php .tabs-menu .is-active').removeClass('is-active');
    $('.page-template-page-templatesfavourite-php .tabs-menu li:nth-child(2)').addClass('is-active');
    $('.page-template-page-templatesfavourite-php .tab-content>div').hide();
    $('.page-template-page-templatesfavourite-php .tab-content>div:nth-child(2)').show();

  }

  /*-------------------PAGE-LADING----------------*/
  //parallax

 
      var rellax = new Rellax('.rellax');
 
  if($('.relax').length >0){
    var rellax = new Rellax('.rellax');
  }
 


  //HOVER UNHOVER
  $(".number-block .content").hover(function() {
    $('.number-block ').addClass("is-hover");
  }, function() {
    $('.number-block ').removeClass("is-hover");
  });

  //no click
  $(document).on('click', '.number-block .item a', function (e){
    e.preventDefault();
  })

  //slider
  var swiperPartners = new Swiper(".partners-slider", {
    slidesPerView: "auto",
    spaceBetween: 10,
    loop:true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    speed: 700,
  });

  //tel code
  if($('.input-wrap-tel input').length > 0){
    var input = document.querySelector("#tel");
    window.intlTelInput(input, {
      //allowDropdown: true,
      //autoHideDialCode: true,
      // autoPlaceholder: "off",
      // dropdownContainer: document.body,
      // excludeCountries: ["ru"],
      // formatOnDisplay: false,
      /*    geoIpLookup: function(callback) {
            $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
              var countryCode = (resp && resp.country) ? resp.country : "";
              callback(countryCode);
            });
          },*/
      // hiddenInput: "full_number",
      //initialCountry: "auto",
      localizedCountries: { 'ua': 'Ukraine' },
      // nationalMode: false,
      // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
      // placeholderNumberType: "MOBILE",
      preferredCountries: ['ua'],
      InitialCountry: "",
      separateDialCode: true,

    });
  }



  /* mob-menu*/
  $(document).on('click', '.open-menu-land a', function (e){
    e.preventDefault();

    $.fancybox.open( $('#menu-responsive-land'), {
      touch:false,
      autoFocus:false,
    });
    setTimeout(function() {
      $('body').addClass('is-active');
      $('html').addClass('is-menu');
      $('header').addClass('is-active');
    }, 100);

  });

  /*close mob menu*/
  $(document).on('click', '.close-menu-land a', function (e){
    e.preventDefault();
    $('body').removeClass('is-active');
    $.fancybox.close();
    $('header').removeClass('is-active');
    $('html').removeClass('is-menu');
  });


  $(document).on('click', '.scroll', function (e) {
    e.preventDefault();
    var id  = $(this).attr('href'),
        top = $(id).offset().top;
    $('body,html').animate({scrollTop: top - 100}, 1000);
  });

  new Cuttr('.lading .team .item .info', {
    //options here
    truncate: 'characters',
    length: 120,
    readMore: true,
 
      readMoreText: my_script.more,
    readLessText: my_script.roll_up,
 
      readMoreText: my_script.more,
      readLessText: my_script.roll_up,
 
  readMoreBtnPosition: 'after',

});

 
      $('.item-home .text-wrap .btn-dot .object_region, .inner-home-block .link-map-wrap .object_region').Cuttr({
    //options here
    truncate: 'characters',
    length: 22
  });



  $(document).on('click', '.lading header .nice-select .list li a, .menu-responsive-land .btn-wrap .nice-select .list li a, header .nice-select .list li a', function (e){
    e.preventDefault();
    $(this).closest('.open').removeClass('open')
  });

  //scroll
  $(document).on('click', '.page-template-landing .top-menu-lading>ul>li>a', function (e) {
    e.preventDefault();
    var id  = $(this).attr('href').substr(1, 100),
        top = $(id).offset().top;
    $('body,html').animate({scrollTop: top}, 1000);
  });

  $(document).on('click', '.lading header .btn-border', function (e) {
    e.preventDefault();
    var id  = $(this).attr('href').substr(1, 200),
      top = $(id).offset().top;
      console.log(id)
    $('body,html').animate({scrollTop: top - 100}, 1000);
  });

  $(document).on('click', '.menu-responsive-land .mob-menu-land > ul > li > a', function (e) {
    e.preventDefault();
    $.fancybox.close();
    var id  = $(this).attr('href'),
        top = $(id).offset().top;
    $('body,html').animate({scrollTop: top}, 1000);

  });

  //fix header
  $(".top-line").sticky({
    topSpacing:0
  });

  //fix header
  $(".top-line-lading").sticky({
    topSpacing:0
  });

 
      $(document).on('click', '.lading header .nice-select .list li a, .top-line .nice-select .list li a, .menu-responsive-land .btn-wrap .nice-select .list li a', function (e){

        $(this).closest('.open').removeClass('open')
      })

});