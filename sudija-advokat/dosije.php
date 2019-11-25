<?php

require_once("konekcija.php");
require_once("autorizacija.php");

if(!$jelSudija) die("Zabranjen pristup");

echo '<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>IST BiH</title>

  <link rel="icon" href="favicon.ico" type="image/x-icon"/ >

  <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Custom styles for this template -->
  <link href="../css/coming-soon.min.css" rel="stylesheet">

  
</head>

<body style="width:60%; margin:auto; text-align:center; color:#080f70; font-size:20px;">';


$konekcija = new Konekcija("localhost","root","zatvor");
$rez = $konekcija->konektujSe();

$upit = "SHOW COLUMNS FROM dosije";

$rez = $konekcija->izvrsiMySQLUpit($upit);
if (!$rez) die(" Tabela ne postoji.");

echo '<h3 style="color:white; font-size:30px; text-align:center;">Dosije datog zatvorenika</h3>';
echo '<table cellspacing="0" cellpadding="0" border="1">';
echo '<tr>';
while ($red=$rez->fetch_array(MYSQLI_ASSOC)){
	
	echo '<th style="background-color:rgba(255,255,255,0.5); padding: 10px 25px;">'.$red['Field'].'</th>';
	
}

echo '<th style="background-color:rgba(255,255,255,0.5); padding: 10px 25px;"></th>';
echo '<th style="background-color:rgba(255,255,255,0.5); padding: 10px 25px;"></th>';
echo "</tr>";

$upit1 = "SELECT * FROM dosije WHERE ZatvorenikID=".$_GET['id'];
$rez1 = $konekcija->izvrsiMySQLUpit($upit1);
while($red = $rez1->fetch_array(MYSQLI_ASSOC)){
	echo '<tr style="background-color:rgba(255,255,255,0.5); padding: 10px 25px;">';
	foreach($red as $vrijednost ){
		echo '<td>'.$vrijednost.'</td>';
	}
	$v=array_values($red);
	echo '<td style="background-color:rgba(255,255,255,0.5); padding: 10px 25px;"><a href="izmjeni_dosije.php?id='.$v[0].'">Izmijeni</a></td>';
	echo '<td style="background-color:rgba(255,255,255,0.5); padding: 10px 25px;"><a href="izbrisi_dosije.php?id='.$v[0].'">Izbriši</a></td>';
	echo "</tr>";
}
	

echo '</tr>';
echo "</table><br>";
echo '<a style="font-size: 30px; color:#FFFFFF; background-color:rgba(200,200,200,0.5); padding: 10px 15px; margin:20px;" href="dodaj_dosije.php?zatvorenikid='.$_GET['id'].'">Dodaj novi dosije</a><br><br>';
echo '<a href="sudija.php" style="font-size: 30px; color:#FFFFFF; background-color:rgba(200,200,200,0.5); padding: 10px 15px; margin:20px;">Nazad</a>';




echo "</body>

</html>";




?>