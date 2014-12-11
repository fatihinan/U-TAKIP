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
</style>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

<script>
var overlay;
var google_maps;
USGSOverlay.prototype = new google.maps.OverlayView();

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

  var srcImage = 'http://www.e-birge.com/img/kroki.png';

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
		"    <td><input type='text' value='"+ grup +"' name='guncelle_grup' id='guncelle_grup'></td>"+
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

var markers = [];

function MarkerEkle(lat, lon, kullanici_adi, i, mac, grup, durum)
{	 
  var myLatlng = new google.maps.LatLng(lat, lon);
  
  if(i<markers.length)
  {
	  markers[i].setPosition(myLatlng);
	  markers[i].setTitle(str);
  }
  else
  {
	  var marker = new google.maps.Marker({
		  position: myLatlng,
		  map: google_maps,
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
		"    <td><input type='text' value='"+ grup +"' name='guncelle_grup' id='guncelle_grup'></td>"+
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
		
		for(index=0; index<array_konumlar.length-1; index++)
		{
			var array_kullanici_konum = array_konumlar[index].split("/");
			var konum_x = array_kullanici_konum[0];
			var konum_y = array_kullanici_konum[1];
			var kaynak_isim = array_kullanici_konum[3];
			var kaynak_durum = array_kullanici_konum[4];
			var mac = array_kullanici_konum[5];
			var grup = array_kullanici_konum[6];
			var durum = array_kullanici_konum[7];
			
			var d_lat = 39.74676581119369 + ((konum_y * 0.00017444771024)/19.4);
			var d_lon = 30.47443736263356 + ((konum_x * 0.00026672364924)/22.8);
			
			MarkerEkle(d_lat, d_lon, kaynak_isim, index, mac, grup, durum);
		}
		setTimeout(KonumGuncelle, 3000);
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
