<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);
$slika = trim($GET["slika"]);

unlink($slika);
Zadatak::obrisiSliku($zadatak, $konekcija);
?>