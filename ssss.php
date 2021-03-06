<!DOCTYPE html> 
<!--
  copyright (c) 2011 Google inc.

  You are free to copy and use this sample.
  License can be found here: http://code.google.com/apis/ajaxsearch/faq/#license

-->
<html> 
<head> 
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 

<title>Google Maps JavaScript API v3 Example: Fusion Tables Layer</title> 

<style>
  body { font-family: Arial, sans-serif; }
  #map_canvas { height: 500px; width:600px; }
</style>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript" id="script"> 
var tableid = 260197;
var center = new google.maps.LatLng(37.4, -100.1);
var zoom = 3;

function initialize() {

  // Initialize the map
  var map = new google.maps.Map(document.getElementById('map_canvas'), {
    center: center,
    zoom: zoom,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  
  // Initialize the layer
  var layer = new google.maps.FusionTablesLayer(tableid);
  layer.setMap(map);
  
  // Create the legend and display on the map
  var legendDiv = document.createElement('DIV');
  var legend = new Legend(legendDiv, map);
  legendDiv.index = 1;
  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legendDiv);
}

function Legend(controlDiv, map) {
  // Set CSS styles for the DIV containing the control
  // Setting padding to 5 px will offset the control
  // from the edge of the map
  controlDiv.style.padding = '5px';

  // Set CSS for the control border
  var controlUI = document.createElement('DIV');
  controlUI.style.backgroundColor = 'white';
  controlUI.style.borderStyle = 'solid';
  controlUI.style.borderWidth = '1px';
  controlUI.title = 'Legend';
  controlDiv.appendChild(controlUI);

  // Set CSS for the control text
  var controlText = document.createElement('DIV');
  controlText.style.fontFamily = 'Arial,sans-serif';
  controlText.style.fontSize = '12px';
  controlText.style.paddingLeft = '4px';
  controlText.style.paddingRight = '4px';
  
  // Add the text
  controlText.innerHTML = '<b>Butterflies*</b><br />' +
        '<img src="http://maps.google.com/mapfiles/ms/micons/red-dot.png" /> Battus<br />' +
        '<img src="http://maps.google.com/mapfiles/ms/micons/yellow-dot.png" /> Speyeria<br />' +
        '<img src="http://maps.google.com/mapfiles/ms/micons/green-dot.png" /> Papilio<br />' +
        '<img src="http://maps.google.com/mapfiles/ms/micons/blue-dot.png" /> Limenitis<br />' +
        '<img src="http://maps.google.com/mapfiles/ms/micons/purple-dot.png" /> Myscelia<br />' +
        '<small>*Data is fictional</small>';
  controlUI.appendChild(controlText);
}

</script> 
</head> 
<body onload="initialize();"> 

<div id="map_canvas"></div>

<div id="code"></div>
<script type="text/javascript" src="script/script.js"></script>
</body> 
</html> 