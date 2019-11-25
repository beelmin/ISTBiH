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

  <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Custom styles for this template -->
  <link href="../css/coming-soon.min.css" rel="stylesheet">

  <title>IST BiH</title>

  <link rel="icon" href="favicon.ico" type="image/x-icon"/ >

  
</head>

<body style="width:50%; margin:auto; padding:0; font-size:20px 0px;">';


if(isset($_POST['potvrdi'])){

	
	$konekcija = new Konekcija("localhost", "root", "zatvor");
	$rezKonekcije = $konekcija->konektujSe();
	if(!$rez) die($konekcija->error);

	$sql = "INSERT INTO dosije VALUES(null,'". $_POST['razlog_kazne'] ."'," . "'" . $_POST['duzina_trajanja'] . "'," . "'" . $_POST['ime_zatvora'] . "'," . "'".$_GET['zatvorenikid']."')";
	
	$rez = $konekcija->izvrsiMySQLUpit($sql);

	$id=$_GET['zatvorenikid'];

	header("Location: dosije.php?id=$id");

}else{
	$forma='<form action="" method="post" style="background-color:rgba(200,200,200,0.4); padding: 20px; margin-top:20px;">';	
	$forma.='<h3 style="color:white; font-size:20px; text-align:center; margin-top:30px;">Unesi podatke za novi dosije datog zatvorenika</h3><br>';
	$forma.='Razlog kazne : <input type="text" name="razlog_kazne" size="10" required /><br>';
	$forma.='Dužina trajanja : <input type="text" name="duzina_trajanja" size="10" required /><br>';
	$forma.='Ime zatvora : <input type="text" name ="ime_zatvora" size="10" required /><br>';
	$forma.='<input type="submit" name="potvrdi" value="Potvrdi" />';
	$forma.="<a href='dosije.php?id=".$_GET['zatvorenikid']."'> <input type='button' value='Nazad' /></a>";
	$forma.="</form>";
	echo $forma;
}


echo "</body>

</html>";




?>