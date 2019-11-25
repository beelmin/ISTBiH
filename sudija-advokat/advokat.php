<?php

require "../../phpmongodb/vendor/autoload.php";

require_once("konekcija.php");
require_once("autorizacija.php");

if($jelSudija) die("Zabranjen pristup");

echo '<!DOCTYPE html>
<html>
<head>
    <!-- Metadata -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>IST - BiH</title>

    <!-- Fav Icon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon"/ >

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <!-- JS Ajax -->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

    <!-- JS Advokat -->
    <!-- <script src="advokat.js"></script>  -->
</head>
<body>
    <a href="../odjava.php" style="color:white; float:right; padding: 40px;20px;">
        <i">Odjava</i>
    </a>

    <div class="main">

        <div class="containerLeft containerAdvokatLeft">
            <form class="appointment-form" id="appointment-form" action="" method="post">
                <h2>Pretraga razgovora</h2>
                <div class="form-group-2">
                    <input 
                        type="text" 
                        name="datum" 
                        id="param1" 
                        placeholder="Datum"
                    >
                    <input 
                        type="text" 
                        name="vrijeme" 
                        id="param2" 
                        placeholder="Vrijeme"
                    >

	               <input 
                        type="text" 
                        name="sudionici" 
                        id="param3" 
                        placeholder="Sudionici"
                    >

                    <input 
                        type="submit" 
                        name="Potvrdi" 
                        id="submit" 
                        class="submit" 
                        value="MongoDB"
                        
                        style="display: inline-block;"
                    >


                    <a 
                        id="submit" 
                        class="submit"
                        style="display: inline-block;
                               float: right;
                               text-decoration: none";
                        href="upiti.php" 
                    >
                        Razni upiti
                    </a>
                </div>
            </form>
        </div>
        
        <div class="containerRight containerAdvokatRight">
            <div class="razgovori">
                <h2 
                    style="text-align: center;"
                > 
                    Razgovori 
                </h2>
                <ol id="paramsList"></ol>
                <div id = "debug"></div>
            </div>
        </div>
    </div>





</body>
</html>';

if(isset($_POST['Potvrdi'])){
    $datum = $_POST['datum'];
    $vrijeme = $_POST['vrijeme'];
    $sudionici = $_POST['sudionici'];

    $collection = (new MongoDB\Client)->sud->materijali;
    
  
    if($datum  && $vrijeme && $sudionici){  
        $cursor = $collection->find(['datum' => $_POST['datum'],'vrijeme' => $_POST['vrijeme'],'sudionici' => ['$all' => explode(",", $_POST['sudionici'])]]);
    }else if($datum  && $sudionici){
        $cursor = $collection->find(['datum' => $_POST['datum'],'sudionici' => ['$all' => explode(",", $_POST['sudionici'])]]);
    }else if($vrijeme && $sudionici){ 
        $cursor = $collection->find(['vrijeme' => $_POST['vrijeme'],'sudionici' => ['$all' => explode(",", $_POST['sudionici'])]]);
    }else if($datum && $vrijeme){ 
        $cursor = $collection->find(['datum' => $_POST['datum'],'vrijeme' => $_POST['vrijeme']]);  
    }else{  
        echo "<script type='text/javascript'>alert('Morate unijeti barem 2 polja');</script>";
    }
    

    
    $i = 1;
    foreach ($cursor as $document) {

        $text = "Razgovor ".$i;
        echo "<script>
            var ol = document.getElementById('paramsList');
            var li = document.createElement('ol');
            li.appendChild(document.createTextNode('$text'));
            li.setAttribute('id','$i'); 
            ol.appendChild(li);
            </script>";

        foreach ($document['razgovor'] as $razgovor) {
            $tekst = $razgovor['ime'] . " " . $razgovor['poruka'];
            echo "<script> 
              var node = document.createElement('LI');
              var textnode = document.createTextNode('$tekst');
              node.appendChild(textnode);
              document.getElementById('$i').appendChild(node); 
              </script>";
        }

        echo "<br>";
        $i++;
            
    }
}


?>