<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$posalji = trim($_GET["posalji"]);
$korisnik = trim($_GET["korisnik"]);

$podaci = Zadatak::vratiPodatke($posalji, $konekcija);
$izvrsi = Zadatak::izvrsiZadatak($podaci->zadatakID, $podaci->izvrsen, $konekcija);

?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>

function filtriraj2() {
        let izvrsen = <?=$podaci->izvrsen?>;
        let kategorija = <?=$podaci->kategorija?>;
        let korisnik = "<?php echo $korisnik; ?>";
        $.ajax({
            url: '../funkcije/vratiZadatke.php',
            data: {
                izvrsen: izvrsen,
                kategorija: kategorija,
                korisnik: korisnik
            },
            success: function (data) {
                $("#zadaci").html(data);
            }
        });
    }

 </script>