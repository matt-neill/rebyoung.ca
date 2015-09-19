/*
	RebYoung jQuery functions
	January 2014
	Matt Neill
	matt@poetretail.com
*/

$(document).ready(function(e) {
	youtubeResize();
	photosliderInit('.panel-media')

	$('#show-nav, #whiteover').click(function() {
		navSlideToggle()
	});

});

$(window).resize(function(){
	youtubeResize()
});

function youtubeResize() {
	$('#youtube-video').css('height', ($('#youtube-video').width())*.62);	//16:9 & padding
}

function navSlideToggle() {
	$('#nav-list').toggleClass('nav-slide');
	$('#show-nav').toggleClass('nav-open');
	$('#whiteover').fadeToggle(100);
}

/*--------------- Slideshows ---------------*/
var photoslider;
var photosliderInit;
photosliderInit = function(elem){

	$(elem).owlCarousel({
		autoPlay	: false,
		pagination	: false,
		lazyLoad	: true,
		singleItem	: true,
		rewindSpeed : 1000,
		dragBeforeAnimFinish : false
	});
	photoslider = elem;
	sliderData = $(elem).data('owlCarousel');
}

function sliderDestroy() {
	photoslider = $('.slider').data('owlCarousel');
	if (photoslider) photoslider.destroy();
}
