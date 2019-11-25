<?php
	setcookie("korisnik", false, time() + 24 * 60 * 60, false);
	setcookie("lozinka", false, time() + 24 * 60 * 60, false);
	

	header ("Location: index.php");

	$message = "Uspjesno ste se odjavili";
	echo "<script type='text/javascript'>alert('$message');</script>";
?>