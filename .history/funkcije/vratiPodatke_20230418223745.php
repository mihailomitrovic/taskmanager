<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);

$podaci = Zadatak::vratiPodatke($zadatak, $konekcija);

?>

<h4>Naziv</h4>

<input type="text" id="naziv" name="naziv" class="input" value = <?=$podaci->naziv?> autocomplete="off">


<h4>Kategorija</h4>
<select id="kategorija" name="kategorija"></select>

<h4>Opis</h4>
<textarea name="opis" id="opis"><?=$podaci->opis?></textarea>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    function popuniKategorije2() {
        let kat = <?=$podaci->opis?>;
            $.ajax({
                url: '../funkcije/popuniKategorije2.php',
                data: {
                    kat:kat
                },
                success: function (data) {
                   $("#kategorija").html(data);
                }
            });
        }
        popuniKategorije();

        function postaviVrednost() {
        $("#kategorija").val("<?= $podaci->kategorija ?>").change();
    }
    postaviVrednost();
</script>

