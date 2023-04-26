<?php

require "./konekcija/konekcija.php";
require "./modeli/zadatak.php";
require "./modeli/kategorija.php";

session_start();
if (!isset($_SESSION["korisnik"])) {
    header('Location: index.php');
    exit();
}

if (isset($_COOKIE["korisnik"])) {
    $korisnik = $_COOKIE["korisnik"];
}

if (isset($_POST["button2"])) {
    $zadatak = trim($_POST["zadatak"]);

    $podaci = Zadatak::vratiPodatke($zadatak, $konekcija);
    if ($podaci->slika != "") {
    unlink("./slike/".$podaci->slika);
    }
    Zadatak::obrisi($zadatak, $konekcija);
} else if (isset($_POST["button"])) {
    $zadatak = trim($_POST["zadatak"]);
    $naziv = trim($_POST["naziv"]);
    $kategorija = trim($_POST["kategorija"]);
    $opis = trim($_POST["opis"]);
    $izvrsen = trim($_POST["status"]);

    $provera = trim($_POST["provera"]);
    $obrisi = trim($_POST["obrisi"]);

    if ($provera != "") {
        $ime = "";
        unlink($obrisi);
    }

    if ($_FILES["real_file"]["name"] != "") {
        $ime = time()."_".$_FILES["real_file"]["name"];
    } else {
        $ime = "";
    }
    $target = "./slike/".$ime;
    
    move_uploaded_file($_FILES["real_file"]["tmp_name"], $target);
    
    Zadatak::izmeni($zadatak, $naziv, $kategorija, $opis, $izvrsen, $ime, $konekcija);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Izmena zadatka</title>
    <link href="./style/style.css" rel="stylesheet">
</head>
<body>
    <div>
        <?php include("header.php"); ?>
    </div>

    <div class="containerwrapper">
        <h3 id="crvenah3">Izmena zadatka</h3>
        <div class="containerwrappersub" id="containerwrappersub">
        <form method="post" action="" enctype="multipart/form-data" class="container_izmena" id="formaizmena">
            <div id = "levo">
            </div>

            <div id = "desno">
            
            <div id="skriveno" name="skriveno" class="skriveno">
            </div>
            </div>
            
            <input type="text" value="" id="provera" name="provera" hidden="hidden">
            <input type="text" value="" id="obrisi" name="obrisi" hidden="hidden">
        </form>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script> 

<script>  
    function popuniZadatke() {
        let korisnik = "<?php echo $korisnik; ?>";
        $.ajax({
            url: './funkcije/popuniOpcije.php',
            data: {
                korisnik: korisnik
            },
            success: function (data) {
                $("#levo").html(data);
            }
        });
    }
    popuniZadatke();

    function prikazi(zadatak) {

    if (zadatak == "") {
        $("#skriveno").css('display', 'none');
    } else{
        $("#skriveno").css('display','flex');
    } 
    }
    prikazi("");

    function popuniDetalje() {
        let zadatak = $("#zadatak").val();
        $.ajax({
            url: "./funkcije/vratiPodatke.php",
            data: {
                zadatak: zadatak,
            },
            success: function (data) {
                $("#skriveno").html(data);
            }
        });
    }

    function izaberi() {
        var id = localStorage.getItem("id");
        if (id != null) {
            $("#zadatak").val(id).change();
        }
        localStorage.clear();
    }
    
</script>

</body>
</html>