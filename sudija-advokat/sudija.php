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

  <style>
  	/* The Modal (background) */
	.modal {
	  display: none; /* Hidden by default */
	  position: fixed; /* Stay in place */
	  z-index: 1; /* Sit on top */
	  left: 0;
	  top: 0;
	  width: 100%; /* Full width */
	  height: 100%; /* Full height */
	  overflow: auto; /* Enable scroll if needed */
	  background-color: rgb(0,0,0); /* Fallback color */
	  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	}

	/* Modal Content/Box */
	.modal-content {
	  background-color: #fefefe;
	  margin: 15% auto; /* 15% from the top and centered */
	  padding: 20px;
	  border: 1px solid #888;
	  width: 80%; /* Could be more or less, depending on screen size */
	}

	/* The Close Button */
	.close {
	  color: #aaa;
	  float: right;
	  font-size: 28px;
	  font-weight: bold;
	}

	.close:hover,
	.close:focus {
	  color: black;
	  text-decoration: none;
	  cursor: pointer;
	}
  </style>

  <script>
  	// Get the modal
		var modal = document.getElementById("myModal");

		// Get the button that opens the modal
		var btn = document.getElementById("myBtn");

		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];

		// When the user clicks on the button, open the modal
		btn.onclick = function() {
		  modal.style.display = "block";
		}

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		  modal.style.display = "none";
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		  if (event.target == modal) {
		    modal.style.display = "none";
		  }
		}
  </script>

  
</head>

<body style="width:50%; margin:auto; text-align:center; color:#080f70; font-size:20px;">

    <a href="../odjava.php" style="color:white; top:5px; float:right;">
        <i">Odjava</i>
    </a>
    
    <!-- The Modal -->
	<div id="myModal" class="modal">
	  	<!-- Modal content -->
	  	<div class="modal-content" id="modalContentId">
	  	<span class="close">&times;</span>
	  	</div>
	</div>
';


$konekcija = new Konekcija("localhost","root","zatvor");
$rez = $konekcija->konektujSe();

$upit = "SHOW COLUMNS FROM zatvorenici";

$rez = $konekcija->izvrsiMySQLUpit($upit);
if (!$rez) die(" Tabela ne postoji.");

echo '<h3 style="color:white; font-size:30px; text-align:left;">U bazi se nalaze sljedeći zatvorenici</h3>';
echo '<table cellspacing="0" cellpadding="0" border="1">';
echo '<tr>';
while ($red=$rez->fetch_array(MYSQLI_ASSOC)){
	
	echo '<th style="background-color:rgba(255,255,255,0.5); padding: 10px 25px;">'.$red['Field'].'</th>';
	
}

echo '<th style="background-color:rgba(255,255,255,0.6); padding: 5px 15px;"></th>';
echo '</tr>';

$upit1 = "SELECT * FROM zatvorenici";
$rez1 = $konekcija->izvrsiMySQLUpit($upit1);
while($red = $rez1->fetch_array(MYSQLI_ASSOC)){
	echo '<tr style="background-color:rgba(255,255,255,0.6); padding: 5px 15px;">';
	foreach($red as $vrijednost ){
		echo '<td>'.$vrijednost.'</td>';
	}
	$v=array_values($red);
	echo '<td style="padding: 5px 50px;"><a href="dosije.php?id='.$v[0].'">Dosije</a></td>';
	echo '</tr>';
}
	

echo '</tr>';
echo '</table>';
echo '<br><a style="font-size: 30px; color:#FFFFFF; background-color:rgba(30,30,30,0.5); padding: 10px 15px;" href="dodaj_zatvorenika.php">DODAJ NOVOG ZATVORENIKA</a><br><br><br>';




echo '</body>

</html>';




?>