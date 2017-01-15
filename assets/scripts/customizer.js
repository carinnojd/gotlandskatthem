
// ### SLIDER - Customize slick.js ###
$(document).ready(function(){

  // Settings for the slider on front page
  $('.slider-front').slick({
    dots: true,
    rows: 2,
    infinite: true,
    speed: 600,
    adaptiveHeight: true,
    autoplay: true,
  	autoplaySpeed: 10000,
  	mobileFirst: false,
  	variableWidth: false,
  	responsive: [{
                  breakpoint: 768,
                  settings: {
                      mobileFirst: true,
                      infinite: true,
                      slidesToShow: 1,
                      centerMode: false,
                      focusOnSelect: true
                  }
                }]
  });

  // Settings for the slider on Cats page
  // Using thumb of the images as a nav to change slide
  $('.slider-for').each(function(key, item) {

    var sliderIdName = 'slider-for' + key;
    var sliderNavIdName = 'slider-nav' + key;

    this.id = sliderIdName;
    $('.slider-nav')[key].id = sliderNavIdName;

    var sliderId = '#' + sliderIdName;
    var sliderNavId = '#' + sliderNavIdName;

    $(sliderId).slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: sliderNavId
    });

    $(sliderNavId).slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      asNavFor: sliderId,
      dots: false,
      arrows: true,
      centerMode: false,
      focusOnSelect: true
    });

  });

});

// ### NAV BAR WITH DROPDOWN - FRONT PAGE ###
if ($(window).width() >= 1023){  
  // Open menu when hovering
  $(".dropdown").hover(function () {
      $(this).toggleClass("open");
   });

  // Add backgroundcolor to menu dropdown when menu items are active
  if ($('.dropdown .menu-item').hasClass('active')) {
      $('.current-menu-parent').addClass('active');
  }
} 


// ### GOOGLE MAPS ###
(function($) {
  
  /* Render a Google Map onto the selected jQuery element */
  function new_map( $el ) {
    
    var $markers = $el.find('.marker');
    
    var args = {
      zoom    : 16,
      center    : new google.maps.LatLng(0, 0),
      mapTypeId : google.maps.MapTypeId.ROADMAP
    };
    
    // Create map           
    var map = new google.maps.Map( $el[0], args);
    
    // Add a markers reference
    map.markers = [];
    
    // Add markers
    $markers.each(function(){
        add_marker( $(this), map ); 
    });
    
    center_map( map );
    
    return map;
  }
  
  /* Add a marker to the selected Google Map */
  function add_marker( $marker, map ) {

    var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

    // Create marker
    var marker = new google.maps.Marker({
      position  : latlng,
      map     : map
    });

    // Add to array
    map.markers.push( marker );

    // If marker contains HTML, add it to an infoWindow
    if( $marker.html() )
    {
      // Create info window
      var infowindow = new google.maps.InfoWindow({
        content   : $marker.html()
      });

      // Show info window with address
      infowindow.open( map, marker );
    }
  }

  /* Center the map and showing all markers attached to this map */
  function center_map( map ) {

    var bounds = new google.maps.LatLngBounds();

    // Loop through all markers and create bounds
    $.each( map.markers, function( i, marker ){

      var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

      bounds.extend( latlng );
    });

    // 1 marker
    if( map.markers.length == 1 )
    {
      // Set center of map
        map.setCenter( bounds.getCenter() );
        map.setZoom( 16 );
    }
    else
    {
      // Fit to bounds
      map.fitBounds( bounds );
    }
  }

  /* Render each map when the document is ready (page has loaded) */
  // Global var
  var map = null;

  $(document).ready(function(){
    $('.acf-map').each(function(){
      
      // Create map
      map = new_map( $(this) );
    });
  });

})(jQuery);
