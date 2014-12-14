<?php
	$tum_konumlar = "";
	$servername = "85.159.67.247";
	$username = "hikmetyucel.net";
	$password = "Odtu1997";
	$dbname = "utakip";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");
	$grup = $_POST['grup'];
	$sql = "SELECT * FROM kaynak_bilgileri WHERE kaynak_grubu='" . $grup . "'";
	$result = $conn->query($sql);
	
	while($row = $result->fetch_assoc()) 
	{
		$kaynak_konumu = $row['kaynak_id'] . "/" . $row['kaynak_ismi'];
		
		$tum_konumlar = $tum_konumlar . $kaynak_konumu . "_";
	}
	echo $tum_konumlar;
	$conn->close();
?>