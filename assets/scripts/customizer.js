


$(document).ready(function(){
  $('.slider').slick({
    dots: true,
    rows: 2,
    infinite: true,
    speed: 600,
    adaptiveHeight: true,
    autoplay: true,
  	autoplaySpeed: 10000,
  	mobileFirst: true,
  	variableWidth: true
  });
});


var $fullWidthHeight = $('.FullWidth');

/* Resize function, resize to full width/height after window size change */
function winResized() {
	
	if ($fullWidthHeight.size()) {
		var wWidth = $(window).width();

		$fullWidthHeight.css( {
			'width': wWidth
		});
	}
} 

// Start resize function on load and resize window
$(window).load(function() {
	winResized();
}).bind('resize',function() {
	winResized();
});


var elem = document.getElementByClassName("slider")[0];
if (elem.requestFullscreen) {
  elem.requestFullscreen();
} else if (elem.msRequestFullscreen) {
  elem.msRequestFullscreen();
} else if (elem.mozRequestFullScreen) {
  elem.mozRequestFullScreen();
} else if (elem.webkitRequestFullscreen) {
  elem.webkitRequestFullscreen();
}