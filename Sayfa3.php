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

.red { background-color: red; }

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
margin:10px;
margin-top:0px;
padding:10px;
}

.bos
{
	height:10px;
	width:1000px;
}

table.gridtable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
}
table.gridtable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	background-color: #dedede;
}
table.gridtable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #666666;
	text-align:center;
}

.alt_bos
{
	height:200px;
	width:1000px;
}
</style>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
var kaynak_secili_mi = 0;
function myFunction(x) 
{
	var rows = document.getElementsByTagName("tr");
	for(i = 0; i < rows.length; i++)
	{  
		rows[i].setAttribute("style", "background:#FFFFFF");
	}
	x.setAttribute("style", "background:#66CCFF");
	
	var elem = document.getElementById("guncelle_mac_adresi");
	elem.value = x.cells[0].innerHTML;
	var elem = document.getElementById("guncelle_mac_adresi_eski");
	elem.value = x.cells[0].innerHTML;
	var elem = document.getElementById("guncelle_kullanici_ismi");
	elem.value = x.cells[1].innerHTML;
	var elem = document.getElementById("guncelle_grup");
	elem.value = x.cells[2].innerHTML;
	
	var elem = document.getElementById("sil_mac_adresi");
	elem.value = x.cells[0].innerHTML;
	var elem = document.getElementById("sil_kullanici_ismi");
	elem.value = x.cells[1].innerHTML;
	var elem = document.getElementById("sil_grup");
	elem.value = x.cells[2].innerHTML;

	var dd_guncelle = document.getElementById('guncelle_durum');
	var dd_sil = document.getElementById('sil_durum');
	var image = x.getElementsByTagName("img");
	if(image[0].id=='durum_aktif')
	{
		dd_guncelle.selectedIndex=0;
		dd_sil.selectedIndex=0;
	}
	else
	{
		dd.selectedIndex=1;
		dd_sil.selectedIndex=1;
	}
	kaynak_secili_mi = 1;
}

function ShowDiv(div_name) 
{
	if(div_name=="div_ekle")
	{
		document.getElementById("div_ana").style.display = "none";
		document.getElementById("sakla").style.display = "none";
		document.getElementById(div_name).style.display = "block";
	}
	else
	{
		if(kaynak_secili_mi==1)
		{
			document.getElementById("div_ana").style.display = "none";
			document.getElementById("sakla").style.display = "none";
			document.getElementById(div_name).style.display = "block";
		}
		else
		{
			alert(" Silinecek/Güncellenecek kaynağı seçiniz. ");
		}
	}
}

function KonumGuncelle()
{	 
	$.get("guncel_konum.php", function(data){
		var array_konumlar = data.split("_");
		var table = document.getElementById("tablo");
		for (var i = 1, row; row = table.rows[i]; i++) 
		{
			row.cells[3].innerHTML = array_konumlar[i-1];
		}
	});
	setTimeout(KonumGuncelle, 3000);
}

KonumGuncelle();
</script>


</head>

<body>

<div class="bos">
</div>

<div id="div_ana">
<?php
   include_once "veritabani.php";
   KaynakBilgileriniGetir(); 
?>
<div id="sakla">
<a id="btn_guncelle" href="?Sayfa=Sayfa3"><img align="right" onClick="ShowDiv('div_guncelle'); return false;" style="margin-right:40" id="btn" src="guncelle.png" width="75" height="28" /></a>
<a href="?Sayfa=Sayfa3"><img align="right" onClick="ShowDiv('div_sil'); return false;" style="margin-right:10" id="btn" src="sil.png" width="75" height="28" /></a>
<a href="?Sayfa=Sayfa3"><img align="right" onClick="ShowDiv('div_ekle'); return false;" style="margin-right:10" id="btn" src="ekle.png" width="75" height="28" /></a>
</div>
</div>
 <input type="text" style="visibility:hidden" name="konum_icin_mac" id="konum_icin_mac">
