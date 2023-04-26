<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$korisnik = trim($_GET["korisnik"]);

$zadaci = Zadatak::vratiZadatkeZaOpcije($korisnik, $konekcija);

?>

<?php
if ($zadaci != null) {
?>

<h4>Izaberite jedan od zadataka za više detalja</h4>
<?php
    } else {

?>
<div id="nemazadataka">
<span class="puntekst">Nemate nijedan zadatak za prikazivanje — </span><span class="krataktekst">Nemate nijedan zadatak — </span><a href="../stranice/dodaj.php" id="nemazadatakalink"><h4>unesite novi<h4></a><h4 id="uzvicnik">!</h4>
<div>
<?php
    }
?>