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

<h4>Izaberite jedan od zadataka za više detalja</h4>
<?php
    } else {

?>
<h4>Unesite novi zadatak</h4>
<?php
    }
?>
