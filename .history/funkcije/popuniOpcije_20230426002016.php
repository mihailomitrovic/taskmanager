<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$korisnik = trim($_GET["korisnik"]);

$zadaci = Zadatak::vratiZadatkeZaOpcije($korisnik, $konekcija);
?>

<?php if ($zadaci == null) { ?>
<h4>Nema zadataka za izmenu</h4>
<?php } else { ?>
    <h4>Zadatak</h4>
    <select id="zadatak" name="zadatak" onchange="prikazi(this.value); popuniDetalje();"required></select>

    <div class="prikaziizmeni" id="prikaziizmeni">
        <h4 id="prikaziizmenitekst">Zadatak je uspešno izmenjen<h4>
    </div>
    <?php
} 
?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>  
    function popuniZadatke() {
        let korisnik = "<?php echo $korisnik; ?>";
        $.ajax({
            url: '../funkcije/popuniZadatke.php',
            data: {
                korisnik: korisnik
            },
            success: function (data) {
                $("#zadatak").html(data);
                izaberi();
            }
        });
    }
    popuniZadatke();

    function prikazi(zadatak) {
    if (zadatak == "") {
        $("#skriveno").css('display', 'none');
    } else{
        $("#skriveno").css('display','flex');
    } 
    }
    prikazi("");

    function izaberi() {
        var id = localStorage.getItem("id");
        if (id != null) {
            $("#zadatak").val(id).change();
        }
        localStorage.clear();
    }

    function popuniDetalje() {
        let zadatak = $("#zadatak").val();
        $.ajax({
            url: "../funkcije/vratiPodatke.php",
            data: {
                zadatak: zadatak,
            },
            success: function (data) {
                $("#skriveno").html(data);
                if ($(window).width() < 1200) {
                    $("#levo").css("border-width", "0.5pt").change();
                    $("#levo").css("border-style", "solid").change();
                    $("#levo").css("border-color", "#6d6c6f").change();
                    $("#levo").css("border-left", "none").change();
                    $("#levo").css("border-top", "none").change();
                    $("#levo").css("border-right", "none").change();

                } else {
                    $("#levo").css("border-width", "0.5pt").change();
                    $("#levo").css("border-style", "solid").change();
                    $("#levo").css("border-color", "#6d6c6f").change();
                    $("#levo").css("border-left", "none").change();
                    $("#levo").css("border-top", "none").change();
                    $("#levo").css("border-bottom", "none").change();
                }

            }
        });
    }

    function srediIvicu() {
        if ($(window).width() < 1200 && $("#zadatak").val()) {
            $("#levo").css("border-width", "0.5pt").change();
            $("#levo").css("border-style", "solid").change();
            $("#levo").css("border-color", "#6d6c6f").change();
            $("#levo").css("border-left", "none").change();
            $("#levo").css("border-top", "none").change();
            $("#levo").css("border-right", "none").change();
        } else if ($(window).width() >= 1200 && $("#zadatak").val()) {
            $("#levo").css("border-width", "0.5pt").change();
            $("#levo").css("border-style", "solid").change();
            $("#levo").css("border-color", "#6d6c6f").change();
            $("#levo").css("border-left", "none").change();
            $("#levo").css("border-top", "none").change();
            $("#levo").css("border-bottom", "none").change();
        }
    }
    srediIvicu();
</script>

</body>
</html>