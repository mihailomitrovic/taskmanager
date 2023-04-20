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
    <tr name="red" id="red" data-value="<?=$zad->zadatakID?>" onclick="vratiDetalje($(this).data('value'));">
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

</script>
