<?php
function MailGonder()
{
	date_default_timezone_set("Europe/Istanbul");
	$mail_adresi = $_POST['mail_adresi'];
	$mail_mesaji = $_POST['mail_mesaji'];
	$mail_ad_soyad = $_POST['mail_ad_soyad'];
	
	include 'class.phpmailer.php';
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->Username = 'fatihinan371905@gmail.com';
	$mail->Password = 'Fatih1905.';
	$mail->SetFrom($mail->Username, $mail_ad_soyad);
	$mail->AddAddress('fatihinan37@hotmail.com', 'fatih inan');
	$mail->CharSet = 'UTF-8';
	$mail->Subject = 'U-TAKİP İLETİŞİM';
	$mail->MsgHTML('Gönderen e-posta: '. $mail_adresi . '<br/>Gönderen ad soyad: ' . $mail_ad_soyad .  '<br/>Mesaj: ' . $mail_mesaji);
	if($mail->Send()) 
	{
		echo '<script type="text/javascript">alert(" Mesajınız başarılı bir şekilde iletilmiştir. "); </script>';
	} 
	else 
	{
		echo '<script type="text/javascript">alert(" Beklenmedik bir hata oluştu. Lütfen daha sonra tekrar deneyiniz. "); </script>';
	}
}

function KullaniciEkle()
{
	$mac_adresi = $_POST['ekle_mac_adresi'];
	$kaynak_ismi = $_POST['ekle_kullanici_ismi'];
	$grup = $_POST['ekle_grup'];
	$durum = $_POST['ekle_durum'];
	
	$servername = "85.159.67.247";
	$username = "hikmetyucel.net";
	$password = "Odtu1997";
	$dbname = "utakip";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");
	$sql = "INSERT INTO kaynak_bilgileri (kaynak_ismi, kaynak_grubu, kaynak_durumu, mac_adresi) VALUES ('$kaynak_ismi', '$grup', '$durum', '$mac_adresi')";
	if ($conn->query($sql) === TRUE) 
	{
    	echo '<script type="text/javascript">alert(" Yeni kayıt başarı ile eklendi. "); </script>';
	} 
	else 
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$sql = "SELECT kaynak_id FROM kaynak_bilgileri WHERE mac_adresi='$mac_adresi' AND kaynak_ismi='$kaynak_ismi'";
	$result = $conn->query($sql);
	$satir = $result->fetch_assoc();
	$kaynak_id = (int)$satir['kaynak_id'];
	
	$sql = "INSERT INTO guncel_konum (kaynak_id, konum_x, konum_y, konum_kat) VALUES ('$kaynak_id', 0, 0, 0)";
	$conn->query($sql);
	
	$sql = "CREATE TABLE gecmis_konum_" . $kaynak_id . "(
  `kaynak_id` int(11) DEFAULT NULL,
  `konum_x` float DEFAULT NULL,
  `konum_y` float DEFAULT NULL,
  `konum_kat` int(11) DEFAULT NULL,
  `zaman` datetime DEFAULT NULL,
  KEY `fk_kaynak_id_gecmis_konum` (`kaynak_id`),
  CONSTRAINT `fk_kaynak_id_gecmis_konum` FOREIGN KEY (`kaynak_id`) REFERENCES `kaynak_bilgileri` (`kaynak_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	$conn->query($sql);
	
	$conn->close();
	
}

function KullaniciGuncelle()
{
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
}

function KullaniciSil()
{
	$mac_adresi = $_POST['sil_mac_adresi'];
	$kaynak_ismi = $_POST['sil_kullanici_ismi'];

	$servername = "85.159.67.247";
	$username = "hikmetyucel.net";
	$password = "Odtu1997";
	$dbname = "utakip";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");
	
	$sql = "SELECT kaynak_id FROM kaynak_bilgileri WHERE mac_adresi='$mac_adresi' AND kaynak_ismi='$kaynak_ismi'";
	$result = $conn->query($sql);
	$satir = $result->fetch_assoc();
	$kaynak_id = (int)$satir['kaynak_id'];
	
	$sql = "DELETE FROM guncel_konum WHERE kaynak_id=$kaynak_id";
	$conn->query($sql);
	
	$sql = "DROP TABLE gecmis_konum_" . $kaynak_id;
	$conn->query($sql);
	
	$sql = "DELETE FROM kaynak_bilgileri WHERE kaynak_id=$kaynak_id";
	if ($conn->query($sql) === TRUE) 
	{
    	echo '<script type="text/javascript">alert(" Kullanıcı kaydı başarı ile silindi. "); </script>';
	} 
	else 
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	$conn->close();
}



function deneme()
{
	echo "a_b_c_d_";
}

function KaynakKonumGetir()
{
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
}


function KaynakBilgileriniGetir()
{
	$servername = "85.159.67.247";
	$username = "hikmetyucel.net";
	$password = "Odtu1997";
	$dbname = "utakip";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$conn->set_charset("utf8");
	
	$sql = "SELECT kaynak_id, kaynak_ismi, kaynak_grubu, kaynak_durumu, mac_adresi FROM kaynak_bilgileri ORDER BY kaynak_id";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) 
	{
		echo "<div class='pencere'>";
		echo "<table id='tablo' width=950 class='gridtable'>"; 
		echo "<tr>";
		echo "<th>MAC Adresi</th>";
		echo "<th>Kullanıcı İsmi</th>";
		echo "<th>Grup</th>";
		echo "<th>Güncel Konum</th>";
		echo "<th>Aktiflik</th>";
		echo "</tr>";

		while($row = $result->fetch_assoc()) 
		{
			$kaynak_id = $row['kaynak_id'];
			$mac_adresi = $row['mac_adresi'];
			$kaynak_ismi = $row['kaynak_ismi'];
			$kaynak_gurubu = $row['kaynak_grubu'];
			$kaynak_durumu = $row['kaynak_durumu'];
			
			$sql = "SELECT konum_x, konum_y, konum_kat FROM guncel_konum WHERE kaynak_id=" . $kaynak_id;
			$result_konum = $conn->query($sql);
			$konum = $result_konum->fetch_assoc();
			$kaynak_konumu = "X:" . $konum['konum_x'] . " Y:" . $konum['konum_y'] . " Kat:" . $konum['konum_kat'];
			
			echo "<tr onclick='myFunction(this)'>"; 
			echo "<td>$mac_adresi</td>";
			echo "<td>$kaynak_ismi</td>";
			echo "<td>$kaynak_gurubu</td>";
			echo "<td>$kaynak_konumu</td>";
			if($kaynak_durumu == "Aktif")
			{
				echo "<td><img src='aktif.png' id='durum_aktif' width=30 height=30 /></td>";
			}
			else
			{
				echo "<td><img src='pasif.png' id='durum_pasif' width=30 height=30 /></td>";
			}
			echo "</tr>"; 
		}
		echo "</table>"; 
		echo "</div>";

	} 
	else 
	{
		echo "0 results";
	}	
	$conn->close();
}


function VeritabaniBaglantiKapat()
{
	mysqli_close($conn);
}

function VeritabaniBaglantiKontrol()
{
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	}
	else
	{
		echo "Connected successfully";
	}
}

?>