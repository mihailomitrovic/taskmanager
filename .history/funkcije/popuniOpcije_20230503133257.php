<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$korisnik = trim($_GET["korisnik"]);

$zadaci = Zadatak::vratiZadatkeZaOpcije($korisnik, $konekcija);
echo var_dump($zadaci);

?>

<?php if ($zadaci == null || $zadaci == array) { ?>
<h4>Nema zadataka za izmenu</h4>
<?php } else { ?>
    <h4>Zadatak</h4>
    <select id="zadatak" name="zadatak" onchange="prikazi(this.value); popuniDetalje(); sakrij();"required></select>

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
            }
        });
    }

    function sakrij() {
        $("#prikaziizmeni").css("display", "none");
    }

</script>

</body>
</html>