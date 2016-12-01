function initializeGM(_IdElem,_Lat,_Lon,_Zooom,_Label,_AdresData) {
  var myLatlng  = new google.maps.LatLng(_Lat, _Lon);
  var markerPos = new google.maps.LatLng(_Lat, _Lon);
  var styles 	= [{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebf0b0"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#d1dc49"},{"color":"#dce477"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#d1dc49"}]}]
  //[{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#e0efef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#1900ff"},{"color":"#c0e8e8"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#7dcdcd"}]}];
  
  var locations = [
  	[_Label, _Lat, _Lon, _AdresData]
  ];	
  
  
  var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"});
  var myOptions = {
	zoom: _Zooom,
	center: myLatlng,
	scaleControl: false,
	scrollwheel: false,
	zoomControl: true,
	mapTypeControl:false,
	streetViewControl: false,
	mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
  }
  
  var map = new google.maps.Map(document.getElementById(_IdElem), myOptions);
  map.mapTypes.set('map_style', styledMap);
  map.setMapTypeId('map_style');
  
  setMarkers(map, locations);
}

function setMarkers(map, beaches) {
	var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < beaches.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(beaches[i][1], beaches[i][2]),
		draggable:false,
	    animation: google.maps.Animation.DROP,
        map: map
      });
	  marker.setTitle(beaches[i][0]);
	  
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(beaches[i][3]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }    
}