<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">

.divv{
margin-top:0px;
background-color:#FFF;	
clear:both;
}

.lbl{
border-style:solid;
border-width:medium;
border-color:#00C;
border-radius:15px;
margin:10px;
margin-top:0px;
padding:10px;
}

.pencere{
background-color:#FFF;
border-style:solid;
border-width:medium;
border-color:#00C;
border-radius:15px;
margin:5px;
margin-top:0px;
padding:5px;
}

.bos
{
	height:10px;
	width:1000px;
}

table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
}
table.gridtable th {
	padding: 8px;
	border-radius:10px;
	background-color: #4283C7;
	border-bottom:solid;
	border-bottom-color: #006;
}
table.gridtable td {
	padding: 8px;
	background-color: #ffffff;
	text-align:center;
	
}

.foto{
text-align:left
}

.alt_bos
{
	height:200px;
	width:1000px;
}

.satir_bos
{
	height:210px;
	width:10px;
}

html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
	
#legend {
    background: white;
    padding: 10px;
  }
</style>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

<script>
var overlay;
var google_maps;
USGSOverlay.prototype = new google.maps.OverlayView();
var guncel_kat = 1;

// Initialize the map and the custom overlay.

function initialize() {
  var mapOptions = {
    zoom: 30,
    center: new google.maps.LatLng(39.74683203032895, 30.474698299634188),
	mapTypeControl: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  google_maps = map;

  var swBound = new google.maps.LatLng(39.74676581119369, 30.47443736263356);
  var neBound = new google.maps.LatLng(39.74695525890393, 30.47470408628280);
  var bounds = new google.maps.LatLngBounds(swBound, neBound);

  var srcImage = 'http://www.e-birge.com/img/kroki_1.png';
  
  // Create the legend and display on the map
  var legendDiv = document.createElement('DIV');
  var legend = new Kat(legendDiv, map);
  legendDiv.index = 1;
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(legendDiv);
  
  // Create the legend and display on the map
  var legendDiv = document.createElement('DIV');
  var legend = new Legend(legendDiv, map);
  legendDiv.index = 1;
  map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legendDiv);

  overlay = new USGSOverlay(bounds, srcImage, map);
}

function USGSOverlay(bounds, image, map) {

  this.bounds_ = bounds;
  this.image_ = image;
  this.map_ = map;

  this.div_ = null;

  this.setMap(map);
}

USGSOverlay.prototype.onAdd = function() {

  var div = document.createElement('div');
  div.style.borderStyle = 'none';
  div.style.borderWidth = '0px';
  div.style.position = 'absolute';

  var img = document.createElement('img');
  img.src = this.image_;
  img.style.width = '100%';
  img.style.height = '100%';
  img.style.position = 'absolute';
  div.appendChild(img);

  this.div_ = div;

  var panes = this.getPanes();
  panes.overlayLayer.appendChild(div);
};


USGSOverlay.prototype.draw = function() {
  var overlayProjection = this.getProjection();

  var sw = overlayProjection.fromLatLngToDivPixel(this.bounds_.getSouthWest());
  var ne = overlayProjection.fromLatLngToDivPixel(this.bounds_.getNorthEast());

  var div = this.div_;
  div.style.left = sw.x + 'px';
  div.style.top = ne.y + 'px';
  div.style.width = (ne.x - sw.x) + 'px';
  div.style.height = (sw.y - ne.y) + 'px';
};


USGSOverlay.prototype.onRemove = function() {
  this.div_.parentNode.removeChild(this.div_);
  this.div_ = null;
};

function Kat(controlDiv, map) {
  // Set CSS for the control border
  var controlUI = document.createElement('DIV');
  controlUI.style.borderStyle = 'none';
  controlUI.title = 'KAT SEÇİMİ';
  controlDiv.appendChild(controlUI);

  // Set CSS for the control text
  var controlText = document.createElement('DIV');
  controlText.style.fontFamily = 'Arial,sans-serif';
  controlText.style.fontSize = '24px';
  
  // Add the text
  controlText.innerHTML = "<div onmouseover='show()' onmouseout='hide()'> <div id='katlar' style='visibility: hidden'>"+
"<b style='margin-left:10'>KAT SEÇİMİ</b> <br />" +
"<a id='btn_guncelle' href='#' onclick='KatSecimi(1)'>KAT 1</a>" + 
"<a style='margin-left:20' id='btn_guncelle' href='#' onclick='KatSecimi(2)'>KAT 2</a>"+
"</div></div>";
  controlUI.appendChild(controlText);
}

function show() {
    document.getElementById("katlar").style.visibility = "visible";
}
  
function hide() {
    document.getElementById("katlar").style.visibility = "hidden";
}

