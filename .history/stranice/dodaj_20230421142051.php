<?php

require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

session_start();
if (!isset($_SESSION["korisnik"])) {
    header("Location: pocetna.php");
    exit();
}

if (isset($_COOKIE["korisnik"])) {
    $korisnik=$_COOKIE["korisnik"];
}


if (isset($_POST["button"])) {
    $naziv = trim($_POST["naziv"]);
    $kategorija = trim($_POST["kategorija"]);
    $opis = trim($_POST["opis"]);

    $tempime = $_FILES["slika"]["name"];
    $ime = time()."_".$_FILES["slika"]["name"];
    $target = "../slike/".$ime;
    
    move_uploaded_file($_FILES["slika"]["tmp_name"], $target);

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
        <form method="post" action="" enctype="multipart/form-data" class="container_unos">

            <h4>Naziv*</h4>
            <input type="text" id="naziv" name="naziv" class="input" placeholder="Naziv zadatka" autocomplete="off" required>

            <h4>Kategorija*</h4>
            <select id="kategorija" name="kategorija" required></select>

            <h4>Opis*</h4>
            <textarea name="opis" id="opis" placeholder="Opis zadatka" required></textarea>

            <h4>Slika</h4>
            <label for="slika" id="slikalabel" name="slikalabel" class="inputslika"><span>Unesi sliku</span></label>
            <input type="file" name="slika" id="slika" accept=".jpg, .jpeg, .png" value="" style="display: none" >

            <div class="buttoncontainer">
                <button class="button" name="button" type="submit" onclick="promeniLabelu()">Unesi zadatak</button>
            </div>

            <div style="visibility:hidden" id="prikazi">
                Uspešno dodat zadatak
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

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

    function promeniLabelu() {
        $("#prikazi").css("visibility", "visible");
    }
</script>

</body>
</html>