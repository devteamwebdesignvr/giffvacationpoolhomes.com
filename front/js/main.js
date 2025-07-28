AOS.init();

// Slick slider
 $('.slick-testimonial').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 2,
  arrows:true,
  adaptiveHeight: true,
  prevArrow:"<i class='fa fa-angle-left' aria-hidden='true'></i>",
  nextArrow:"<i class='fa fa-angle-right' aria-hidden='true'></i>",
    responsive: [{
      breakpoint: 900,
      settings: {
        slidesToShow: 1,
        infinite: true,
      }
    },
    {
      breakpoint: 500,
      settings: {
        slidesToShow: 1,
        infinite: true,
      }
    }]
});



