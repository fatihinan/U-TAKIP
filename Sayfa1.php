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

function Guncelle()
{
	var elem = document.getElementById("guncelle_mac_adresi");
	mac = elem.value;
	var elem = document.getElementById("guncelle_mac_adresi_eski");
	mac_eski = elem.value;
	var elem = document.getElementById("guncelle_kullanici_ismi");
	kullanici_ismi = elem.value;
	var elem = document.getElementById("guncelle_grup");
	grup = elem.value;
	var elem = document.getElementById("guncelle_durum");
	durum = elem.value;
	var elem = document.getElementById("kullanici_ismi_eski");
	kullanici_ismi_eski = elem.value;

	$.post("harita_guncelle.php",{ guncelle_mac_adresi: mac, guncelle_kullanici_ismi: kullanici_ismi, guncelle_grup: grup, guncelle_durum: durum, guncelle_mac_adresi_eski: mac_eski }).done(function(data)
	{
	});
	
	for(var i=0; i<markers.length; i++)
	{
		if(markers[i].getTitle()==kullanici_ismi_eski)
		{
		  markers[i].setTitle(kullanici_ismi);
		  var icon_color;
		  if(grup=="Öğrenci") icon_color = "red-dot.png"; 
		  else if (grup=="Öğretmen") icon_color = "yellow-dot.png"; 
		  else if (grup=="Hizmetli") icon_color = "green-dot.png";
		  else if (grup=="Güvenlik") icon_color = "blue-dot.png"; 
		  else if (grup=="Araç") icon_color = "purple-dot.png";
		  else icon_color = "orange-dot.png";
		  markers[i].setIcon("http://maps.google.com/mapfiles/ms/icons/"+icon_color);
		  google.maps.event.addListener(markers[i], 'click', function() {
		  
		  var select_durum;
		  if(durum=="Aktif")
		  {
			  select_durum = "<option value='Aktif'>Aktif</option>"+
							"<option value='Pasif'>Pasif</option>"
		  }
		  else
		  {
			  select_durum = "<option value='Pasif'>Pasif</option>"+
							"<option value='Aktif'>Aktif</option>"
		  }
		  
		  var select_grup;
		  if(grup=="Öğrenci")
		  {
			  select_grup="<option value='Öğrenci'>Öğrenci</option>"+
			 "<option value='Öğretmen'>Öğretmen</option>"+
			 "<option value='Hizmetli'>Hizmetli</option>"+
			 "<option value='Güvenlik'>Güvenlik</option>"+
			 "<option value='Araç'>Araç</option>"+
			 "<option value='Diğer'>Diğer</option>";
		  }
		  else if(grup=="Öğretmen")
		  {
			  select_grup="<option value='Öğretmen'>Öğretmen</option>"+
			 "<option value='Öğrenci'>Öğrenci</option>"+
			 "<option value='Hizmetli'>Hizmetli</option>"+
			 "<option value='Güvenlik'>Güvenlik</option>"+
			 "<option value='Araç'>Araç</option>"+
			 "<option value='Diğer'>Diğer</option>";
		  }
		  else if(grup=="Hizmetli")
		  {
			  select_grup="<option value='Hizmetli'>Hizmetli</option>"+
			 "<option value='Öğretmen'>Öğretmen</option>"+
			 "<option value='Öğrenci'>Öğrenci</option>"+
			 "<option value='Güvenlik'>Güvenlik</option>"+
			 "<option value='Araç'>Araç</option>"+
			 "<option value='Diğer'>Diğer</option>";
		  }
		  else if(grup=="Güvenlik")
		  {
			  select_grup="<option value='Güvenlik'>Güvenlik</option>"+
			  "<option value='Hizmetli'>Hizmetli</option>"+
			 "<option value='Öğretmen'>Öğretmen</option>"+
			 "<option value='Öğrenci'>Öğrenci</option>"+
			 "<option value='Araç'>Araç</option>"+
			 "<option value='Diğer'>Diğer</option>";
		  }
		  else if(grup=="Araç")
		  {
			  select_grup="<option value='Araç'>Araç</option>"+
			  "<option value='Güvenlik'>Güvenlik</option>"+
			  "<option value='Hizmetli'>Hizmetli</option>"+
			 "<option value='Öğretmen'>Öğretmen</option>"+
			 "<option value='Öğrenci'>Öğrenci</option>"+
			 "<option value='Diğer'>Diğer</option>";
		  }
		  else
		  {
			  select_grup="<option value='Diğer'>Diğer</option>"+
			  "<option value='Güvenlik'>Güvenlik</option>"+
			  "<option value='Hizmetli'>Hizmetli</option>"+
			 "<option value='Öğretmen'>Öğretmen</option>"+
			 "<option value='Öğrenci'>Öğrenci</option>"+
			 "<option value='Araç'>Araç</option>";
		  }
		  
		  var contentString = "<div id='div_guncelle'>"+
		"<caption>KULLANICI BİLGİLERİNİ GÜNCELLE</caption>"+
		"<table class='gridtable' style='border:none; text-align:left'>"+
		"  <tr>"+
		"    <th scope='row'>MAC Adresi</th>"+
		"    <td>:</td>"+
		"    <td><input type='text' value='"+  mac +"' name='guncelle_mac_adresi' id='guncelle_mac_adresi'></td>"+
		"  </tr>"+
		"  <tr>"+
		"    <th scope='row'>Kullanıcı İsmi</th>"+
		"    <td>:</td>"+
		"    <td><input type='text' value='"+ kullanici_ismi +"' name='guncelle_kullanici_ismi' id='guncelle_kullanici_ismi'></td>"+
		"  </tr>"+
		"  <tr>"+
		"    <th scope='row'>Grup</th>"+
		"    <td>:</td>"+
		"    <td><select name='guncelle_grup' id='guncelle_grup'>"+
		select_grup+
		"</select></td>"+
		"  </tr>"+
		"  <tr>"+
		"    <th scope='row'>Durum</th>"+
		"    <td>:</td>"+
		"    <td><select name='guncelle_durum' id='guncelle_durum'>"+
		select_durum+
		"    </select></td>"+
		"  </tr>"+
		"  <tr>"+
		"    <th scope='row'><a href='#'><img align='right' onClick='Guncelle(); return false;' style='margin-right:10' id='btn' src='guncelle.png' width='75' height='28' /></a></th>"+
		"    <td>&nbsp;</td>"+
		"    <td><input type='text' value='"+  mac +"' style='visibility:hidden' name='guncelle_mac_adresi_eski' id='guncelle_mac_adresi_eski'>"+
		"<input type='text' value='"+  kullanici_ismi +"' style='display:none' name='kullanici_ismi_eski' id='kullanici_ismi_eski'></td>"+
		"  </tr>"+
		"</table>"+
		"</div>";
		
		infowindow.setContent(contentString);
		infowindow.open(google_maps,markers[i]);
	  });
		}
	}
	
}

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

