/*




function dodaj(){
	// pokupim vrijednosti svih 8 polja koje je korisnik unio
    param1Data = $("#param1").val();
    param2Data = $("#param2").val();
    param3Data = $("#param3").val();
    param4Data = $("#param4").val();
    param5Data = $("#param5").val();
    param6Data = $("#param6").val();
    param7Data = $("#param7").val();
	param8Data = document.getElementById('param8'); 

	// sve slike koje se dodaju nalaze se na lokaciji IST/pomocna i potrebno je samo jos saznati ime slike da bi imali punu lokaciju
	param8Data = "pomocna\\" + param8Data.files.item(0).name;
	
	
    // pripremimo podatke za slanje putem ajax tehnologije    
    params = "param1=" + param1Data + "&param2=" + param2Data +"&param3=" + param3Data + "&param4=" + param4Data + "&param5=" + param5Data + "&param6="+param6Data+"&param7="+param7Data+"&param8="+param8Data;
    
    // ispraznimo sva polja za sljedeci unos    
    document.getElementById("param1").value="";
    document.getElementById("param2").value="";
    document.getElementById("param3").value="";
    document.getElementById("param4").value="";
    document.getElementById("param5").value="";
    document.getElementById("param6").value="";
    document.getElementById("param7").value="";
    document.getElementById("param8").value="";
    document.getElementById("debug").value="";

    // koristimo ajax tehnologiju da nema reaload
    $.ajax({
        type: "POST",   // koristimo POST metodu jer saljemo podatke
        url: "../cgi-bin/sudija.py",    // lokacija serverskog fajla koji obradjuje POST zahtjev
        data: params,	// podaci koje saljemo
        dataType: "html",	// tip podataka
        success: function (html){   // ova funkcija se izvrsava ako je sve bilo okej
            $("#debug").html("Uspješno ste dodali novog zatvorenika u bazu");  // u kontejner "Detalji" ispisemo korisniku poruku
        },	// u slucaju greske izvrsit ce se ova funkcija
        error: function(request, ajaxOptions, thrownError){
            $("#debug").html(request.responseText);
            $("#debug").html("Greška");
        }
    });

    
}

function izmijeniPostojeceg(){          
   
    param3Data = $("#param3").val();
    
    param5Data = $("#param5").val();
    param6Data = $("#param6").val();
    param7Data = $("#param7").val();
    
                    
    params = "param3=" + param3Data + "&param5=" + param5Data + "&param6="+param6Data+"&param7="+param7Data;
            
    document.getElementById("param1").value="";
    document.getElementById("param2").value="";
    document.getElementById("param3").value="";
    document.getElementById("param4").value="";
    document.getElementById("param5").value="";
    document.getElementById("param6").value="";
    document.getElementById("param7").value="";
    document.getElementById("param8").value="";
    document.getElementById("debug").value="";
       
    $.ajax({
        type: "POST",
        url: "../cgi-bin/sudija1.py",
        data: params,
        dataType: "html",
        success: function (html){
            $("#debug").html("Uspješno ste dodali novu stavku u dosije postojećeg zatvorenika u bazi");
        },
        error: function(request, ajaxOptions, thrownError){
            $("#debug").html(request.responseText);
            $("#debug").html("Greska");
        }
    });
}

function izmijeni(){          
    
    param3Data = $("#param3").val();
    param5Data = $("#param5").val();
    param6Data = $("#param6").val();
    param7Data = $("#param7").val();
    
                    
    params = "param3=" + param3Data + "&param5="+param5Data+ "&param6="+param6Data+"&param7="+param7Data;
            
    document.getElementById("param1").value="";
    document.getElementById("param2").value="";
    document.getElementById("param3").value="";
    document.getElementById("param4").value="";
    document.getElementById("param5").value="";
    document.getElementById("param6").value="";
    document.getElementById("param7").value="";
    document.getElementById("param8").value="";
    document.getElementById("debug").value="";
       
    $.ajax({
        type: "POST",
        url: "../cgi-bin/sudija2.py",
        data: params,
        dataType: "html",
        success: function (html){
            $("#debug").html("Uspješno ste izmijenili dosije postojećeg zatvorenika u bazi");
        },
        error: function(request, ajaxOptions, thrownError){
            $("#debug").html(request.responseText);
            $("#debug").html("Greska");
        }
    });
}
*/