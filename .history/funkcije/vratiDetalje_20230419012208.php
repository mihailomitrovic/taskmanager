<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);

$podaci = Zadatak::vratiPodatke($zadatak, $konekcija);

?>

<h1 class="naslovdetalji"><?=$podaci->naziv?></h1>

<?php
    $datumKreiranja = new DateTime($podaci->datumKreiranja);
    $noviDatumKreiranja = date_format($datumKreiranja, 'd.m.y');
    $datumZavrsetka = new DateTime($podaci->datumZavrsetka);
    $noviDatumZavrsetka = date_format($datumZavrsetka, 'd.m.y');
?>

<h4 class="kategorijadetalji"><span><?=$podaci->nazivKategorije?> zadatak • 
<?php
    if ($podaci->izvrsen == "0") {  
?> Neizvršen
<?php
    }  else {
?> Izvršen
<?php
    }
?> </span></h4>

<h4 class="opisdetalji"><?=$podaci->opis?></h4>

<h5 class="datum">Datum kreiranja: <?=$noviDatumKreiranja?></h5>

<h5 class="datum><?php
    if ($podaci->izvrsen == "0") {  
?>
<?php
    }  else {
?> Datum završetka: <?=$noviDatumZavrsetka?>
<?php
    }
?></h5>

<h4


