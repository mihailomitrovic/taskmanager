<?php

require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$slika = trim($_GET["slika"]);

unlink($slika);
?>