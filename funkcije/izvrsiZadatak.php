<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$podaci = Zadatak::vratiPodatke("12", $konekcija);
$izvrsi = Zadatak::izvrsiZadatak($podaci->zadatakID, $podaci->izvrsen, $konekcija);