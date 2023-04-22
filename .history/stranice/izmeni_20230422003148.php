<?php

require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";
require "../modeli/kategorija.php";

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

    Zadatak::obrisi($zadatak, $konekcija);
} else if (isset($_POST["button"])) {
    $zadatak = trim($_POST["zadatak"]);
    $naziv = trim($_POST["naziv"]);
    $kategorija = trim($_POST["kategorija"]);
    $opis = trim($_POST["opis"]);
    $izvrsen = trim($_POST["status"]);

    if ($_FILES["slika"]["name"] != null) {
        $ime = time()."_".$_FILES["slika"]["name"];
        $target = "../slike/".$ime;
        move_uploaded_file($_FILES["slika"]["tmp_name"], $target);
    } else {
        $ime = "";
    }
    
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
    <link href="../style/style.css" rel="stylesheet">
</head>
<body>
    <div>
        <?php include("header.php"); ?>
    </div>

    <div class="containerwrapper">
        <h3 id="zelenah3">Izmena zadatka</h3>
        <div class="containerwrappersub">
        <form method="post" action="" enctype="multipart/form-data" class="container_izmena" id="forma" class="forma">
            <div id = "levo">
            </div>

            <div id = "desno">
            
            <div id="skriveno" name="skriveno" class="skriveno">
            </div>
            </div>
            
        </form>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script> 

<script>  
    function popuniZadatke() {
        let korisnik = "<?php echo $korisnik; ?>";
        $.ajax({
            url: '../funkcije/popuniOpcije.php',
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
        var id = localStorage.getItem("id");
        if (id != null) {
            $("#zadatak").val(id).change();
        }
        localStorage.clear();
    }

    function izmeni() {
        $("#forma").ajaxForm(function() {
            $("#zadatak").val("").change();
            $("#skrivenoizmeni").css("visibility", "visible")
        })
    }

    function obrisi() {
        $("#forma").ajaxForm(function() {
            $("#zadatak").val("").change();
            $("#skrivenoizmenitekst").val("Zadatak je uspešno obrisan").change;
            $("#skrivenoizmeni").css("visibility", "visible")
        })
    }
</script>

</body>
</html>