<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);

$podaci = Zadatak::vratiPodatke($zadatak, $konekcija);

?>

<h4>Naziv</h4>
<input type="text" id="naziv" name="naziv" class="input" value = "<?=$podaci->naziv?>" autocomplete="off">

<h4>Kategorija</h4>
<select id="kategorija" name="kategorija"></select>

<h4>Opis</h4>
<textarea name="opis" id="opis"><?=$podaci->opis?></textarea>

<h4>Slika</h4>
<button onclick="obrisiSliku();">Obrisi</button>
<input type="file" name="slika" id="slika" accept=".jpg, .jpeg, .png" value="">

<h4>Status</h4>
<div class = "status">
    <input type="radio" id="neizvrsen" name="status" class="opcija" value="0">
    <label for="neizvrsen">Neizvršen</label>
    <input type="radio" id="izvrsen" name="status" class="opcija" value="1">
    <label for="izvrsen">Izvršen</label>
</div>


<div id="buttonwrapper">
     <div class="buttoncontainer">
        <button type="submit" class="button" name="button" onclick="izmeniZadatak();">Izmeni zadatak</button>
    </div>
    <div class="buttoncontainer">
        <button type="submit" class="button2" name="button2" onclick="obrisiZadatak();">Izbriši zadatak</button>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script> 

<script>
    function popuniKategorije() {
            $.ajax({
                url: '../funkcije/popuniKategorije.php',
                success: function (data) {
                   $("#kategorija").html(data);
                   postaviKategoriju();
                }
            });
        }
    popuniKategorije();

    function postaviKategoriju() {
        $("#kategorija").val("<?= $podaci->kategorija ?>").change();
    }

    function postaviStatus() {
        if (<?= $podaci->izvrsen ?> == "0") {
            $('#neizvrsen').prop('checked', true);
        } else {
            $('#izvrsen').prop('checked', true);
        }
    }
    postaviStatus();

    function obrisiSliku() {
        let zadatak = <?=$podaci->zadatakID?>;
        let slika = "../slike/<?=$podaci->slika?>";
        $.ajax({
                url: '../funkcije/obrisiSliku.php',
                data: {
                    zadatak: zadatak,
                    slika: slika
                },
                success: function (data) {
                }
            });
    }

    function izmeniZadatak() {
        $("#forma").ajaxForm(function() {
            $("#prikaziizmeni").css("visibility", "visible")
        })
    }

    function obrisiZadatak() {
        $("#forma").ajaxForm(function() {
            $("#zadatak").val("").change();
            $("#prikaziizmenitekst").val("Zadatak je uspešno obrisan").change();
            $("#prikaziobrisi").css("visibility", "visible")
        })
    }
</script>