function KatSecimi(kat)
{
	deleteMarkers();
	var swBound = new google.maps.LatLng(39.74676581119369, 30.47443736263356);
	var neBound = new google.maps.LatLng(39.74695525890393, 30.47470408628280);
	var bounds = new google.maps.LatLngBounds(swBound, neBound);
	var srcImage = 'http://www.e-birge.com/img/kroki_' + kat + '.png';
	overlay = new USGSOverlay(bounds, srcImage, google_maps);
	guncel_kat = kat;
}

function Legend(controlDiv, map) {
  controlDiv.style.padding = '5px';
  controlDiv.style.backgroundColor = "White";

  // Set CSS for the control border
  var controlUI = document.createElement('DIV');
  controlUI.style.borderStyle = 'solid';
  controlUI.style.borderWidth = '1px';
  controlUI.title = 'GRUPLAR';
  controlDiv.appendChild(controlUI);

  // Set CSS for the control text
  var controlText = document.createElement('DIV');
  controlText.style.fontFamily = 'Arial,sans-serif';
  controlText.style.fontSize = '20px';
  controlText.style.paddingLeft = '4px';
  controlText.style.paddingRight = '4px';
  
  // Add the text
  controlText.innerHTML = '<b style="margin-left:15">GRUPLAR</b><br />' +
        '<img src="http://maps.google.com/mapfiles/ms/micons/red-dot.png" /> Öğrenci<br />' +
        '<img src="http://maps.google.com/mapfiles/ms/micons/yellow-dot.png" /> Öğretmen<br />' +
        '<img src="http://maps.google.com/mapfiles/ms/micons/green-dot.png" /> Hizmetli<br />' +
        '<img src="http://maps.google.com/mapfiles/ms/micons/blue-dot.png" /> Güvenlik<br />' +
        '<img src="http://maps.google.com/mapfiles/ms/micons/purple-dot.png" /> Araç<br />' +
		'<img src="http://maps.google.com/mapfiles/ms/micons/orange-dot.png" /> Diğer<br />';
  controlUI.appendChild(controlText);
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

<script type="text/javascript">



// Sets the map on all markers in the array.
function setAllMap(g_map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(g_map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setAllMap(null);
}

// Shows any markers currently in the array.
function showMarkers() {
  setAllMap(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
}

var markers = [];

function MarkerEkle(lat, lon, zaman)
{	 
  var myLatlng = new google.maps.LatLng(lat, lon);

	  var marker = new google.maps.Marker({
		  position: myLatlng,
		  map: google_maps,
		  icon: "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
		  animation: google.maps.Animation.DROP,
		  title: zaman
	  });
	  
	  google.maps.event.addListener(marker, 'click', function() {	  
		var contentString = "<div style='height:40px'>" + zaman + "</div>";
		infowindow.setContent(contentString);
		infowindow.open(google_maps,marker);
	  });
	  
	 markers.push(marker);

}
var infowindow = new google.maps.InfoWindow();

function KullaniciBilgileriniGetir()
{	
alert("a");
	$.post("analiz_kullanici_bilgilerini_getir.php", function(data){
		alert(data);
		/*var array_konumlar = data.split("_");
		var index;
		for(index=0; index<array_konumlar.length; index++)
		{
			var array_kullanici_konum = array_konumlar[index].split("/");
			var konum_x = array_kullanici_konum[0];
			var konum_y = array_kullanici_konum[1];
			var konum_kat = array_kullanici_konum[2];
			var zaman = array_kullanici_konum[3];
			var d_lat = 39.74676581119369 + ((konum_y * 0.00017444771024)/19.4);
			var d_lon = 30.47443736263356 + ((konum_x * 0.00026672364924)/22.8);

			MarkerEkle(d_lat, d_lon, zaman);
			
		}*/
	});
}

function KonumGuncelle()
{	
	$.post("gecmis_konum_kaynak_bilgileri.php", { kullanici_id: '3'}).done(function(data){
		alert(data);
		var array_konumlar = data.split("_");
		var index;
		for(index=0; index<array_konumlar.length; index++)
		{
			var array_kullanici_konum = array_konumlar[index].split("/");
			var konum_x = array_kullanici_konum[0];
			var konum_y = array_kullanici_konum[1];
			var konum_kat = array_kullanici_konum[2];
			var zaman = array_kullanici_konum[3];
			var d_lat = 39.74676581119369 + ((konum_y * 0.00017444771024)/19.4);
			var d_lon = 30.47443736263356 + ((konum_x * 0.00026672364924)/22.8);

			MarkerEkle(d_lat, d_lon, zaman);
			
		}
	});
}
KullaniciBilgileriniGetir();
//KonumGuncelle();
</script>


</head>

<body>

<div class="bos">
</div>

<div class="pencere">
    <div id="map-canvas">
    </div>
</div>


</body>
</html>
