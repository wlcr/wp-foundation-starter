(function ($) {
	$(document).ready(function() {  
		$(document).foundation();

		$('.slug-event').OrganizeEventDetailPage();

		$('article .list-view').organizeListView();

        $('.restaurant .slickslider').slick({
            slidesToShow: 1,
            dots: false,
            arrows: false,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            autoplay: true
        });     

		$('.accordion').toggleAccordionIcons();
	});
}(jQuery));