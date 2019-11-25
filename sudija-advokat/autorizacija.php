<?php

require_once("konekcija.php");

if (isset( $_COOKIE['korisnik'] ) && isset( $_COOKIE['lozinka'] ) && strlen( $_COOKIE['korisnik'] ) > 0 && strlen( $_COOKIE['lozinka'] ) > 0 ){
		
		
		
 		$korisnik = $_COOKIE['korisnik'];
		$lozinka = $_COOKIE['lozinka'];


		$konekcija = new Konekcija("localhost","root","zatvor");
		$rezKonekcije = $konekcija->konektujSe();
		$upit = "SELECT * FROM korisnici WHERE username = '".$korisnik."' AND password = '".$lozinka."'";
		
		$rez=$konekcija->izvrsiMySQLUpit($upit);
		
		if(!$rez) die($konekcija->error);
		
		if($rez->num_rows==0) header ("Location: ../index.php");
		
		$red =$rez->fetch_array(MYSQLI_ASSOC);
		
		
		if ($red['username'] == "sudija") $jelSudija = 1;
		
		else $jelSudija = 0;
		
		
		
}else{
	header ("Location: ../index.php");

} 


?>