/*
var brojac = 0;


function izvrsiCassandra(){
    document.getElementById("paramsList").innerHTML="";
    param1Data = $("#param1").val( );
    param2Data = $("#param2").val();
    param3Data = $("#param3").val();
    document.getElementById("param1").value="";
    document.getElementById("param2").value="";
    document.getElementById("param3").value="";
    params = "param1=" + param1Data + "&param2=" + param2Data + "&param3=" + param3Data;
       
    $.ajax({
        type: "POST",
        url: "../cgi-bin/advokat.py",
        data: params,
        dataType: "html",
        success: function (html){
            var params = $(html).filter(function(){ return $(this).is("p") });
                     
            params.each(
                    function(){
                        if($(this).html().indexOf("Razg") != -1){
                            brojac++;
                            var index = "lista" + brojac;
                            var value = "<ol id='"+index+"' ><h2>" + $(this).html()  + " </h2></ol>";
                            $("#paramsList").append( value );
                        }   
                        else {
                            var index = "#lista" + brojac;
                            var value = "<li>" + $(this).html() + "</li>";
                            $(index).append(value);
                        }
                    }
                );
        },
        error: function(request, ajaxOptions, thrownError){
            $("#debug").html(request.responseText);
            $("#debug").html("Greška");
        }
    });
}


function izvrsiMongoDB(){
    // ispraznimo sadrzaj kontejnera "Razgovori"
    document.getElementById("paramsList").innerHTML="";
    // pokupimo datum, vrijeme i sudionike iz odgovarajucih polja u kontejneru "Pretraga razgovora"
    param1Data = $("#param1").val( );
    param2Data = $("#param2").val();
    param3Data = $("#param3").val();
    // nakon sto smo pokupili podatke, ispraznimo polja kako korisnik u narednom unosu ne bi morao sam brisati prethodne podatke
    document.getElementById("param1").value="";
    document.getElementById("param2").value="";
    document.getElementById("param3").value="";
    // podatke datum,vrijeme i sudionici spremimo u varijablu "params" koju cemo proslijediti serveru
    params = "param1=" + param1Data + "&param2=" + param2Data + "&param3=" + param3Data;
       
    // koristimo AJAX tehnologiju kako ne bi bilo reloada na našoj stranici kada stigne odgovor od strane servera i mi ga prikazemo korisniku 
    $.ajax({
        type: "POST",         // koristimo POST metodu jer serveru saljemo podatke 
        url: "../cgi-bin/advokat1.py",   // specificiramo putanju servera koji je zaduzen za obradu ove POST metode 
        data: params,       // specificiramo podatke koje saljemo
        dataType: "html",   // kazemo kojeg su tipa
        success: function (html){     // ova funkcija se izvrsava ako stigne odgovor od servera i ako je sve bilo uspjesno 
            // ostatak ove funkcije cemo objasniti nakon sto objasnimo sta se desava na serveru kada je stigao ovaj zahtjev 
            // tip parametra je "html" zato sto server kao odgovor salje "html"
            var params = $(html).filter(function(){ return $(this).is("p") });  // u varijablu "params" smjestam sve paragrafe iz html-a koji je stigao od servera  
                     
            params.each(   // prolazim kroz svaki paragraf
                    function(){   // ako paragraf u sebi sadrzi "Razgovor" 
                        if($(this).html().indexOf("Razg") != -1){
                            brojac++;
                            var index = "lista" + brojac;   // treba kreirati listu sa odgovarajucim indeksom i tu listu dodati u kontejner "Razgovori"
                            var value = "<ol id='"+index+"' ><h2>" + $(this).html()  + " </h2></ol>";
                            $("#paramsList").append( value );
                        }   
                        else {   // ako paragraf ne sadrzi "Razgovor", onda sadrzi "ime" i "poruku" i njih je potrebno spremiti u odgovarajucu listu 
                            var index = "#lista" + brojac;
                            var value = "<li>" + $(this).html() + "</li>";
                            $(index).append(value);
                        }
                    }
                );
        },
        error: function(request, ajaxOptions, thrownError){   // ova funkcija se izvrsava ako se desi neka neocekivana greska 
            $("#debug").html(request.responseText);
            $("#debug").html("Greška");    // u kontejneru "Razgovori" će pisati "Greska"
        }
    });
}


*/