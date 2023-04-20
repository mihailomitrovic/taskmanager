<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$izvrsen = trim($_GET["posalji"]);

$podaci = Zadatak::vratiPodatke($posalji, $konekcija);
$izvrsi = Zadatak::izvrsiZadatak($podaci->zadatakID, $podaci->izvrsen, $konekcija);