<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);

Zadatak::obrisiSliku($zadatak, $konekcija);
unlink("../slike/".$slika);
?>