<?php


require_once("konekcija.php");
require_once("autorizacija.php");

if($jelSudija) die("Zabranjen pristup");

echo '<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>IST BiH</title>

  <link rel="icon" href="favicon.ico" type="image/x-icon"/ >

  <style>

  	body {
  		font-size: 13px;
  		line-height: 1.8;
  		color: #fff;
  		background-image: url("images/body-bg.jpg");
  		background-repeat: no-repeat;
  		background-size: cover;
  		-moz-background-size: cover;
  		-webkit-background-size: cover;
  		-o-background-size: cover;
  		-ms-background-size: cover;
  		background-position: center center;
  		background-attachment: fixed;
  		font-weight: 400;
  		margin: 0px;
  		padding: 5px; 
	}

  	#upiti{
  		height: 220px;
  		width: 20%;
  		background-color: rgba(0,180,180,0.5);
  		float: left;
  		padding-left: 150px;
  		margin-left: 300px;	
	}

	#posebni_upiti_1{
		height: 450px;
  		width: 20%;
  		background-color: rgba(0,180,180,0.5);
  		float: left;
  		padding-left: 150px;
  		margin-left: 300px;
	}

	#rezultati{
		height: 300px;
  		width: 20%;
  		background-color: rgba(180,180,180,0.4);
  		float: left;
  		padding-left: 150px;
  		
	}
	#ocisti{
  		clear: left;
	}
	

  </style>

  <script>
	function fetch() {
		var get = document.getElementById("get").value;
		document.getElementById("put").value = get;
	}
	function fetch1() {
		var get = document.getElementById("get1").value;
		document.getElementById("put1").value = get;
	}
</script>


</head>


<body style="display:flex;">



<div id="upiti" style="margin:45px; height: 260px; width: 550px;">

	<div>

		<h2 > Razni upiti </h2>
		<form action="" method="post">
		  <input type="radio" name="upit" value="1"> Kriminalac sa najduzom zatvorskom kaznom<br>
		  <input type="radio" name="upit" value="2"> Izlistaj sve kriminalce<br>
		  <input type="radio" name="upit" value="3"> Kriminalac sa najvise dosijea <br>
		  <input type="radio" name="upit" value="4"> Kriminalci koji su odsluzili svoje kazne <br>
		  <br><input type="submit" name="potvrdi" value="Potvrdi">
		</form> 
		</div>

		<div id="posebni_upiti_1" style="margin-left:-150px; margin-top:80px; height: 480px; width: 550px;">
		<form action = "" method = "post">
			<h3> Razlog kazne </h3>
			<input type="checkbox" name="ubistvo" value="Ubistvo"> Ubistvo<br>
		  	<input type="checkbox" name="droga" value="Droga"> Droga <br>
		  	<input type="checkbox" name="silovanje" value="Silovanje"> Silovanje <br>
		  	
		  	<h3> Zatvor </h3>
		  	<input type="radio" name="zatvor" value="1"> Zenica<br>
		  	<input type="radio" name="zatvor" value="2"> Foca<br>

		  	<h3> Duzina trajanja </h3>
		  	<label> Trajanje (izmedju 0 and 50): </label> <br>
		  	<input type="range" id="get" name="donja_granica" min="0" max="50" onchange="fetch()"/> <br>
		  	Donja granica:  <input type="text" id="put" size="3" value="25"/><br>
		  	<input type="range" id="get1" name="gornja_granica" min="0" max="50" onchange="fetch1()"/> <br>
		  	Gornja granica:  <input type="text" id="put1" size="3" value="25"/><br><br>

		  	<input type="submit" name="potvrdi2" value="Potvrdi">
		  </form>
		  </div>

	</div>

<div id="rezultati" style="margin:45px; margin-right:100px; height:765px; width:1000px;">
<h2> Rezultati upita </h2>
<ol id="lista_rezultata"> 
</ol>	
</div>

<div id="ocisti">
</div>

<a href="advokat.php" style="color:white; float:right; padding: 40px;20px;">
        <i">Nazad</i>
    </a>



  

</body>


</html>';


if(isset($_POST['potvrdi'])){

	
	if(isset($_POST['upit'])){
		switch ($_POST['upit']) {
			case '1':
				kriminalac_sa_najduzom_zatvorskom_kaznom();
				break;
			case '2':
				ispis_kriminalaca();
				break;
			case '3':
				kriminalac_sa_najvise_dosijea();
				break;
			case '4':
				kriminalci_odsluzili_kaznu();
				break;

			default:
				break;
		}
	}
}


