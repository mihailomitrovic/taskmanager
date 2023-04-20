<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$izvrsen = trim($_GET["izvrsen"]);
$kategorija = trim($_GET["kategorija"]);

$zadaci = Zadatak::vratiZadatke($izvrsen, $kategorija, $konekcija);

?>

<table class="table" id="table">
    <tbody>
 <?php

foreach ($zadaci as $zad) {
    ?>
    <tr id="<?=$zad->zadatakID?>" data-value="<?=$zad->zadatakID?>" onclick="vratiDetalje();">
        <td>
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
    </tr>
<?php
}
?>
    </tbody>
</table>

<script>
    function vratiDetalje() {
        let zadatak = $("#2").data('value');
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
