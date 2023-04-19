<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);

$podaci = Zadatak::vratiPodatke($zadatak, $konekcija);

?>

<h2 class="naslovdetalji"><?=$podaci->naziv?></h2>
<h4 class="kategorijadetalji"><?=$podaci->nazivKategorije?> • <?=$podaci->korisnik?></h4>
<h4 class="opisdetalji"><?=$podaci->opis?></h4>


<h4


