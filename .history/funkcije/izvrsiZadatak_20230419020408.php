<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$podaci = Zadatak::vratiPodatke("16", $konekcija);
$izvrsi = Zadatak::izvrsiZadatak($podaci->izvrsen, $konekcija);