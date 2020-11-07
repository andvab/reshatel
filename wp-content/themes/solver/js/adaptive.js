jQuery(function($){

    //Click on menu
    $('#site-header .mobile-menu').on('click', function(){
        $(this).toggleClass('open');
        $('#main-menu').toggleClass('open-menu');
    });
    $('.caption-1').addClass('active'); 
    $('.caption-1').click(function(){
        $('#article .inner-slider').attr('style','left: 0').fadeIn();
        $('.caption li').removeClass('active');
        $(this).toggleClass('active');
    });
    $('.caption-2').click(function(){
        $('#article .inner-slider').attr('style','left: -200px').fadeIn();
        $('.caption li').removeClass('active');    
        $(this).toggleClass('active');

    });
    $('.caption-3').click(function(){
        $('#article .inner-slider').attr('style','left: -400px').fadeIn();
        $('.caption li').removeClass('active');    
        $(this).toggleClass('active');

    });

    $('.caption-11').addClass('active'); 
    $('.caption-11').click(function(){
        $('.adaptive-slider-inner').attr('style','left: 0').fadeIn();
        $('.caption li').removeClass('active');
        $(this).toggleClass('active');
    });
    $('.caption-22').click(function(){
        $('.adaptive-slider-inner').attr('style','left: -200px').fadeIn();
        $('.caption li').removeClass('active');
        $(this).toggleClass('active');

    });
    $('.caption-33').click(function(){
        $('.adaptive-slider-inner').attr('style','left: -400px').fadeIn();
        $('.caption li').removeClass('active');
        $(this).toggleClass('active');
    });
    $('.caption-44').click(function(){
        $('.adaptive-slider-inner').attr('style','left: -600px').fadeIn();
        $('.caption li').removeClass('active');
        $(this).toggleClass('active');

    });
    $('.caption-55').click(function(){
        $('.adaptive-slider-inner').attr('style','left: -800px').fadeIn();
        $('.caption li').removeClass('active');
        $(this).toggleClass('active');

    });
    

    
    $('.form-more-button-prev').on('click', function(){
        $('.top-hidden').css({opacity: 0, visibility: "visible"}).animate({opacity: 1}, 400);
        $('.top-hidden').css('position','relative');
        $('.form-hidden').css({opacity: 1, visibility: "hidden"}).animate({opacity: 0}, 400);
        $('.form-hidden').css('position','absolute');
    });
    $('.top-hidden .wpcf7-date-small, .top-hidden .subject input, .top-hidden .wpcf7-datetime, .top-hidden .quantity input, .top-hidden .duration input').addClass('visuality');
    var  inputs = $('.visuality');

         function checkEmpty() {
          //check whether inputs are visible
          if(inputs.filter(':visible').length===0){ 
          return false;}
          else{
           // filter over the empty inputs
                return inputs.filter(':visible').filter(function(){ return !this.value; }).length === 0;
          }   
          };

         inputs.on('keyup change', function() {

          if(!checkEmpty()) {
           //At least one input is empty
           $('.form-more-button').prop('disabled', true);
           $('.form-more-button').css('opacity','0.2');   
           $('.form-more-button').prop('title','Для продолжения заполните все обязательные поля');   
	   $('.form-more-button').off('click');
            }else{   
           $('.form-more-button').prop('disabled', false);   
           $('.form-more-button').css('opacity','1');
           $('.form-more-button').prop('title','');   
           $('.form-more-button').on('click', function(){
                $('.form-hidden').css({opacity: 0, visibility: "visible"}).animate({opacity: 1}, 400);
                $('.form-hidden').css('position','relative');
                $('.top-hidden').css({opacity: 1, visibility: "hidden"}).animate({opacity: 0}, 400);
                $('.top-hidden').css('position','absolute');
		$("input[name=re_form_name]").focus();
            });
           }
            }).keyup();


    //Click on button left of the slider
    $('#article .arrow-right').on('click', function() {
        var sliderBlock = $('#article .inner-slider');
        var pos = parseInt(sliderBlock.css('left'));
        var minpos = -3 * 200;
        if (sliderBlock.is(':animated') == false) {
            if (pos > minpos) {
                sliderBlock.animate({'left' : (pos -  200) + 'px'}, 500);
            } else {
                sliderBlock.animate({'left' : minpos + 'px'}, 500);
            }
        }
    });

    //Click on button right of the slider
    $('#article .arrow-left').on('click',function() {
        var sliderBlock = $('#article .inner-slider');
        var pos = parseInt(sliderBlock.css('left'));
        if (sliderBlock.is(':animated') == false) {
            if (pos < 0) {
                sliderBlock.animate({'left' : (pos +  200) + 'px'}, 500);
            } else {
                sliderBlock.animate({'left' : 0 + 'px'}, 500);
            }
        }
    });

    //swipe right
    $('#article .inner-slider').on('swiperight',function() {
        var sliderBlock = $(this);
        var pos = parseInt(sliderBlock.css('left'));
        if (sliderBlock.is(':animated') == false) {
            if (pos < 0) {
                sliderBlock.animate({'left' : (pos +  200) + 'px'}, 500);
            } else {
                sliderBlock.animate({'left' : 0 + 'px'}, 500);
            }
        }
        if ( pos == '-200') {
              $('.caption li').removeClass('active');  
              $('.caption-1').addClass('active');
            }
            if ( pos == '-400') {
              $('.caption li').removeClass('active');  
              $('.caption-2').addClass('active');
            }
            if ( pos == '-600') {
              $('.caption li').removeClass('active');  
              $('.caption-3').addClass('active');
            }
    });

    //swipe left
    $('#article .inner-slider').on('swipeleft', function() {
        var sliderBlock = $(this);
        var pos = parseInt(sliderBlock.css('left'));
        var minpos = -2 * 200;
        if (sliderBlock.is(':animated') == false) {
            if (pos > minpos) {
                sliderBlock.animate({'left' : (pos -  200) + 'px'}, 500);
            } else {
                sliderBlock.animate({'left' : minpos + 'px'}, 500);
            }
        }
        if ( pos == '200') {
              $('.caption li').removeClass('active');  
              $('.caption-1').addClass('active');
            }
            if ( pos == '0') {
              $('.caption li').removeClass('active');  
              $('.caption-2').addClass('active');
            }
            if ( pos == '-200') {
              $('.caption li').removeClass('active');  
              $('.caption-3').addClass('active');
            }
    });

     //swipe right
    $('.adaptive-slider-inner').on('swiperight',function() {
        var sliderBlock = $(this);
        var pos = parseInt(sliderBlock.css('left'));
        if (sliderBlock.is(':animated') == false) {
            if (pos < 0) {
                sliderBlock.animate({'left' : (pos +  200) + 'px'}, 500);
            } else {
                sliderBlock.animate({'left' : 0 + 'px'}, 500);
            }

        }
        if ( pos == '-200') {
              $('.caption li').removeClass('active');  
              $('.caption-11').addClass('active');
            }
            if ( pos == '-400') {
              $('.caption li').removeClass('active');  
              $('.caption-22').addClass('active');
            }
            if ( pos == '-600') {
              $('.caption li').removeClass('active');  
              $('.caption-33').addClass('active');
            }
            if ( pos == '-800') {
              $('.caption li').removeClass('active');  
              $('.caption-44').addClass('active');
            }
            if ( pos == '-1000') {
              $('.caption li').removeClass('active');  
              $('.caption-55').addClass('active');
            }
    });

    //swipe left
    $('.adaptive-slider-inner').on('swipeleft', function() {
        var sliderBlock = $(this);
        var pos = parseInt(sliderBlock.css('left'));
        var minpos = -4 * 200;
        if (sliderBlock.is(':animated') == false) {
            if (pos > minpos) {
                sliderBlock.animate({'left' : (pos -  200) + 'px'}, 500);
            } else {
                sliderBlock.animate({'left' : minpos + 'px'}, 500);
            }
            
        }   
            if ( pos == '200') {
              $('.caption li').removeClass('active');  
              $('.caption-11').addClass('active');
            }
            if ( pos == '0') {
              $('.caption li').removeClass('active');  
              $('.caption-22').addClass('active');
            }
            if ( pos == '-200') {
              $('.caption li').removeClass('active');  
              $('.caption-33').addClass('active');
            }
            if ( pos == '-400') {
              $('.caption li').removeClass('active');  
              $('.caption-44').addClass('active');
            }
            if ( pos == '-600') {
              $('.caption li').removeClass('active');  
              $('.caption-55').addClass('active');
            }
    });

    function init (){

        var mainContent = $('#main-content');
        var mainImg = mainContent.find('.main-img');
        var infoBlock = mainContent.find('.info-block');

        if ($('.container').outerWidth() < 960) {
            //Replace main image
            mainContent.find('.row:first-child').prepend(mainImg);

        } else {
            mainContent.find('.row:first-child').prepend(infoBlock);
        }
    }
    init();

    $(window).resize(function(){
       init();
    });

});
