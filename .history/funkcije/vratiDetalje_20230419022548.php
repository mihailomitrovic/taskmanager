<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);

$podaci = Zadatak::vratiPodatke($zadatak, $konekcija);

$datumKreiranja = new DateTime($podaci->datumKreiranja);
$noviDatumKreiranja = date_format($datumKreiranja, 'd.m.y.');
$datumZavrsetka = new DateTime($podaci->datumZavrsetka);
$noviDatumZavrsetka = date_format($datumZavrsetka, 'd.m.y.');

?>

<?php
    if ($podaci->izvrsen == "0") {  
?> 
<div>
    <h1 class="naslovdetalji"><?=$podaci->naziv?></h1>

    <?php
        $datumKreiranja = new DateTime($podaci->datumKreiranja);
        $noviDatumKreiranja = date_format($datumKreiranja, 'd.m.y.');
        $datumZavrsetka = new DateTime($podaci->datumZavrsetka);
        $noviDatumZavrsetka = date_format($datumZavrsetka, 'd.m.y.');
    ?>

    <div class="katwrap"><h4 class="kategorijadetalji_ne"><span><?=$podaci->nazivKategorije?> zadatak • Neizvršen</span></h4></div>

    <h4 class="opisdetalji"><?=$podaci->opis?></h4>

    <h5 class="datum">Datum kreiranja: <?=$noviDatumKreiranja?></h5>
</div>

<div id="buttonwrapperdetalji">
<button type="submit" class="dugmedetalji" name="button" onclick="izvrsiZadatak();">Izvrši zadatak</button>
<button type="submit" class="dugmedetalji" name="button2">Izmeni zadatak</button>
</div>

<?php } else { ?>
<div>
    <h1 class="naslovdetalji"><?=$podaci->naziv?></h1>

    <?php
        $datumKreiranja = new DateTime($podaci->datumKreiranja);
        $noviDatumKreiranja = date_format($datumKreiranja, 'd.m.y.');
        $datumZavrsetka = new DateTime($podaci->datumZavrsetka);
        $noviDatumZavrsetka = date_format($datumZavrsetka, 'd.m.y.');
    ?>

    <div class="katwrap"><h4 class="kategorijadetalji_da"><span><?=$podaci->nazivKategorije?> zadatak • Izvršen</span></h4></div>

    <h4 class="opisdetalji"><?=$podaci->opis?></h4>

    <h5 class="datum">Datum kreiranja: <?=$noviDatumKreiranja?></h5>
    <h5 class="datum">Datum završetka: <?=$noviDatumZavrsetka?></h5>
</div>

<div id="buttonwrapperdetalji">
<button type="submit" class="dugmedetalji" name="button" onclick="izvrsiZadatak();">Poništi zadatak</button>
<button type="submit" class="dugmedetalji" name="button2">Izmeni zadatak</button>
</div>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    function vratiDetalje() {
        let zadatak = "12";
        $.ajax({
            url: "../funkcije/vratiDetalje.php",
            data: {
                zadatak:zadatak
            },
            success: function (data) {
                $("#detalji").html(data);
            }
        });
    }

    function izvrsiZadatak() {
        let zadatak = "12";
        $.ajax({
            url: "../funkcije/izvrsiZadatak.php",
            success: function (data) {
                vratiDetalje();
            }
        })
    }
</script>

