
jQuery(document).ready(function($){

	$('.partner-logos').slick({
		slidesToShow: 6,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 2500,
		arrows: false,
		dots: false,
		pauseOnHover: true,
		centerMode: true,
		responsive: [{
			breakpoint: 1220,
			settings: {
				slidesToShow: 5
			}
		}, {
			breakpoint: 1024,
			settings: {
				slidesToShow: 4
			}
		}, {
			breakpoint: 768,
			settings: {
				slidesToShow: 3
			}
		}, {
			breakpoint: 520,
			settings: {
				slidesToShow: 2
			}
		}]
	});

});