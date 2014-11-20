<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>U-TAKİP</title>

<style type="text/css">

body{
background-color:#CCCCCC;}

.ana{
width:1000px;
margin:0 auto;
text-align:center;}

.banner{
width:1000px;
text-align:center;
height:110px;
background-color:#4972B0;}

.icerik{
width:1000px;
text-align:center;
text-align:left;
height:750px;
background-color:#FFFFFF;}

.menu{
width:250px;
height:400px;
float:left;
background-color:#0099CC;}


.ust_menu{
	padding-top:15px;
}

</style>



</head>

<body>

<div class="ana">

	<div class="banner">
    
    <a href="?Sayfa=Sayfa1"><img class="ust_menu" src="harita.png" width="66" height="80" /></a> &nbsp; 
    <a href="?Sayfa=Sayfa2"><img src="analiz.png" width="66" height="80" /></a> &nbsp;
    <a href="?Sayfa=Sayfa3"><img src="yonetici.png" width="66" height="80" /></a> &nbsp;
    <a href="?Sayfa=Sayfa4"><img src="hakkinda.png" width="66" height="80" /></a> &nbsp;
    <a href="?Sayfa=Sayfa5"><img src="yardim.png" width="66" height="80" /></a> &nbsp;
    </div>
    
    <div class="icerik">
		<?php
		
		if (isset($_GET['Yardim'])) 
		{
			include('Sayfa5.php');
		}
		else if (isset($_GET['Yonetici'])) 
		{
			$yonetici_islem_id = $_GET['Yonetici'];
			include_once "veritabani.php";
			
			switch($yonetici_islem_id)
			{
				case '1' : KullaniciEkle();
					break;
				case '2' : KullaniciGuncelle();
					break;
				case '3': KullaniciSil();
					break;
			}

			include('Sayfa3.php');
		}
		else
		{
			if (isset($_GET['Sayfa'])) 
			{
				$Sayfa = $_GET['Sayfa'];
				switch($Sayfa)
				{
					case 'Sayfa1' : include('Sayfa1.php'); break;
					case 'Sayfa2' : include('Sayfa2.php'); break;
					case 'Sayfa3' : include('Sayfa3.php'); break;
					case 'Sayfa4' : include('Sayfa4.php'); break;
					case 'Sayfa5' : include('Sayfa5.php'); break;
					default : include('Sayfa1.php'); break;
				}
			}
			else
			{
				include('Sayfa1.php');
			}
		}
		?>
    </div>
    

    
    </div>

</div>

</body>
</html>
