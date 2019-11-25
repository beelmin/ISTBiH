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





if(isset($_POST['promjeni'])){

	$konekcija = new Konekcija("localhost","root","zatvor");
	$rez = $konekcija->konektujSe();
	
	$upit = "UPDATE dosije SET RazlogKazne = '".$_POST['razlog_kazne']."'".", DuzinaTrajanja = '".$_POST['duzina_trajanja']."'".", ImeZatvora = '".$_POST['ime_zatvora']."' WHERE ID = ".$_GET['id'];
	
	$rez = $konekcija->izvrsiMySQLUpit($upit);


	$upit1 = "SELECT * FROM dosije WHERE ID = ".$_GET['id'];
	$rez1 = $konekcija->izvrsiMySQLUpit($upit1);
	$red = $rez1->fetch_array(MYSQLI_ASSOC);
	$v=array_values($red);

	header ("Location: dosije.php?id=$v[4]");

}else{




	$konekcija = new Konekcija("localhost","root","zatvor");
	$rez = $konekcija->konektujSe();
	$upit = "SHOW COLUMNS FROM dosije";

	$rez = $konekcija->izvrsiMySQLUpit($upit);
	if (!$rez) die(" Tabela ne postoji.");

	echo '<h3 style="color:white; font-size:30px; text-align:center;">Dosije datog zatvorenika</h3>';
	echo '<form action = "" method = "POST">';
	echo '<table cellspacing="0" cellpadding="0" border="1">';
	echo '<tr style="background-color:rgba(255,255,255,0.5); padding: 10px 25px;">';
	while ($red=$rez->fetch_array(MYSQLI_ASSOC)){
		if($red['Field'] != "ID" && $red['Field'] != 'ZatvorenikID'){
			echo '<th style="background-color:rgba(255,255,255,0.5); padding: 10px 25px;">'.$red['Field'].'</th>';

		}
		
	}

	echo "</tr>";

	$upit1 = "SELECT * FROM dosije WHERE ID = ".$_GET['id'];
	$rez1 = $konekcija->izvrsiMySQLUpit($upit1);


	while($red = $rez1->fetch_array(MYSQLI_ASSOC)){
		echo '<tr style="background-color:rgba(255,255,255,0.5); padding: 10px 25px;">';
			
		$v=array_values($red);
		
		echo '<td ><input type="text" name="razlog_kazne" value="'.$v[1].'" /> </td>';
		echo '<td><input type="text" name="duzina_trajanja" value="'.$v[2].'" /> </td>';
		echo '<td><input type="text" name="ime_zatvora" value="'.$v[3].'" /> </td>';
		$zatvorenik_id = $v[4];

		
		
		echo "</tr>";
	}
		

	echo '</tr>';
	echo "</table>";
	echo '<br><input type = "submit" name="promjeni" value = "Promijeni!"/><br>';
	echo '<a href="dosije.php?id='.$zatvorenik_id.'"> <input type = "button" value="Nazad" /> </a>';
	echo '</form>';

}





echo "</body>

</html>";




?>