<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

session_start();

if (isset($_COOKIE["korisnik"])) {
    $korisnik = $_COOKIE["korisnik"];
}

$zadaci = Zadatak::vratiZadatkeZaOpcije($korisnik, $konekcija);
?>

<?php if ($zadaci == null) { ?>
<h4>Nema zadataka za izmenu</h4>
<?php } else { ?>
<option value="" disabled selected hidden><?= "Zadaci" ?> </option>
<?php

foreach ($zadaci as $zad) {
    ?>
    <option value="<?= $zad->zadatakID ?>"><?= $zad->naziv ?> </option>
    <?php
} }
?>