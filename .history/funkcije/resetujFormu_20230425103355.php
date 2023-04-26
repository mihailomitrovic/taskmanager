<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);
$slika = trim($_GET["slika"]);

?>

<input type="file" name="real_file" id="real_file" accept=".jpg, .jpeg, .png" value="" hidden="hidden">
<button type="button" id="custom_button" class="inputslika">Ubaci sliku</button>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    function dodajSliku() {
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
    dodajSliku();

    function skratiTekst() {
        let tekst = $("#custom_button").text();
        let promenjeno = "";
        if (tekst.length > 30) {
            for (let i = 0; i < 15; i++) {
                promenjeno += tekst.charAt(i);
            };
            promenjeno += "...";
            $("#custom_button").text(promenjeno);
        }
    }
</script>
