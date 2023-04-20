<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);

$podaci = Zadatak::vratiPodatke($zadatak, $konekcija);
$izvrsi = Zadatak::izvrsiZadatak($podaci->zadatakID, $podaci->izvrsen, $konekcija);