<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$izvrsen = trim($_GET["izvrsen"]);
$kategorija = trim($_GET["kategorija"]);
$korisnik = trim($_GET["korisnik"]);

$zadaci = Zadatak::vratiZadatke($izvrsen, $kategorija, $korisnik, $konekcija);

?>

<?php
if ($zadaci != null) {
?>

<h4>Izaberite jedan od zadataka</h4>
<?php
    } else {

?>
<h6>Nema ovakvih zadataka</h6>
<?php
    };
?>

<script>
    function vratiDetalje(red) {
        let zadatak = red;
        $.ajax({
            url: "../funkcije/vratiDetalje.php",
            data: {
                zadatak:zadatak
            },
            success: function (data) {
                $("#detalji").html(data);
            }
        });
    }
</script>