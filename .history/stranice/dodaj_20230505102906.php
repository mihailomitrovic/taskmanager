<?php

require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

session_start();
if (!isset($_SESSION["korisnik"])) {
    header("Location: index.php");
    exit();
}

if (isset($_COOKIE["korisnik"])) {
    $korisnik=$_COOKIE["korisnik"];
}


if (isset($_POST["button"])) {
    $naziv = trim($_POST["naziv"]);
    $kategorija = trim($_POST["kategorija"]);
    $opis = trim($_POST["opis"]);

    if ($_FILES["real_file"]["name"] != "") {
        $ime = time()."_".$_FILES["real_file"]["name"];
    } else {
        $ime = "";
    }
    $target = "../slike/".$ime;
    
    move_uploaded_file($_FILES["real_file"]["tmp_name"], $target);

    Zadatak::dodaj($naziv, $korisnik, $kategorija, $opis, $ime, $konekcija); 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Novi zadatak</title>
    <link href="../style/style.css" rel="stylesheet">
</head>
<body>
    <div>
        <?php include("header.php"); ?>
    </div>

    <div class="container_wrapper">

        <form method="post" action="" enctype="multipart/form-data" class="container_unos" id="forma" novalidate>

            <h3 id="zelenah3">Novi zadatak</h3>

            <h4>Naziv<mark class="zvezdica">*</mark></h4>
            <input type="text" id="naziv" name="naziv" class="input" placeholder="Naziv zadatka" autocomplete="off" required>

            <div id="falinaziv">
                <h5 class="crvena">Unesi naziv</h5>
            </div>

            <h4>Kategorija<mark class="zvezdica">*</mark></h4>
            <select id="kategorija" name="kategorija" required></select>

            <div id="falikategorija">
                <h5 class="crvena">Izaberi kategoriju</h5>
            </div>

            <h4>Opis<mark class="zvezdica">*</mark></h4>
            <textarea name="opis" id="opis" placeholder="Opis zadatka" required></textarea>

            <div id="faliopis">
                <h5 class="crvena">Unesi opis</h5>
            </div>

            <h4>Slika</h4>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <div id="slikadiv">
                <input type="file" name="real_file" id="real_file" accept=".jpg, .jpeg, .png" value="" hidden="hidden">
                <button type="button" id="custom_button" class="inputslika">Izaberi sliku</button>
            </div>

            <div class="buttoncontainerreg">
                <button class="buttonreg" name="button" type="submit" onclick="predaj();">Unesi zadatak</button>
            </div>

            <div class="prikazi" id="prikazi">
                <h4>Zadatak je uspešno dodat<h4>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script> 

<script>  
    function popuniKategorije() {
        $.ajax({
            url: '../funkcije/popuniKategorije.php',
            success: function (data) {
                $("#kategorija").html(data);
            }
        });
    }
    popuniKategorije();

    function predaj() {
        $("#forma").ajaxForm(function() {
            $("#prikazi").css("visibility", "visible");
            $("#naziv").val("").change();
            $("#kategorija").val("").change();
            $("#opis").val("");
            $("#custom_button").text("Izaberi sliku");
            $("#custom_button").css("border", "2.5pt solid #757575");
            $("#custom_button").css("color", "#757575");
            $("#custom_button").css("background-image", "url('../slike/addgrey.svg')");
            $("#custom_button").hover(
                function(){
                    $(this).css("border", "2.5pt solid black");
                    $("#custom_button").css("color", "black");
                    $("#custom_button").css("background-image", "url('../slike/add.svg')");
                }, function(){
                    $(this).css("border", "2.5pt solid #757575");
                    $("#custom_button").css("color", "#757575");
                    $("#custom_button").css("background-image", "url('../slike/addgrey.svg')");
            });
            dodajSliku1();      
            resetuj();
        })
            

    }

    function dodajSliku() {
        $("#custom_button").click(function() {
            $("#real_file").click();
        })

        $("#real_file").change(function() {
           if ($("#real_file").val()) {
            let vrednost = $("#real_file").val();
            vrednost = vrednost.replace("C:\\fakepath\\", "");
            $("#custom_button").text(vrednost);
            skratiTekst();
            $("#custom_button").css("background-image", "url('../slike/finish.svg')");
            $("#custom_button").css("color", "#17161a");
            $("#custom_button").css("border", "3pt solid #17161a");
           } else {
            $("#real_file").val("");
           }
        })
    }
    dodajSliku();

    function dodajSliku1() {
        $("#real_file").change(function() {
           if ($("#real_file").val()) {
            let vrednost = $("#real_file").val();
            vrednost = vrednost.replace("C:\\fakepath\\", "");
            $("#custom_button").text(vrednost);
            skratiTekst();
            $("#custom_button").css("background-image", "url('../slike/finish.svg')");
            $("#custom_button").css("color", "#17161a");
            $("#custom_button").css("border", "3pt solid #17161a");
           } else {
            $("#real_file").val("");
           }
        })
    }
    dodajSliku1();

    

    function resetuj() {
        $("#real_file").val("");
    }
    resetuj();

    function skratiTekst() {
        let tekst = $("#custom_button").text();
        let promenjeno = "";
        if (tekst.length > 30) {
            for (let i = 0; i < 25; i++) {
                promenjeno += tekst.charAt(i);
            };
            promenjeno += "...";
            $("#custom_button").text(promenjeno);
        }
    }

    const form = document.getElementById('forma');
    const naziv = document.getElementById('naziv');
    const kategorija = document.getElementById('kategorija');
    const opis = document.getElementById('opis');

    form
  .addEventListener(
    'submit',
    (event) => {
        naziv.classList.toggle('error', !naziv.validity.valid);
        opis.classList.toggle('error', !opis.validity.valid);
        kategorija.classList.toggle('error', !kategorija.validity.valid);
        falinaziv.classList.toggle('promeni', !naziv.validity.valid);
        faliopis.classList.toggle('promeni', !opis.validity.valid);
        falikategorija.classList.toggle('promeni', !kategorija.validity.valid);

      if(!naziv.validity.valid){
        event.preventDefault();
        $("#prikazi").css("visibility", "hidden");
      } else {
        naziv.classList.toggle('uredu', !naziv.validity.valid);
      }


      if(!opis.validity.valid){
        event.preventDefault();
        $("#prikazi").css("visibility", "hidden");
      } else {
        opis.classList.toggle('uredu', !opis.validity.valid);
      }

      if(!kategorija.validity.valid){
        event.preventDefault();
        $("#prikazi").css("visibility", "hidden");
      } else {
        kategorija.classList.toggle('uredu', !kategorija.validity.valid);
      }
    }
);

naziv
  .addEventListener(
    'input',
    () => {
        naziv.classList.toggle('uredu', naziv.validity.valid);
    }
);

opis
  .addEventListener(
    'input',
    () => {
        opis.classList.toggle('uredu', opis.validity.valid);
    }
);

kategorija
  .addEventListener(
    'input',
    () => {
        kategorija.classList.toggle('uredu', kategorija.validity.valid);
    }
);



</script>

</body>
</html>