function MarkerEkle(lat, lon, kullanici_adi, i, mac, grup, durum)
{	 
  var myLatlng = new google.maps.LatLng(lat, lon);
  
  if(i<markers.length)
  {
	  markers[i].setPosition(myLatlng);
	  markers[i].setTitle(kullanici_adi);
  }
  else
  {
	  var icon_color;
	  if(grup=="Öğrenci") icon_color = "red-dot.png"; 
	  else if (grup=="Öğretmen") icon_color = "yellow-dot.png"; 
	  else if (grup=="Hizmetli") icon_color = "green-dot.png";
	  else if (grup=="Güvenlik") icon_color = "blue-dot.png"; 
	  else if (grup=="Araç") icon_color = "purple-dot.png";
	  else icon_color = "orange-dot.png";
	  
	  
	  var marker = new google.maps.Marker({
		  position: myLatlng,
		  map: google_maps,
		  icon: "http://maps.google.com/mapfiles/ms/icons/" + icon_color,
		  animation: google.maps.Animation.DROP,
		  title: kullanici_adi
	  });
	  
	  google.maps.event.addListener(marker, 'click', function() {
		  
		  var select_durum;
		  if(durum=="Aktif")
		  {
			  select_durum = "<option value='Aktif'>Aktif</option>"+
							"<option value='Pasif'>Pasif</option>"
		  }
		  else
		  {
			  select_durum = "<option value='Pasif'>Pasif</option>"+
							"<option value='Aktif'>Aktif</option>"
		  }
		  
		  var select_grup;
		  if(grup=="Öğrenci")
		  {
			  select_grup="<option value='Öğrenci'>Öğrenci</option>"+
			 "<option value='Öğretmen'>Öğretmen</option>"+
			 "<option value='Hizmetli'>Hizmetli</option>"+
			 "<option value='Güvenlik'>Güvenlik</option>"+
			 "<option value='Araç'>Araç</option>"+
			 "<option value='Diğer'>Diğer</option>";
		  }
		  else if(grup=="Öğretmen")
		  {
			  select_grup="<option value='Öğretmen'>Öğretmen</option>"+
			 "<option value='Öğrenci'>Öğrenci</option>"+
			 "<option value='Hizmetli'>Hizmetli</option>"+
			 "<option value='Güvenlik'>Güvenlik</option>"+
			 "<option value='Araç'>Araç</option>"+
			 "<option value='Diğer'>Diğer</option>";
		  }
		  else if(grup=="Hizmetli")
		  {
			  select_grup="<option value='Hizmetli'>Hizmetli</option>"+
			 "<option value='Öğretmen'>Öğretmen</option>"+
			 "<option value='Öğrenci'>Öğrenci</option>"+
			 "<option value='Güvenlik'>Güvenlik</option>"+
			 "<option value='Araç'>Araç</option>"+
			 "<option value='Diğer'>Diğer</option>";
		  }
		  else if(grup=="Güvenlik")
		  {
			  select_grup="<option value='Güvenlik'>Güvenlik</option>"+
			  "<option value='Hizmetli'>Hizmetli</option>"+
			 "<option value='Öğretmen'>Öğretmen</option>"+
			 "<option value='Öğrenci'>Öğrenci</option>"+
			 "<option value='Araç'>Araç</option>"+
			 "<option value='Diğer'>Diğer</option>";
		  }
		  else if(grup=="Araç")
		  {
			  select_grup="<option value='Araç'>Araç</option>"+
			  "<option value='Güvenlik'>Güvenlik</option>"+
			  "<option value='Hizmetli'>Hizmetli</option>"+
			 "<option value='Öğretmen'>Öğretmen</option>"+
			 "<option value='Öğrenci'>Öğrenci</option>"+
			 "<option value='Diğer'>Diğer</option>";
		  }
		  else
		  {
			  select_grup="<option value='Diğer'>Diğer</option>"+
			  "<option value='Güvenlik'>Güvenlik</option>"+
			  "<option value='Hizmetli'>Hizmetli</option>"+
			 "<option value='Öğretmen'>Öğretmen</option>"+
			 "<option value='Öğrenci'>Öğrenci</option>"+
			 "<option value='Araç'>Araç</option>";
		  }
		  
		  var contentString = "<div id='div_guncelle'>"+
		"<caption>KULLANICI BİLGİLERİNİ GÜNCELLE</caption>"+
		"<table class='gridtable' style='border:none; text-align:left'>"+
		"  <tr>"+
		"    <th scope='row'>MAC Adresi</th>"+
		"    <td>:</td>"+
		"    <td><input type='text' value='"+  mac +"' name='guncelle_mac_adresi' id='guncelle_mac_adresi'></td>"+
		"  </tr>"+
		"  <tr>"+
		"    <th scope='row'>Kullanıcı İsmi</th>"+
		"    <td>:</td>"+
		"    <td><input type='text' value='"+ kullanici_adi +"' name='guncelle_kullanici_ismi' id='guncelle_kullanici_ismi'></td>"+
		"  </tr>"+
		"  <tr>"+
		"    <th scope='row'>Grup</th>"+
		"    <td>:</td>"+
		"    <td><select name='guncelle_grup' id='guncelle_grup'>"+
    	select_grup+
    	"	</select></td>"+
		"  </tr>"+
		"  <tr>"+
		"    <th scope='row'>Durum</th>"+
		"    <td>:</td>"+
		"    <td><select name='guncelle_durum' id='guncelle_durum'>"+
		select_durum+
		"    </select></td>"+
		"  </tr>"+
		"  <tr>"+
		"    <th scope='row'><a href='#'><img align='right' onClick='Guncelle(); return false;' style='margin-right:10' id='btn' src='guncelle.png' width='75' height='28' /></a></th>"+
		"    <td>&nbsp;</td>"+
		"    <td><input type='text' value='"+  mac +"' style='visibility:hidden' name='guncelle_mac_adresi_eski' id='guncelle_mac_adresi_eski'>"+
		"<input type='text' value='"+  kullanici_adi +"' style='display:none' name='kullanici_ismi_eski' id='kullanici_ismi_eski'></td>"+
		"  </tr>"+
		"</table>"+
		"</div>";
		
		infowindow.setContent(contentString);
		infowindow.open(google_maps,marker);
	  });
	  
	 markers.push(marker);
  }
}


