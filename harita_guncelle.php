<?php	
    $mac_adresi = $_POST['guncelle_mac_adresi'];
	$kaynak_ismi = $_POST['guncelle_kullanici_ismi'];
	$grup = $_POST['guncelle_grup'];
	$durum = $_POST['guncelle_durum'];
	$mac_adresi_eski = $_POST['guncelle_mac_adresi_eski'];

	$servername = "85.159.67.247";
	$username = "hikmetyucel.net";
	$password = "Odtu1997";
	$dbname = "utakip";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");
	
	$sql = "UPDATE kaynak_bilgileri SET kaynak_ismi='$kaynak_ismi', mac_adresi='$mac_adresi',  kaynak_grubu='$grup', kaynak_durumu='$durum' WHERE mac_adresi='$mac_adresi_eski'";
	if ($conn->query($sql) === TRUE) 
	{
    	echo '<script type="text/javascript">alert(" Kullanıcı bilgileri başarı ile güncellendi. "); </script>';
	} 
	else 
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
?>