if(isset($_POST['potvrdi2'])){

	$razlog = "";
	if(isset($_POST['ubistvo'])){
		$razlog .= "ubistvo";
	}
	if(isset($_POST['droga'])){
		if($razlog != ''){
			$razlog .=",droga";
		}else{
			$razlog .= "droga";
		}
	}
	if(isset($_POST['silovanje'])){
		if($razlog != ''){
			$razlog .=",silovanje";
		}else{
			$razlog .= "silovanje";
		}
	}



	$zatvor = "";
	if(isset($_POST['zatvor'])){
		switch ($_POST['zatvor']) {
			case '1':
				$zatvor .= "Zenica";
				break;
			case '2':
				$zatvor .= "Foca";
				break;
			
			default:
				break;
		}
	}


	$donja_granica = "";
	if(isset($_POST['donja_granica'])){
		$donja_granica .= $_POST['donja_granica'];
	}

	$gornja_granica = "";
	if(isset($_POST['gornja_granica'])){
		$gornja_granica .= $_POST['gornja_granica'];
	}



	$konekcija = new Konekcija("localhost","root","zatvor");
	$rezKonekcije = $konekcija->konektujSe();



	

	if($razlog && $zatvor && $donja_granica && $gornja_granica){
		$upit = "SELECT zatvorenici.Ime,zatvorenici.Prezime FROM dosije INNER JOIN zatvorenici ON zatvorenici.ID = dosije.ZatvorenikID 
			WHERE dosije.RazlogKazne ='$razlog' AND dosije.ImeZatvora = '$zatvor' AND dosije.DuzinaTrajanja BETWEEN $donja_granica AND $gornja_granica";
	}else if($razlog && $zatvor){
		$upit = "SELECT zatvorenici.Ime,zatvorenici.Prezime FROM dosije INNER JOIN zatvorenici ON zatvorenici.ID = dosije.ZatvorenikID 
			WHERE dosije.RazlogKazne ='$razlog' AND dosije.ImeZatvora = '".$zatvor . "'";
	}else if($razlog && $donja_granica && $gornja_granica) {
		$upit = "SELECT zatvorenici.Ime,zatvorenici.Prezime FROM dosije INNER JOIN zatvorenici ON zatvorenici.ID = dosije.ZatvorenikID 
			WHERE dosije.RazlogKazne ='$razlog' AND dosije.DuzinaTrajanja BETWEEN $donja_granica AND $gornja_granica";

	}else if($zatvor && $donja_granica && $gornja_granica){
		$upit = "SELECT zatvorenici.Ime,zatvorenici.Prezime FROM dosije INNER JOIN zatvorenici ON zatvorenici.ID = dosije.ZatvorenikID 
			WHERE dosije.ImeZatvora = '$zatvor' AND dosije.DuzinaTrajanja BETWEEN $donja_granica AND $gornja_granica";
	}else if($razlog){
		$upit = "SELECT zatvorenici.Ime,zatvorenici.Prezime FROM dosije INNER JOIN zatvorenici ON zatvorenici.ID = dosije.ZatvorenikID 
			WHERE dosije.RazlogKazne ='".$razlog."'";
	}else if($zatvor){
		$upit = "SELECT zatvorenici.Ime,zatvorenici.Prezime FROM dosije INNER JOIN zatvorenici ON zatvorenici.ID = dosije.ZatvorenikID 
			WHERE dosije.ImeZatvora ='".$zatvor."'";
	}else if($donja_granica && $gornja_granica){
		$upit = "SELECT zatvorenici.Ime,zatvorenici.Prezime FROM dosije INNER JOIN zatvorenici ON zatvorenici.ID = dosije.ZatvorenikID 
			WHERE dosije.DuzinaTrajanja BETWEEN $donja_granica AND $gornja_granica";
	}

	

	$rez=$konekcija->izvrsiMySQLUpit($upit);
	if(!$rez) die($konekcija->error);

	if($rez->num_rows > 0 ){

		while($red=$rez->fetch_array(MYSQLI_ASSOC)){
			$text = $red['Ime'] . " " . $red['Prezime'];
			echo "<script> 
              var node = document.createElement('LI');
              var textnode = document.createTextNode('$text');
              node.appendChild(textnode);
              document.getElementById('lista_rezultata').appendChild(node); 
              </script>";
		}


	}
	

}