var infowindow = new google.maps.InfoWindow();

function KonumGuncelle()
{	
	$.get("guncel_konum_kaynak_bilgileri.php", function(data){
		var array_konumlar = data.split("_");
		var str;
		var index;
		var sayac = 0;
		for(index=0; index<array_konumlar.length; index++)
		{
			var array_kullanici_konum = array_konumlar[index].split("/");
			var konum_x = array_kullanici_konum[0];
			var konum_y = array_kullanici_konum[1];
			var konum_kat = array_kullanici_konum[2];
			var kaynak_isim = array_kullanici_konum[3];
			var kaynak_durum = array_kullanici_konum[4];
			var mac = array_kullanici_konum[5];
			var grup = array_kullanici_konum[6];
			var durum = array_kullanici_konum[7];
			
			var d_lat = 39.74676581119369 + ((konum_y * 0.00017444771024)/19.4);
			var d_lon = 30.47443736263356 + ((konum_x * 0.00026672364924)/22.8);

			
			if(konum_kat == guncel_kat && durum=="Aktif")
			{
				MarkerEkle(d_lat, d_lon, kaynak_isim, sayac, mac, grup, durum);
				++sayac;
			}
		}
		setTimeout(KonumGuncelle, 2500);
	});
}

KonumGuncelle();

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
