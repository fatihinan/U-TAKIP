<?php
	$tum_konumlar = "";
	$servername = "85.159.67.247";
	$username = "hikmetyucel.net";
	$password = "Odtu1997";
	$dbname = "utakip";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");
	$sql = "SELECT konum_x, konum_y, konum_kat, kaynak_ismi, kaynak_durumu, mac_adresi, kaynak_grubu, kaynak_durumu FROM guncel_konum, kaynak_bilgileri WHERE guncel_konum.kaynak_id=kaynak_bilgileri.kaynak_id";
	$result = $conn->query($sql);
	
	while($row = $result->fetch_assoc()) 
	{
		$kaynak_konumu = $row['konum_x'] . "/" . $row['konum_y'] . "/" . $row['konum_kat'] . "/" . 
		$row['kaynak_ismi'] . "/" . $row['kaynak_durumu'] . "/" . $row['mac_adresi'] . "/" . $row['kaynak_grubu'] . "/" . $row['kaynak_durumu'];
		
		$tum_konumlar = $tum_konumlar . $kaynak_konumu . "_";
	}
	echo $tum_konumlar;
	$conn->close();
?>