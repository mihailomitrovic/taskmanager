<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$podaci = Zadatak::vratiPodatke($zadatak, $konekcija);
$izvrsi = Zadatak::izvrsiZadatak($podaci->izvrsen, $konekcija);