<div id="div_ekle" style="display:none">
<form action="masterpage.php?Yonetici=1" method="post">
<caption>YENİ KULLANICI EKLE</caption>
<table class="gridtable" style="border:none; text-align:left">
  <tr>
    <th scope="row">MAC Adresi</th>
    <td>:</td>
    <td><input type="text" name="ekle_mac_adresi" id="ekle_mac_adresi"></td>
  </tr>
  <tr>
    <th scope="row">Kullanıcı İsmi</th>
    <td>:</td>
    <td><input type="text" name="ekle_kullanici_ismi"></td>
  </tr>
  <tr>
    <th scope="row">Grup</th>
    <td>:</td>
    <td><input type="text" name="ekle_grup"></td>
  </tr>
    <tr>
    <th scope="row">Durum</th>
    <td>:</td>
    <td><select name="ekle_durum" id="ekle_durum">
    <option value="Aktif">Aktif</option>
    <option value="Pasif">Pasif</option>
    </select></td>
  </tr>
  <tr>
    <th scope="row"><input type="submit" name="btn_submit" value="ONAYLA"/></th>
    <td></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>  



<div id="div_guncelle" style="display:none">
<form action="masterpage.php?Yonetici=2" method="post">
<caption>KULLANICI BİLGİLERİNİ GÜNCELLE</caption>
<table class="gridtable" style="border:none; text-align:left">
  <tr>
    <th scope="row">MAC Adresi</th>
    <td>:</td>
    <td><input type="text" name="guncelle_mac_adresi" id="guncelle_mac_adresi"></td>
  </tr>
  <tr>
    <th scope="row">Kullanıcı İsmi</th>
    <td>:</td>
    <td><input type="text" name="guncelle_kullanici_ismi" id="guncelle_kullanici_ismi"></td>
  </tr>
  <tr>
    <th scope="row">Grup</th>
    <td>:</td>
    <td><input type="text" name="guncelle_grup" id="guncelle_grup"></td>
  </tr>
  <tr>
    <th scope="row">Durum</th>
    <td>:</td>
    <td><select name="guncelle_durum" id="guncelle_durum">
    <option value="Aktif">Aktif</option>
    <option value="Pasif">Pasif</option>
    </select></td>
  </tr>
  <tr>
    <th scope="row"><input type="submit" name="btn_submit" value="ONAYLA"/></th>
    <td>&nbsp;</td>
    <td><input type="text" style="visibility:hidden" name="guncelle_mac_adresi_eski" id="guncelle_mac_adresi_eski"></td>
  </tr>
</table>
</form>
</div>


<div id="div_sil" style="display:none">
<form action="masterpage.php?Yonetici=3" method="post">
<caption>KULLANICI SİL</caption>
<table class="gridtable" style="border:none; text-align:left">
  <tr>
    <th scope="row">MAC Adresi</th>
    <td>:</td>
    <td><input type="text" name="sil_mac_adresi" id="sil_mac_adresi" readonly></td>
  </tr>
  <tr>
    <th scope="row">Kullanıcı İsmi</th>
    <td>:</td>
    <td><input type="text" name="sil_kullanici_ismi" id="sil_kullanici_ismi" readonly></td>
  </tr>
  <tr>
    <th scope="row">Grup</th>
    <td>:</td>
    <td><input type="text" name="sil_grup" id="sil_grup" readonly></td>
  </tr>
  <tr>
    <th scope="row">Durum</th>
    <td>:</td>
    <td><select name="sil_durum" id="sil_durum" disabled>
    <option value="Aktif">Aktif</option>
    <option value="Pasif">Pasif</option>
    </select></td>
  </tr>
  <tr>
    <th scope="row"><input type="submit" name="btn_submit" value="ONAYLA"/></th>
    <td>&nbsp;</td>
    <td></td>
  </tr>
</table>
</form>
</div>



</body>
</html>
