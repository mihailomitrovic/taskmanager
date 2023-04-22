<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);
$slika = trim($GET["slika"]);

Zadatak::obrisiSliku($zadatak, $konekcija);
unlink(realpath($slika));
?>