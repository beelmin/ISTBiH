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

<body style="width:50%; margin:auto; padding:0; font-size:20px 0px;">';


if(isset($_POST['potvrdi'])){

	
	$konekcija = new Konekcija("localhost", "root", "zatvor");
	$rezKonekcije = $konekcija->konektujSe();
	if(!$rez) die($konekcija->error);

	$sql = "INSERT INTO zatvorenici VALUES(null,'". $_POST['ime'] ."'," . "'" . $_POST['prezime'] . "'," . "'" . $_POST['jmbg'] . "'," . "'".$_POST['datum_rodjenja']."')";
	echo "<script type='text/javascript'>alert('$sql');</script>";
	$rez = $konekcija->izvrsiMySQLUpit($sql);
	header("Location: sudija.php");

}else{
	$forma='<form action="" method="post" style="background-color:rgba(200,200,200,0.4); padding: 20px; margin-top:20px;">';	
	$forma.='<h3 style="color:white; font-size:20px; text-align:center; margin-top:30px;">Unesi podatke za novog zatvorenika</h3><br>';
	$forma.='Ime : <input type="text" name="ime" size="10" required /><br>';
	$forma.='Prezime : <input type="text" name="prezime" size="10" required /><br>';
	$forma.='JMBG : <input type="text" name ="jmbg" size="10" required /><br>';
	$forma.='Datum rođenja : <input type="text" name ="datum_rodjenja" size="10" required /><br>';
	$forma.='<input type="submit" name="potvrdi" value="Potvrdi" style="background-color:rgba(255,255,255,0.4); font-size:20px;"/>';
	$forma.="<a href='sudija.php'> <input type='button' value='Nazad' style='background-color:rgba(255,255,255,0.4); font-size:20px;'/></a>";
	$forma.="</form>";
	echo $forma;
}


echo "</body>

</html>";




?>