<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);

$podaci = Zadatak::vratiPodatke($zadatak, $konekcija);

?>

<h4>Naziv</h4>

<input type="text" id="naziv" name="naziv" class="input" value = <?=$podaci->naziv?> autocomplete="off">


<h4>Kategorija</h4>
<select id="kategorija" name="kategorija" value=<?=$podaci->kategorija?>></select>

<h4>Opis</h4>
<textarea name="opis" id="opis"><?=$podaci->opis?></textarea>

<script>
    function popuniKategorije() {
            $.ajax({
                url: '../funkcije/popuniKategorije.php',
                success: function (data) {
                   $("#kategorija").html(data);
                }
            });
        }
        popuniKategorije();
</script>

