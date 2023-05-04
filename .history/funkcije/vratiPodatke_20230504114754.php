<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

session_start();
if (!isset($_SESSION["korisnik"])) {
    header("Location: pocetna.php");
    exit();
}

if (isset($_COOKIE["korisnik"])) {
    $korisnik = $_COOKIE["korisnik"];
}

$zadatak = trim($_GET["zadatak"]);

$podaci = Zadatak::vratiPodatke($zadatak, $konekcija);

?>

    <div class="datadeo">
    <h4>Naziv</h4>
    <input type="text" id="naziv" name="naziv" class="input" value = "<?=$podaci->naziv?>" autocomplete="off">

    <div id="falinaziv">
        <h5 class="crvena">Unesi naziv</h5>
    </div>

    <h4>Kategorija</h4>
    <select id="kategorija" name="kategorija"></select>

    <h4>Opis</h4>
    <textarea name="opis" id="opis"><?=$podaci->opis?></textarea>
    </div>

    <div id="faliopis">
        <h5 class="crvena">Unesi opis</h5>
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
                    <img id="slicica" src="../slike/<?=$podaci->slika?>"/>
                </div>
                <input type="file" name="real_file" id="real_file1" accept=".jpg, .jpeg, .png" value="" hidden="hidden">
                <button type="button" id="custom_button1" class="inputslika1"><span class="puntekst">Izmeni sliku</span><span class="krataktekst">Izmeni</span></button>
                <button type="button" id="custom_button1" class="inputslika2" onclick="resetujFormu();"><span class="puntekst">Obriši sliku</span><span class="krataktekst">Obriši</span></button>
            </div>
        <?php } ?>

        <h4>Status</h4>
        <div class = "status">
            <input type="radio" id="neizvrsen" name="status" class="opcija" value="0">
            <label for="neizvrsen">Neizvršen</label>
            <input type="radio" id="izvrsen" name="status" class="opcija" value="1">
            <label for="izvrsen">Izvršen</label>
        </div>
    
        <div id="buttonwrapperizmena">
            <div class="buttoncontainerizmena">
                <button type="submit" class="buttonizmena" name="button" onclick="izmeniZadatak();"><span class="puntekst">Izmeni zadatak</span><span class="krataktekst">Izmeni</span></button>
            </div>
            <div class="buttoncontainerizmena">
                <button type="submit" class="button2izmena" name="button2" onclick="obrisiSliku(); obrisiZadatak();"><span class="puntekst">Obriši zadatak</span><span class="krataktekst">Obriši</span></button>
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
        let slika = "<?=$podaci->slika?>";
        $("#formaizmena").ajaxForm(function() {
            $("#prikaziizmeni").css("display", "flex");
            popuniZadatke();
            $("#skriveno").css("display", "none");
        })
        if (slika != "") {
                let slanje = "../slike/<?=$podaci->slika?>";
                let zadatak = <?=$podaci->zadatakID?>;
                $.ajax({
                url: '../funkcije/obrisiSliku.php',
                data: {
                    zadatak: zadatak,
                    slika: slanje
                },
                success: function (data) {
                }
        });
        }
    }

    function obrisiZadatak() {
        let brojac = $(".zadatakid").length - 1;
        console.log(brojac);

        $("#formaizmena").ajaxForm({
            "beforeSubmit": function() {
            $("#prikaziizmeni").css("display", "flex");
            if (brojac == 0) {
                $("#prikaziizmeni").hide();
            } else {
                $("#prikaziizmenitekst").text("Zadatak je uspešno obrisan");
                $("#prikaziizmeni").show();
            }
            $("#skriveno").css("display", "none");
            },
            "success": function() {
            popuniZadatke();
            }
        })
    }

    function dodajSliku() {
        $("#custom_button1").click(function() {
            $("#real_file1").click();
        })

        $("#real_file1").change(function() {
           if ($("#real_file1").val()) {
            let vrednost = $("#real_file1").val();
            vrednost = vrednost.replace("C:\\fakepath\\", "");
            $("#custom_button1").text(vrednost);
            skratiTekst();
            $("#custom_button1").css("background-image", "url('../slike/finish.svg')");
            $("#custom_button1").css("color", "black");
           } else {
            $("#real_file").val() = "";
           }
        })
    }
    dodajSliku();

    function dodajSliku2() {
        $("#custom_button").click(function() {
            $("#real_file").click();
        })

        $("#real_file").change(function() {
           if ($("#real_file").val()) {
            let vrednost = $("#real_file").val();
            vrednost = vrednost.replace("C:\\fakepath\\", "");
            $("#custom_button").text(vrednost);
            skratiTekst();
            $("#custom_button").css("background-image", "url('../slike/finish.svg')");
            $("#custom_button").css("color", "black");
           } else {
            $("#real_file").val() = "";
           }
        })
    }
    dodajSliku2();

    function skratiTekst() {
        let tekst = $("#custom_button").text();
        let promenjeno = "";
        if (tekst.length > 30) {
            if ($(window).width() < 1300) {
            for (let i = 0; i < 10; i++) {
                promenjeno += tekst.charAt(i);
            };
            } else if ($(window).width() < 600) {
                for (let i = 0; i < 29; i++) {
                promenjeno += tekst.charAt(i);
            };
            } else {
                for (let i = 0; i < 35; i++) {
                promenjeno += tekst.charAt(i);
            };
            }
            promenjeno += "...";
            $("#custom_button").text(promenjeno);
        }
    }

    function skratiTekst2() {
        let tekst = $("#custom_button1").text();
        let promenjeno = "";
        
        for (let i = 0; i < 8; i++) {
            promenjeno += tekst.charAt(i);
        };
            
        promenjeno += "...";
        $("#custom_button1").text(promenjeno);
    }

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