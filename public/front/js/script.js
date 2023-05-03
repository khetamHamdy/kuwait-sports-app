$(document).ready(function(){
    
    var rtl = false;
    
    if($("html").attr("lang") == 'ar'){
         rtl = true;
    }
    
    /*header-fixed*/
    $(window).scroll(function(){
            
        if ($(window).scrollTop() >= 100) {
            $('#header').addClass('fixed-header');
        }
        else {
            $('#header').removeClass('fixed-header');
        }
              
    });
    $('.scroll, .mmenu a').on('click', function () {
        $('html, body').animate({

            scrollTop: $('#' + $(this).data('value')).offset().top

        }, 1000);

        $("body,html").removeClass('menu-toggle');

        $(".hamburger").removeClass('active');
    });
    /*open menu*/
    
    $(".hum-menu").click(function(){
        
        $(".main_menu").slideToggle();
        if($(this).hasClass('is-closed')) {
            $(this).removeClass('is-closed');
        }else{
            $('.hum-menu').addClass('is-closed');
        }
    });
    $(".is-closed").click(function(){
        $(this).removeClass('is-closed');
    });
   
    $(".hum-mega").click(function(){
        
        $(".mega-menu").slideToggle();
        if($(this).hasClass('is-closed')) {
            $(this).removeClass('is-closed');
        }else{
            $('.hum-mega').addClass('is-closed');
        }
    });
    
    /*page-scroll*/
    
    
    $('#slide-home').owlCarousel({
        loop: true,
        rtl: rtl,
        responsiveClass: true,
        items: 1,
        dots: true,
        nav: false,
        autoplay: false,
//        navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
    });
    
    $(".carousel-gallery").owlCarousel({
        loop: true,
        margin: 40,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            992: {
                items: 3,
            },
            1199: {
                items: 3,
            }
        },
        dots: false,
        nav: true,
        rtl: rtl,
        autoplay: false,
        navText:['<i class="fa-solid fa-chevron-left"></i>','<i class="fa-solid fa-chevron-right"></i>']
    });
    

})