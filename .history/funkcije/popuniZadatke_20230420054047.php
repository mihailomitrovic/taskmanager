<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$korisnik = trim($_GET["korisnik"]);

$zadaci = Zadatak::vratiZadatkeZaOpcije($korisnik, $konekcija);
 if ($zadaci == null) {
     ?>
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