<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$izvrsen = trim($_GET["izvrsen"]);
$kategorija = trim($_GET["kategorija"]);
$korisnik = trim($_GET["korisnik"]);

$zadaci = Zadatak::vratiZadatke($izvrsen, $kategorija, $korisnik, $konekcija);

?>

<?php
if ($zadaci != null) {
?>

<table class="table" id="table">
    <tbody>
 <?php

foreach ($zadaci as $zad) {
    ?>
    <tr name="red" id="red" >
        <td data-value="<?=$zad->zadatakID?>" onclick="vratiDetalje($(this).data('value'));">
            <h5><?= $zad->naziv?></h5>
            <?php
                $datumKreiranja = new DateTime($zad->datumKreiranja);
                $noviDatumKreiranja = date_format($datumKreiranja, 'd.m.y.');
            ?>
            <h6><?= $zad->nazivKategorije?> • <?=$noviDatumKreiranja?></h6>

            <?php 
                if ($zad->izvrsen == "1") {
                    $datumZavrsetka = new DateTime($zad->datumZavrsetka);
                    $noviDatumZavrsetka = date_format($datumZavrsetka, 'd.m.y.');
            ?>
            <h6>Završen: <?=$noviDatumZavrsetka?></h6>
            <?php 
                }
            ?>
        </td>
        <td>
            <button data-value="<?=$zad->zadatakID?>" onclick="obrisi($(this).data('value'))">X</button>
        </td>
    </tr>
<?php
    }

?>
    </tbody>
</table>
<?php 
} else {
?>
<h6>Nema ovakvih zadataka</h6>
<?php
    };
?>

<script>
    function vratiDetalje(red) {
        let zadatak = red;
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

    function obrisi(red) {
        let zadatak = red;
        $.ajax({
            url: "../funkcije/obrisiZadatak.php",
            data: {
                zadatak:zadatak
            },
            success: function (data) {
                filtriraj();
                resetuj();
            }
        });
    }

    function filtriraj() {
        let izvrsen = $("#izvrsen").val();
        let kategorija = $("#kategorija").val();
        let korisnik = "<?php echo $korisnik; ?>";
        $.ajax({
            url: '../funkcije/vratiZadatke.php',
            data: {
                izvrsen: izvrsen,
                kategorija: kategorija,
                korisnik: korisnik
            },
            success: function (data) {
                $("#zadaci").html(data);
            }
        });
    }

    function daLiImaZadatke() {
        let korisnik = "<?php echo $korisnik; ?>";
        $.ajax({
            url: '../funkcije/daLiImaZadatke.php',
            data: {
                korisnik: korisnik
            },
            success: function (data) {
                $("#detaljiispod").html(data);
            }
        });
    }
</script>
