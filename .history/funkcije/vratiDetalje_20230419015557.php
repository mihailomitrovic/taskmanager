<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);

$podaci = Zadatak::vratiPodatke($zadatak, $konekcija);

?>

<div>
    <h1 class="naslovdetalji"><?=$podaci->naziv?></h1>

    <?php
        $datumKreiranja = new DateTime($podaci->datumKreiranja);
        $noviDatumKreiranja = date_format($datumKreiranja, 'd.m.y.');
        $datumZavrsetka = new DateTime($podaci->datumZavrsetka);
        $noviDatumZavrsetka = date_format($datumZavrsetka, 'd.m.y.');
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

    <h5 class="datum"><?php
        if ($podaci->izvrsen == "0") {  
    ?>
    <?php
        }  else {
    ?> Datum završetka: <?=$noviDatumZavrsetka?>
    <?php
        }
    ?></h5>
</div>

<div id="buttonwrapperdetalji">
    <button type="submit" class="dugmedetalji" name="button" onclick="izvrsiZadatak();">Izvrši zadatak</button>
    <button type="submit" class="dugmedetalji" name="button2">Izmeni zadatak</button>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    function izvrsiZadatak() {
        let zadatak = "16";
        $.ajax({
            url: "../funkcije/izvrsiZadatak.php"
        });
    }
</script>

