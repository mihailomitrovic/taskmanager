<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$korisnik = trim($_GET["korisnik"]);

$zadaci = Zadatak::vratiZadatkeZaOpcije($korisnik, $konekcija);
?>

<?php if ($zadaci == null || empty($zadaci)) { ?>
<h4>Nema zadataka za izmenu</h4>
<?php } else { ?>

<h4>Zadatak</h4> 	
<select id="zadatak" name="zadatak" onchange="prikazi(this.value); popuniDetalje(); sakrij();"required>

<option value="" disabled selected hidden><?= "Zadaci" ?> </option>
<?php

foreach ($zadaci as $zad) {
    ?>
    <option value="<?= $zad->zadatakID ?>"><?= $zad->naziv ?> </option>
    <?php
} }
?>
</select>


<div class="prikaziizmeni" id="prikaziizmeni"> 		
    <h4 id="prikaziizmenitekst">Zadatak je uspešno izmenjen<h4> 	
</div> 