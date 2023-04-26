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

        <form method="post" action="" enctype="multipart/form-data" class="container_unos" id="forma">

            <h3 id="zelenah3">Novi zadatak</h3>

            <h4>Naziv*</h4>
            <input type="text" id="naziv" name="naziv" class="input" placeholder="Naziv zadatka" autocomplete="off" required>

            <h4>Kategorija*</h4>
            <select id="kategorija" name="kategorija" required></select>

            <h4>Opis*</h4>
            <textarea name="opis" id="opis" placeholder="Opis zadatka" required></textarea>

            <h4>Slika</h4>
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
            $("#opis").val("").change();
            $("#real_file").val() = "";
            $("#custom_button").text("Unesi sliku");
            $("#custom_button").css("background-image", "url('../slike/add.svg')");
            $("#custom_button").css("color", "#757575");
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
            $("#custom_button").css("background-image", "url('../slike/finish.svg')");
            $("#custom_button").css("color", "#17161a");
            $("#custom_button").css("border", "3pt solid #17161a");
            $("#custom_button").css("width", "420px");
           } else {
            $("#real_file").val() = "";
           }
        })
    }
    dodajSliku();

    function resetuj() {
        $("#real_file").val() = "";
    }
    resetuj();
</script>

</body>
</html>