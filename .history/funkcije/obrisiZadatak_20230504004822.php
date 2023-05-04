<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);
$podaci = Zadatak::vratiPodatke($zadatak, $konekcija);

if ($zadaci != null) {
?>

<h4>Izaberi jedan od zadataka za više detalja</h4>
<?php
    } else {

?>
<div id="nemazadataka">
<h4><span class="puntekst">Nemaš nijedan zadatak za prikazivanje — </span></h4>
<h4><span class="krataktekst">Nemaš nijedan zadatak — </span></h4><a href="../stranice/dodaj.php" id="nemazadatakalink"><h4>unesi novi<h4></a><h4 id="uzvicnik">!</h4>
<div>
<?php
    }

unlink("../slike/".$podaci->slika);
Zadatak::obrisi($zadatak, $konekcija);
?>