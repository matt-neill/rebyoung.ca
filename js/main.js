/*
	RebYoung jQuery functions
	January 2014
	Matt Neill
	matt@poetretail.com
*/

$(document).ready(function(e) {	
	youtubeResize()
	
	$('#show-nav, #whiteover').click(function()
	{
		navSlideToggle()
	});
	
});

$(window).resize(function(){
	youtubeResize()
});

function youtubeResize()
{
	$('#youtube-video').css('height', ($('#youtube-video').width())*.62);	//16:9 & padding	
}

function navSlideToggle()
{
	$('#nav-list').toggleClass('nav-slide');
	$('#show-nav').toggleClass('nav-open');
	$('#whiteover').fadeToggle(100);	
}