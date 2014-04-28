$(window).load(function () {

	/*var vague = $('.background_img').Vague({
    	intensity:2
	});
	vague.blur();*/

    $("#background").endlessScroll(
    	{ width: '100%', height: '100%', steps: -1, speed: 100, mousestop: false}
    );
});

//$(function() {
//});
