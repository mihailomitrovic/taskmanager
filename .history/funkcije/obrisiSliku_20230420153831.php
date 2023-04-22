<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);
$slika = trim($GET["slika"]);

$podaci = Zadatak::obrisiSliku($zadatak, $konekcija);
unlink("../slike/".$slika);
?>