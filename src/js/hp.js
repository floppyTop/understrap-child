// Problem: The wheel presents no meaningful interaction

// The Solution: Toggle an event listener so that when the first block is hovered over, a .left class is applied, and so that when the second block is hovered over, a .right class is applied

// 1: Define a function that returns a left or right
jQuery(function($){

    $("#hero-one").mouseenter(function() {
        $("img.icon").addClass("left");
    }).mouseleave(function(){
        $("img.icon").removeClass("left");
    });

    $("#hero-two").mouseenter(function() {
        $("img.icon").addClass("right");
    }).mouseleave(function(){
        $("img.icon").removeClass("right");
    });


    $('.slick-slider').slick({
        dots: true,
        nextArrow: '<i class="fa fa-arrow-right next"></i>',
        prevArrow: '<i class="fa fa-arrow-left prev"></i>',      
        infinite: false,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 4,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              infinite: true,
              dots: true
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      });
              

});
