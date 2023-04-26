<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

session_start();
if (!isset($_SESSION["korisnik"])) {
    header("Location: pocetna.php");
    exit();
}

if (isset($_COOKIE["korisnik"])) {
    $korisnik=$_COOKIE["korisnik"];
}

$zadatak = trim($_GET["zadatak"]);

$podaci = Zadatak::vratiPodatke($zadatak, $konekcija);

?>

    <div class="datadeo">
    <h4>Naziv</h4>
    <input type="text" id="naziv" name="naziv" class="input" value = "<?=$podaci->naziv?>" autocomplete="off">

    <h4>Kategorija</h4>
    <select id="kategorija" name="kategorija"></select>

    <h4>Opis</h4>
    <textarea name="opis" id="opis"><?=$podaci->opis?></textarea>
    </div>

    <div class="datadeo1">
        <h4>Slika</h4>
        <?php if($podaci->slika == "") { ?>
            <div id="slikadiv">
                <input type="file" name="real_file" id="real_file" accept=".jpg, .jpeg, .png" value="" hidden="hidden">
                <button type="button" id="custom_button" class="inputslika">Izaberi sliku</button>
            </div>
        <?php } else { ?>
            <div id = "slikawrapnad" class="slikawrapnad">
                <div class="slikawrap1">
                    <img src="../slike/<?=$podaci->slika?>"/>
                </div>
                <input type="file" name="real_file" id="real_file" accept=".jpg, .jpeg, .png" value="" hidden="hidden">
                <button type="button" id="custom_button" class="inputslika1">Izmeni sliku</button>
                <button type="button" id="custom_button" class="inputslika2" onclick="resetujFormu();">Obriši sliku</button>
            </div>
        <?php } ?>

        <h4>Status</h4>
        <div class = "status">
            <input type="radio" id="neizvrsen" name="status" class="opcija" value="0" id="crveniradio">
            <label for="neizvrsen">Neizvršen</label>
            <input type="radio" id="izvrsen" name="status" class="opcija" value="1" id="zeleniradio">
            <label for="izvrsen">Izvršen</label>
        </div>
    
        <div id="buttonwrapper">
            <div class="buttoncontainer">
                <button type="submit" class="button" name="button" onclick="izmeniZadatak();">Izmeni zadatak</button>
            </div>
            <div class="buttoncontainer">
                <button type="submit" class="button2" name="button2" onclick="obrisiZadatak();">Obriši zadatak</button>
            </div>
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
            $("#prikaziizmeni").css("visibility", "visible");
            $("#prikaziizmenitekst").text("Zadatak je uspešno obrisan");
            $("#prikaziobrisi").css("visibility", "visible");
            popuniZadatke();
        })
    }

    function dodajSliku() {
        $("#custom_button").click(function() {
            $("#real_file").click();
        })

        $("#real_file").change(function() {
           if ($("#real_file").val()) {
            let vrednost = $("#real_file").val();
            vrednost = vrednost.replace("C:\\fakepath\\", "");
            $("#custom_button").text(vrednost);
            $("#custom_button").css("background-image", "url('../slike/finish.svg')");
            $("#custom_button").css("color", "black");
           } else {
            $("#real_file").val() = "";
           }
        })
    }
    dodajSliku();

    function resetujFormu() {
        let zadatak = <?=$podaci->zadatakID?>;
        let slika = "../slike/<?=$podaci->slika?>";
        $.ajax({
                url: '../funkcije/resetujFormu.php',
                data: {
                    zadatak: zadatak,
                    slika: slika
                },
                success: function (data) {
                    $("#slikawrapnad").html(data);
                    $("#provera").val("NESTO");
                    $("#obrisi").val(slika);
                }
            });
    }

</script>
