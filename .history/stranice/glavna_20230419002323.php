<?php

session_start();
if (!isset($_SESSION["korisnik"])) {
    header("Location:pocetna.php");
    exit();
}

if (isset($_COOKIE["korisnik"])) {
    $korisnik = $_COOKIE["korisnik"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link href="../style/style.css" rel="stylesheet">
</head>
<body>
    <div>
        <?php include("header.php"); ?>
    </div>

    <div class="containerwrapper">
        <div>
            <div class="container_unos">
                <h3 id="zelenah3">Filteri</h3>

                <h4>Kategorija</h4>
                <select id="kategorija" name="kategorija" onchange="filtriraj();" required>
                    <option value="0">Svi</option>
                    <option value="1">Poslovni</option>
                    <option value="2">Lični</option>
                    <option value="3">Ostali</option>
                </select>

                <h4>Izvršeni</h4>
                <select id="izvrsen" name="izvrsen" onchange="filtriraj();" required>
                    <option value="0">Neizvršeni</option>
                    <option value="1">Izvršeni</option>
                </select>

                <h3 id="crvenah3">Zadaci</h3>
                <div id="zadaci" class="zadaci"></div>
                
            </div>
        </div>

        <div class="data" id="detalji" name="detalji">
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    function vratiZadatke() {
        let izvrsen = "0";
        let kategorija = "0";
        $.ajax({
            url: "../funkcije/vratiZadatke.php",
            data: {
                izvrsen: izvrsen,
                kategorija, kategorija,
            },
            success: function (data) {
                $("#zadaci").html(data);
            }
        });
    }
    vratiZadatke();

    function filtriraj() {
        let izvrsen = $("#izvrsen").val();
        let kategorija = $("#kategorija").val();
        $.ajax({
            url: '../funkcije/vratiZadatke.php',
            data: {
                izvrsen: izvrsen,
                kategorija: kategorija,
            },
            success: function (data) {
                $("#zadaci").html(data);
            }
        });
    }

    function vratiDetalje() {
        let zadatak = "16";
        $.ajax({
            url: "../funkcije/vratiDetalje.php",
            data: {
                izvrsen: izvrsen,
                kategorija, kategorija,
            },
            success: function (data) {
                $("#detalji").html(data);
            }
        });
    }
    vratiZadatke();

</script>

</body>
</html>