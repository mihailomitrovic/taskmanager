<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);

$podaci = Zadatak::vratiPodatke($zadatak, $konekcija);

?>

<h1 class="naslovdetalji"><?=$podaci->naziv?></h1>
<h4 class="kategorijadetalji"><?=$podaci->nazivKategorije?> zadatak • </h4>
<h4 class="opisdetalji"><?=$podaci->opis?></h4>


<h4


