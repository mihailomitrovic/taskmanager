<?php

require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";
require "../modeli/kategorija.php";

session_start();
if (!isset($_SESSION["korisnik"])) {
    header('Location: index.php');
    exit();
}

if (isset($_POST["button2"])) {
    $zadatak = trim($_POST["zadatak"]);

    if(Zadatak::obrisi($zadatak, $konekcija)){
        echo '<script type="text/javascript">
               window.onload = function () { alert("Zadatak je obrisan!"); } 
              </script>'; 
    } else{
        echo '<script type="text/javascript">
               window.onload = function () { alert("Došlo je do greške!"); } 
              </script>'; 
    }
} else if (isset($_POST["button"])) {
    $zadatak = trim($_POST["zadatak"]);
    $naziv = trim($_POST["naziv"]);
    $kategorija = trim($_POST["kategorija"]);
    $opis = trim($_POST["opis"]);
    $izvrsen = trim($_POST["status"]);

    if(Zadatak::izmeni($zadatak, $naziv, $kategorija, $opis, $izvrsen, $konekcija)){
        echo '<script type="text/javascript">
               window.onload = function () { alert("Zadatak je promenjen!"); } 
              </script>'; 
    } else{
        echo '<script type="text/javascript">
               window.onload = function () { alert("Došlo je do greške!"); } 
              </script>'; 
    }
}

if(isset($_GET["data"])) {
        $data = $_GET["data"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Izmena zadatka</title>
    <link href="../style/style.css" rel="stylesheet">
</head>
<body>
    <div>
        <?php include("header.php"); ?>
    </div>

    <div class="containerwrapper">
        <form method="post" action="" enctype="multipart/form-data" class="container_izmena">
            <div id = "levo">
            <h4>Zadatak</h4>
            <select id="zadatak" name="zadatak" onchange="prikazi(this.value); popuniDetalje();"required></select>
            </div>

            <div id = "desno">
            
            <div id="skriveno" name="skriveno" class="skriveno">
            </div>

            <div id="buttonwrapper">
                <div class="buttoncontainer">
                    <button type="submit" class="button" name="button">Izmeni zadatak</button>
                </div>
                <div class="buttoncontainer">
                    <button type="submit" class="button2" name="button2">Izbriši zadatak</button>
                </div>
            </div>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>  
    function popuniZadatke() {
        $.ajax({
            url: '../funkcije/popuniZadatke.php',
            success: function (data) {
                $("#zadatak").html(data);
            }
        });
    }
    popuniZadatke();

    function prikazi(zadatak) {

    if (zadatak == "") {
        $("#skriveno").css('display', 'none');
        $("#buttonwrapper").css('display', 'none');
    } else{
        $("#skriveno").css('display','flex');
        $("#buttonwrapper").css('display', 'flex');
    } 
    }
    prikazi("");

    function popuniDetalje() {
        let zadatak = $("#zadatak").val();
        $.ajax({
            url: "../funkcije/vratiPodatke.php",
            data: {
                zadatak: zadatak,
            },
            success: function (data) {
                $("#skriveno").html(data);
            }
        });
    }

    function izaberi() {
        if($data != null) {
            $("#zadatak").val($data).change();
        }
    }
    izaberi();

</script>

</body>
</html>