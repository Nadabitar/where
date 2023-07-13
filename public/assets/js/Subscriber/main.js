(function($) {
    "use strict";


    /*-------------------------
      search active
    --------------------------*/
    $(".icon-search").on("click", function() {
        $(this).parent().find('.toogle-content').slideToggle('medium');
    })



    /*--- showlogin toggle function ----*/
    
    $( '#showlogin' ).on('click', function() {
        $( '#checkout-login' ).slideToggle(900);
    }); 

    /*--- showlogin toggle function ----*/
    $( '#showcoupon' ).on('click', function() {
        $( '#checkout_coupon' ).slideToggle(900);
    });
    
    /*--- showlogin toggle function ----*/
    $('#ship-box').on('click', function() {
        $('#ship-box-info').slideToggle(1000);
    });


    // /* isotop active */
    
    // $('.grid').imagesLoaded( function() {

    //     // init Isotope
    //     var $grid = $('.grid').isotope({
    //         itemSelector: '.grid-item',
    //         percentPosition: true,
    //         masonry: {
    //             // use outer width of grid-sizer for columnWidth
    //             columnWidth: '.grid-item',
    //         }
    //     });
    // });
    
    
    
    
    
    
    
    
    
    
    
    /* counterUp */
    $('.count').counterUp({
        delay: 10,
        time: 1000
    });

    /*-------------------------------------------
        03. scrollUp jquery active
    --------------------------------------------- */
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });


    /*--
     Menu Sticky
    -----------------------------------*/
    var windows = $(window);
    var stickey = $(".style-6");

    windows.on('scroll', function() {
        var scroll = windows.scrollTop();
        if (scroll < 1) {
            stickey.removeClass("stick");
        } else {
            stickey.addClass("stick");
        }
    });




    /*-- Product Quantity --*/
    $('.product-quantity2').append('<span class="dec qtybtn"><i class="fa fa-angle-left"></i></span><span class="inc qtybtn"><i class="fa fa-angle-right"></i></span>');
    $('.qtybtn').on('click', function() {
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);
    });




})(jQuery);