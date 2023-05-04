<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$posalji = trim($_GET["posalji"]);
$korisnik = trim($_GET["korisnik"]);

$podaci = Zadatak::vratiPodatke($posalji, $konekcija);
$izvrsi = Zadatak::izvrsiZadatak($podaci->zadatakID, $podaci->izvrsen, $konekcija);

?>