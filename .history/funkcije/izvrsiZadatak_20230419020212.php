<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";


$podaci = Zadatak::izvrsiZadatak("16", $konekcija);