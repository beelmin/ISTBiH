<?php

require_once("sudija-advokat/konekcija.php");


echo '<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link href="https://fonts.googleapis.com/css?family=Satisfy:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/coming-soon.min.css" rel="stylesheet">

  <title>IST BiH</title>

  <link rel="icon" href="favicon.ico" type="image/x-icon"/ >

	  <style>
	  	#login_forma{
	  		  margin: auto;
	  		  margin-top: 300px;
			  width: 50%;
			  border: 3px solid;
			  padding: 10px;
		}

		input[type=text]{
		  width: 100%;
		  padding: 10px 10px;
		  margin: 6px 0;
		  display: inline-block;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  box-sizing: border-box;
		}

		input[type=submit] {
		  width: 100%;
		  background-color: #2e2e2e;
		  color: white;
		  padding: 10px 10px;
		  margin: 6px 0;
		  border: none;
		  border-radius: 4px;
		  cursor: pointer;
		  font-size:20px;
		}

		input[type=submit]:hover {
		  background-color: #6e6e6e;
		}

		legend {
			font-size:25px;
			color: #1e1e1e;
		}

		input {
			font-size:10px;
		}

		fieldset {
			font-size:18px;
			color: #1e1e1e;
		}

		#loginText {
		font-size: 70px;
		color: #121212;
		font-family: Satisfy;
	}

	  </style>

  	<script type="text/javascript">
		function showIt() {
		  document.getElementById("loginDiv").style.visibility = "visible";
		}
		setTimeout("showIt()", 4500); // after 4,5 sec
	</script>

</head>


<body>
	<video playsinline="playsinline" autoplay="autoplay" muted="muted" width="100%">
		<source src="book.mp4" type="video/mp4">
	</video>
	
	<div id = "loginDiv" style="visibility: hidden; display: inline; z-index: 1000;">
		
		<div class="masthead" style="top: 350px; left: 25%;">
    		<div class="container h-100">
      			<div class="row h-100">
        			<div class="col-12 my-auto">
          				<div class="masthead-content text-white py-5 py-md-0">
            				<h1 class="mb-3" id="loginText">Login</h1>
          				</div>
        			</div>
      			</div>
    		</div>
  		</div>


  		<div class="social-icons" style="top: 8%; right: 23%;">
    		<form action="login.php" method="post">
				<fieldset id="login_forma" style="width:300px;">
					<legend> Prijavi se na IST </legend>
					Username:<br>
					<input type="text" name="user" placeholder="Username">
					<br>
					Password:<br>
					<input type="text" name="pass" placeholder="Password">
					<br><br>
					<input type="submit" value="Prijava">
				</fieldset>
			</form>
    		
  		</div>

	</div>
</body>

</html>';



if (isset( $_POST['user'] ) && isset( $_POST['pass'] ) && strlen( $_POST['user'] ) > 0 && strlen( $_POST['pass'] ) > 0 )
	{
		
		
		$korisnik=  $_POST['user'];
		$lozinka = $_POST['pass'];
		
		$konekcija = new Konekcija("localhost","root","zatvor");
		$rezKonekcije = $konekcija->konektujSe();

		$upit = "SELECT * FROM korisnici WHERE username = '".$korisnik."' AND password = '".$lozinka."'";
		$rez=$konekcija->izvrsiMySQLUpit($upit);
		if(!$rez) die($konekcija->error);
		
	
		if ($rez->num_rows > 0 )
		{
			$red=$rez->fetch_array(MYSQLI_ASSOC);

			setcookie("korisnik", $red['username'], time() + 24 * 60 * 60, false);
			setcookie("lozinka", $red['password'], time() + 24 * 60 * 60, false);


			if($korisnik == "sudija"){
				header ("Location: sudija-advokat/sudija.php");
			}else{
				header ("Location: sudija-advokat/advokat.php");
			}
			
			
		}
		else echo '<font color = "red"> Pogresno korisnicko ime ili sifra.</font>';
	}


	if (isset( $_COOKIE['korisnik'] ) && isset( $_COOKIE['lozinka'] ) && strlen( $_COOKIE['korisnik'] ) > 0 && strlen( $_COOKIE['lozinka'] ) > 0 ){

		$korisnik = $_COOKIE['korisnik'];
		$lozinka = $_COOKIE['lozinka'];

		if($korisnik == "sudija" && $lozinka == "sudija"){
			header ("Location: sudija-advokat/sudija.php");
		}else if($korisnik == "advokat" && $lozinka == "advokat"){
			header ("Location: sudija-advokat/advokat.php");
		}
		
		
	}






?>