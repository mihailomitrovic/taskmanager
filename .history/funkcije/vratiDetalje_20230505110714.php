<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);
$korisnik = trim($_GET["korisnik"]);

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

        <?php if ($podaci->slika != null) {?>
        <h4 class="opisdetalji"><?=$podaci->opis?></h4>
        <?php } else { ?>
        <h4 class="opisdetaljidug"><?=$podaci->opis?></h4>
        <? } ?>

        <h5 class="datum">Datum kreiranja: <?=$noviDatumKreiranja?></h5>
    </div>

    <div id="buttonwrapperdetalji">
        <button type="submit" class="dugmedetalji" name="button" onclick="izvrsiZadatak();"><span class="puntekst">Izvrši zadatak</span><span class="krataktekst">Izvrši</span></button>
        <form action="izmeni.php">
        <button type="submit" class="dugmedetalji" name="button2" onclick="izmeni();"><span class="puntekst">Izmeni zadatak</span><span class="krataktekst">Izmeni</span></button>
    </div>
</div>

<?php if ($podaci->slika != null) { ?>
<div class="slikacontainer">
    <div class="slikawrap" style="background-image: url('../slike/<?=$podaci->slika?>')">
    </div>
</div>
<svg style="visibility: hidden" width="0" height="0">
  <defs>
    <filter id="filter-radius">
      <!-- Create a blur of 4px radius from the original image -->
      <!-- (Transparent pixels are ignored, thus the blur radius starts at the corner of the image) -->
      <feGaussianBlur in="SourceGraphic" stdDeviation="4" result="blur" />
      <!-- Filter out the pixels where alpha values that are too low, in this case the blurred corners are filtered out -->
      <feColorMatrix
        in="blur"
        mode="matrix"
        values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 100 -50"
        result="mask"
      />
      <!-- As the final result is now blurred, we need to use the mask we obtained from previous step to cut from the original source -->
      <feComposite in="SourceGraphic" in2="mask" operator="atop" />
    </filter>
  </defs>
</svg>
<?php } else {?>
<div class="slikacontainer"></div>
<?php } ?>

<?php } else { ?>
<div class="detaljilevo">
    <div class="detaljilevosub">
        <h1 class="naslovdetalji"><?=$podaci->naziv?></h1>

        <?php
            $datumKreiranja = new DateTime($podaci->datumKreiranja);
            $noviDatumKreiranja = date_format($datumKreiranja, 'd.m.y.');
            $datumZavrsetka = new DateTime($podaci->datumZavrsetka);
            $noviDatumZavrsetka = date_format($datumZavrsetka, 'd.m.y.');
        ?>

        <h4 class="kategorijadetalji"><span><?=$podaci->nazivKategorije?> zadatak • Izvršen</span></h4>

        <?php if ($podaci->slika != null) {?>
        <h4 class="opisdetalji"><?=$podaci->opis?></h4>
        <?php } else { ?>
        <h4 class="opisdetaljidug"><?=$podaci->opis?></h4>
        <? } ?>

        <h5 class="datum">Datum kreiranja: <?=$noviDatumKreiranja?></h5>
        <h5 class="datum">Datum završetka: <?=$noviDatumZavrsetka?></h5>
    </div>

    <div id="buttonwrapperdetalji">
        <button type="submit" class="dugmedetalji" name="button" onclick="ponistiZadatak();"><span class="puntekst">Poništi zadatak</span><span class="krataktekst">Poništi</span></button>
        <form action="izmeni.php">
        <button type="submit" class="dugmedetalji" name="button2" onclick="izmeni();"><span class="puntekst">Izmeni zadatak</span><span class="krataktekst">Izmeni</span></button>
        </form>
    </div>
</div>

<?php if ($podaci->slika != null) { ?>
<div class="slikacontainer">
    <div class="slikawrap" style="background-image: url('../slike/<?=$podaci->slika?>')"></div>
</div>
<svg style="visibility: hidden" width="0" height="0">
  <defs>
    <filter id="filter-radius">
      <!-- Create a blur of 4px radius from the original image -->
      <!-- (Transparent pixels are ignored, thus the blur radius starts at the corner of the image) -->
      <feGaussianBlur in="SourceGraphic" stdDeviation="4" result="blur" />
      <!-- Filter out the pixels where alpha values that are too low, in this case the blurred corners are filtered out -->
      <feColorMatrix
        in="blur"
        mode="matrix"
        values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 100 -50"
        result="mask"
      />
      <!-- As the final result is now blurred, we need to use the mask we obtained from previous step to cut from the original source -->
      <feComposite in="SourceGraphic" in2="mask" operator="atop" />
    </filter>
  </defs>
</svg>
<?php } else {?>
<?php } }?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>

    function izvrsiZadatak() {
        let posalji = <?=$podaci->zadatakID?>;
        let izvrsen = <?=$podaci->izvrsen?>;
        let korisnik = "<?php echo $korisnik; ?>";
        $.ajax({
            url: "../funkcije/izvrsiZadatak.php",
            data: {
                posalji:posalji,
                korisnik:korisnik,
            },
            success: function (data) {
                vratiDetalje(posalji);
            }
        });
    }

    function ponistiZadatak() {
        let posalji = <?=$podaci->zadatakID?>;
        let korisnik = "<?php echo $korisnik; ?>";
        $.ajax({
            url: "../funkcije/izvrsiZadatak.php",
            data: {
                posalji:posalji,
                korisnik:korisnik
            },
            success: function (data) {
                vratiDetalje(posalji);
            }
        });
    }

    function izmeni() {
        let zadatak = <?=$podaci->zadatakID?>;
        localStorage.setItem("id", zadatak);
        return false;
    }

 </script>