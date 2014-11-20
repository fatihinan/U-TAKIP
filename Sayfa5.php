<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>


<script language="javascript" type="text/javascript">
function ShowDiv() 
{
	document.getElementById('div_iletisim').style.display = "block";
	document.getElementById('lbl_iletisim').innerHTML = '<br />';
}
</script>

<style type="text/css">

.divv{
margin-top:0px;
background-color:#FFF;	
clear:both;
}

#btn{
margin-left:10px;
background:#FFF;
}


#btn:active{
border-style:solid;
border-width:medium;
border-color:#00C;
border-radius:15px;
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
background-color:#CCC;
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

.mail
{
	width:700px; 
	height:30px;
}

.mesaj
{
	width:700px; 
	height:100px;
	resize:none;
}

.buton
{
	margin-left:50px;
}	

table.gridtable {
	width:700px;
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

</style>

</head>

<body>
<div class="bos">
</div>
<div class="lbl">

 <a href="?Yardim=1"><img id="btn" src="kullanim_klavuzu.png" width="200" height="44" /></a> <br /> 
 <a href="?Yardim=2"><img id="btn" src="sikca_sorulan_sorular.png" width="233" height="44" /></a>  <br />
 <a href="?Yardim=3"><img id="btn" onClick="ShowDiv(); return false;" src="iletisim.png" width="111" height="44" /></a>  <br />

	<?php
		if (isset($_GET['Yardim'])) 
		{
			$Yardim = $_GET['Yardim'];
			switch($Yardim)
			{
				case '1' : $str_yazi = "Kullanım Klavuzu <br /> <br />
				Harita Sekmesinde sistemde bulunan aktif kullanıcıların konumları kroki üzerinde gösterilmektedir.<br /> 
				Analiz Sekmesinde seçilen kullanıcının geçmiş konum bilgileri kroki üzerinde gösterilecektir.<br />
				Yönetisi Sekmesinde Bluetooth Low Energy (BLE) etiketlere atanan kişilerin bilgileri görüntülenebilmekte ve güncellenebilmektedir.						
				<br />
				Hakkında Sekmesinde proje, projeyi gerçekleştiren ekip ve alınan destekler hakkında bilgi verilmektedir.<br />
				Yardım Sekmesinde Kullanım Klavuzu, Sıkça Sorulan Sorular ve İletişim kısımları bulunmaktadır.<br />
				"; break;
				
				case '2' : $str_yazi = "Sıkça Sorulan Sorular <br /> <br />
				Aktif kullanıcıların konumunu nasıl görebilirim? <br /> 
				Harita Sekmesinde sistemde bulunan aktif kullanıcıların konumları kroki üzerinde gösterilmektedir.<br /> <br /> 
				Bir kullanıcının geçmiş olduğu yolları nasıl görebilirim?<br /> 
				Analiz Sekmesinde seçilen kullanıcının geçmiş konum bilgileri kroki üzerinde gösterilecektir.<br /><br />
				Bluetooth Low Energy (BLE) etiketlere atanan kişileri nasıl yönetebilirim?<br />
				Yönetisi Sekmesinde Bluetooth Low Energy (BLE) etiketlere atanan kişilerin bilgileri görüntülenebilmekte ve güncellenebilmektedir.						
				<br /><br />
				Proje hakkındaki bilgileri nasıl edinebilirim?<br />
				Hakkında Sekmesinde proje, projeyi gerçekleştiren ekip ve alınan destekler hakkında bilgi verilmektedir.<br /> <br /> 
				Kullanım Klavuzuna nasıl ulaşabilirim? Sizinle nasıl iletişime geçebilirim? <br />
				Yardım Sekmesinde Kullanım Klavuzu, Sıkça Sorulan Sorular ve İletişim kısımları bulunmaktadır.<br />
				"; break;
				
				case '3' : $str_yazi = "<br />"; 
					echo '<script type="text/javascript">ShowDiv()</script>'; 
					break;
				case '4' : $str_yazi = "<br />"; 
					include_once "veritabani.php";
					MailGonder(); 
					break;
						 
				default: $str_yazi = "Kullanım Klavuzu"; break;
			}
		}
		else
		{
			$str_yazi = "Kullanım Klavuzu <br /> <br />
				Harita Sekmesinde sistemde bulunan aktif kullanıcıların konumları kroki üzerinde gösterilmektedir.<br /> 
				Analiz Sekmesinde seçilen kullanıcının geçmiş konum bilgileri kroki üzerinde gösterilecektir.<br />
				Yönetisi Sekmesinde Bluetooth Low Energy (BLE) etiketlere atanan kişilerin bilgileri görüntülenebilmekte ve güncellenebilmektedir.						
				<br />
				Hakkınsa Sekmesinde proje, projeyi gerçekleştiren ekip ve alınan destekler hakkında bilgi verilmektedir.<br />
				Yardım Sekmesinde Kullanım Klavuzu, Sıkça Sorulan Sorular ve İletişim kısımları bulunmaktadır.<br />
				";
		}
	?>

        
<div class="pencere">
     <label id="lbl_iletisim">
     <?php echo $str_yazi; ?>
     </label>
<div id="div_iletisim" style="display:none">
<form action="masterpage.php?Yardim=4" method="post">
<table class='gridtable' border="1">
  <tr>
    <th scope="row">Ad Soyad</th>
    <td>:</td>
    <td><input class="mail" type="text" name="mail_ad_soyad"></td>
  </tr>
  <tr>
    <th scope="row">E Mail Adresi</th>
    <td>:</td>
    <td><input class="mail" type="text" name="mail_adresi"></td>
  </tr>
  <tr>
    <th scope="row">Mesaj</th>
    <td>:</td>
    <td><textarea name="mail_mesaji" class="mesaj"></textarea></td>
  </tr>
  <tr>
    <th scope="row"><input type="submit" class="buton" name="btn_submit" value="GÖNDER"/></th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</div>
</div>
 
 
</div>


</body>
</html>
