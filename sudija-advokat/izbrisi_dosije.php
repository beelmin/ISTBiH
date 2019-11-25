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

  
</head>

<body>';

if(isset($_GET['id'])){

	$konekcija = new Konekcija("localhost","root","zatvor");
	$rez = $konekcija->konektujSe();

	$upit1 = "SELECT * FROM dosije WHERE ID = ".$_GET['id'];
	$rez2 = $konekcija->izvrsiMySQLUpit($upit1);
	$red = $rez2->fetch_array(MYSQLI_ASSOC);
	$v=array_values($red);


	$upit = "DELETE FROM dosije WHERE ID = ".$_GET['id'];
	$rez1 = $konekcija->izvrsiMySQLUpit($upit);

	header ("Location: dosije.php?id=$v[4]");


}




echo "</body>

</html>";




?>