function kriminalac_sa_najduzom_zatvorskom_kaznom(){

	$konekcija = new Konekcija("localhost","root","zatvor");
	$rezKonekcije = $konekcija->konektujSe();

	$upit = "SELECT max(dosije.DuzinaTrajanja) AS duzina, zatvorenici.Ime, zatvorenici.Prezime FROM dosije 
			INNER JOIN zatvorenici ON zatvorenici.ID = dosije.ZatvorenikID";
	$rez=$konekcija->izvrsiMySQLUpit($upit);
	if(!$rez) die($konekcija->error);

	if ($rez->num_rows > 0 ){

		$red = $rez->fetch_array(MYSQLI_ASSOC);
		$text = $red['Ime'] . " ". $red['Prezime'] . " (" .$red['duzina']." godina)";
		echo "<script> 
              var node = document.createElement('LI');
              var textnode = document.createTextNode('$text');
              node.appendChild(textnode);
              document.getElementById('lista_rezultata').appendChild(node); 
              </script>";
		
			
	}

}


function ispis_kriminalaca(){

	$konekcija = new Konekcija("localhost","root","zatvor");
	$rezKonekcije = $konekcija->konektujSe();

	$upit="SELECT Ime,Prezime FROM zatvorenici";

	$rez=$konekcija->izvrsiMySQLUpit($upit);
	if(!$rez) die($konekcija->error);
	if ($rez->num_rows > 0 ){
		while($red=$rez->fetch_array(MYSQLI_ASSOC)){
			$text = $red['Ime'] . " " . $red['Prezime'];
			echo "<script> 
              var node = document.createElement('LI');
              var textnode = document.createTextNode('$text');
              node.appendChild(textnode);
              document.getElementById('lista_rezultata').appendChild(node); 
              </script>";
		}
		
	}



}


function kriminalac_sa_najvise_dosijea(){

	$konekcija = new Konekcija("localhost","root","zatvor");
	$rezKonekcije = $konekcija->konektujSe();

	$upit = "SELECT dosije.ZatvorenikID, zatvorenici.Ime,zatvorenici.Prezime,COUNT(*) AS broj FROM dosije INNER JOIN zatvorenici 
		ON dosije.ZatvorenikID = zatvorenici.ID GROUP BY dosije.ZatvorenikID HAVING COUNT(*) > 1 ORDER BY COUNT(*) DESC";

	$rez=$konekcija->izvrsiMySQLUpit($upit);
	if(!$rez) die($konekcija->error);
	if ($rez->num_rows > 0 ){

		$red=$rez->fetch_array(MYSQLI_ASSOC);
		$text = $red['Ime'] . " " . $red['Prezime'] . " (" . $red['broj'] .")";
			echo "<script> 
              var node = document.createElement('LI');
              var textnode = document.createTextNode('$text');
              node.appendChild(textnode);
              document.getElementById('lista_rezultata').appendChild(node); 
              </script>";

         $broj_dosijea = $red['broj'];

        
		while($red=$rez->fetch_array(MYSQLI_ASSOC)){
			if($red['broj'] == $broj_dosijea){
				$tekst = $red['Ime'] . " " . $red['Prezime'] . " (" . $broj_dosijea . ")";
				echo "<script> 
	              var node = document.createElement('LI');
	              var textnode = document.createTextNode('$tekst');
	              node.appendChild(textnode);
	              document.getElementById('lista_rezultata').appendChild(node); 
	              </script>";

			}else{
				break;
			}
			
		}
		
		
	}
}


function kriminalci_odsluzili_kaznu(){

	$konekcija = new Konekcija("localhost","root","zatvor");
	$rezKonekcije = $konekcija->konektujSe();

	$upit="SELECT zatvorenici.Ime,zatvorenici.Prezime,dosije.RazlogKazne FROM dosije INNER JOIN zatvorenici 
			ON zatvorenici.ID = dosije.ZatvorenikID WHERE dosije.DuzinaTrajanja=0;";

	$rez=$konekcija->izvrsiMySQLUpit($upit);
	if(!$rez) die($konekcija->error);
	if ($rez->num_rows > 0 ){
		while($red=$rez->fetch_array(MYSQLI_ASSOC)){
			$text = $red['Ime'] . " " . $red['Prezime'] ." (". $red['RazlogKazne'] . ")";
			echo "<script> 
              var node = document.createElement('LI');
              var textnode = document.createTextNode('$text');
              node.appendChild(textnode);
              document.getElementById('lista_rezultata').appendChild(node); 
              </script>";
		}
		
	}

}




?>