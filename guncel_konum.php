<?php
	$tum_konumlar = "";
	$servername = "85.159.67.247";
	$username = "hikmetyucel.net";
	$password = "Odtu1997";
	$dbname = "utakip";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");
	$sql = "SELECT konum_x, konum_y, konum_kat FROM guncel_konum";
	$result = $conn->query($sql);
	
	while($row = $result->fetch_assoc()) 
	{
		$kaynak_konumu = "X:" . $row['konum_x'] . " Y:" . $row['konum_y'] . " Kat:" . $row['konum_kat'];
		$tum_konumlar = $tum_konumlar . $kaynak_konumu . "_";
	}
	echo $tum_konumlar;
	$conn->close();
?>