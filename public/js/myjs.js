$(function() {


    /*var selector = '.navbar-nav li';
    $(selector).on('click', function(){
       $(selector).removeClass('active');
       $(this).addClass('active');
    }); */
    
    $(document).ready(function() {
           $('.has-popover').popover({'trigger':'hover'});
    
           $(".menu-icon").on("click", function() {
                     $("nav ul").toggleClass("showing");
               });
    
    
               // get current URL path and assign 'active' class
               var pathname = window.location.pathname;
               $('.navbar-nav > li > a[href="'+pathname+'"]').parent().addClass('active');
    
    
         });
    
         // Scrolling Effect
    
         $(window).on("scroll", function() {
               if($(window).scrollTop()) {
                     $('nav').addClass('black');
               }
    
               else {
                     $('nav').removeClass('black');
               }
    
       });
    
    
    
    
    
    
    });
