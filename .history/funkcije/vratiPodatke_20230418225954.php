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

<h4>Status</h4>
<input type="radio" id="neizvrsen" name="status" value="0">
<label for="neizvrsen">Neizvršen</label><br>
<input type="radio" id="izvrsen" name="status" value="1">
<label for="izvrsen">Neizvršen</label><br>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    function popuniKategorije() {
            $.ajax({
                url: '../funkcije/popuniKategorije.php',
                success: function (data) {
                   $("#kategorija").html(data);
                   postaviVrednost();
                }
            });
        }
        popuniKategorije();

        function postaviVrednost() {
        $("#kategorija").val("<?= $podaci->kategorija ?>").change();
    }
</script>

