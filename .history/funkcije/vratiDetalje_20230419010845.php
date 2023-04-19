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
?>

<h4 class="kategorijadetalji"><span><?=$podaci->nazivKategorije?> zadatak • 
<?php
    if ($podaci->izvrsen == "0")
?></span></h4>
<h2 class="opisdetaljinaslov">Detalji:</h2>
<h4 class="opisdetalji"><?=$podaci->opis?></h4>


<h4


