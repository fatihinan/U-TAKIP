<?php
	$tum_konumlar = "";
	$servername = "85.159.67.247";
	$username = "hikmetyucel.net";
	$password = "Odtu1997";
	$dbname = "utakip";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");
	$id = $_POST['kullanici_id'];
	$sql = "SELECT konum_x, konum_y, konum_kat, zaman FROM gecmis_konum_" . $id;
	$result = $conn->query($sql);
	
	while($row = $result->fetch_assoc()) 
	{
		$kaynak_konumu = $row['konum_x'] . "/" . $row['konum_y'] . "/" . $row['konum_kat'] . "/" . $row['zaman'];
		
		$tum_konumlar = $tum_konumlar . $kaynak_konumu . "_";
	}
	echo $tum_konumlar;
	$conn->close();
?>