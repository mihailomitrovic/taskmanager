<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$posaljis = trim($_GET["posalji"]);

$podaci = Zadatak::vratiPodatke($posalji, $konekcija);
$izvrsi = Zadatak::izvrsiZadatak($podaci->zadatakID, $podaci->izvrsen, $konekcija);