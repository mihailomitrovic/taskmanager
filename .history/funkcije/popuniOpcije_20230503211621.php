<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$korisnik = trim($_GET["korisnik"]);

$zadaci = Zadatak::vratiZadatkeZaOpcije($korisnik, $konekcija);
?>

<?php if (count($zadaci) != 0) { ?> 	
    <h4>Zadatak</h4> 	
    <select id="zadatak" name="zadatak" onchange="prikazi(this.value); popuniDetalje(); sakrij();"required></select>

    <div class="prikaziizmeni" id="prikaziizmeni"> 		
        <h4 id="prikaziizmenitekst">Zadatak je uspešno izmenjen<h4> 	
    </div> 
<?php } else { ?> 	
    <h4>Nema zadataka za izmenu</h4> 
<?php } ?>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script> 


<script>  

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