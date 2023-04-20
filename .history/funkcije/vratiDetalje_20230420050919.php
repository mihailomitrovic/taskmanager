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
<div class = "detaljilevo">
    <div class="detaljilevosub">
        <h1 class="naslovdetalji"><?=$podaci->naziv?></h1>

        <?php
            $datumKreiranja = new DateTime($podaci->datumKreiranja);
            $noviDatumKreiranja = date_format($datumKreiranja, 'd.m.y.');
            $datumZavrsetka = new DateTime($podaci->datumZavrsetka);
            $noviDatumZavrsetka = date_format($datumZavrsetka, 'd.m.y.');
        ?>

        <h4 class="kategorijadetalji"><span><?=$podaci->nazivKategorije?> zadatak • Neizvršen</span></h4>

        <h4 class="opisdetalji"><?=$podaci->opis?></h4>

        <h5 class="datum">Datum kreiranja: <?=$noviDatumKreiranja?></h5>
    </div>

    <div id="buttonwrapperdetalji">
        <button type="submit" class="dugmedetalji" name="button" onclick="izvrsiZadatak(); filtrirajIzmena();">Izvrši zadatak</button>
        <form action="izmeni.php">
        <button type="submit" class="dugmedetalji" name="button2" onclick="izmeni();">Izmeni zadatak</button>
        </form>
    </div>
</div>

<?php if ($podaci->slika != null) { ?>
<div class="slikacontainer">
    <div class="slikawrap">
        <img src="../slike/<?=$podaci->slika?>"/>
    </div>
</div>
<?php } else {?>
<div class="slikacontainer"></div>
<?php } ?>

<?php } else { ?>
<div class="detaljilevo">
    <div>
        <h1 class="naslovdetalji"><?=$podaci->naziv?></h1>

        <?php
            $datumKreiranja = new DateTime($podaci->datumKreiranja);
            $noviDatumKreiranja = date_format($datumKreiranja, 'd.m.y.');
            $datumZavrsetka = new DateTime($podaci->datumZavrsetka);
            $noviDatumZavrsetka = date_format($datumZavrsetka, 'd.m.y.');
        ?>

        <h4 class="kategorijadetalji"><span><?=$podaci->nazivKategorije?> zadatak • Izvršen</span></h4>

        <h4 class="opisdetalji"><?=$podaci->opis?></h4>

        <h5 class="datum">Datum kreiranja: <?=$noviDatumKreiranja?></h5>
        <h5 class="datum">Datum završetka: <?=$noviDatumZavrsetka?></h5>
    </div>

    <div id="buttonwrapperdetalji">
        <button type="submit" class="dugmedetalji" name="button" onclick="izvrsiZadatak();">Poništi zadatak</button>
        <form action="izmeni.php">
        <button type="submit" class="dugmedetalji" name="button2" onclick="izmeni();">Izmeni zadatak</button>
        </form>
    </div>
</div>

<?php if ($podaci->slika != null) { ?>
<div class="slikacontainer">
    <div class="slikawrap">
        <img src="../slike/<?=$podaci->slika?>"/>
    </div>
</div>
<?php } else {?>
<div class="slikacontainer"></div>
<?php } }?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>

    function izvrsiZadatak() {
        let posalji = <?=$podaci->zadatakID?>;
        $.ajax({
            url: "../funkcije/izvrsiZadatak.php",
            data: {
                posalji:posalji
            },
            success: function (data) {
                vratiDetalje(posalji);
                $("#izvrsen").val("<?=$podaci->izvrsen?>").change();
            }
        });
    }

    function filtrirajIzmena() {
        let izvrsen = <?=$podaci->izvrsen?>;
        let kategorija = $("#kategorija").val();
        $.ajax({
            url: '../funkcije/vratiZadatke.php',
            data: {
                izvrsen: izvrsen,
                kategorija: kategorija,
            },
            success: function (data) {
                $("#zadaci").html(data);
            }
        });
    }

    function izmeni() {
        let zadatak = <?=$podaci->zadatakID?>;
        localStorage.setItem("id", zadatak);
        return false;
    }
 </script>