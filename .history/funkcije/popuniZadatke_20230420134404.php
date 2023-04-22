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
<option value="" disabled selected hidden><?= "Zadaci" ?> </option>
<?php

foreach ($zadaci as $zad) {
    ?>
    <option value="<?= $zad->zadatakID ?>"><?= $zad->naziv ?> </option>
    <?php
} }
?>

<script>  
    function popuniZadatke() {
        let korisnik = "<?php echo $korisnik; ?>";
        $.ajax({
            url: '../funkcije/popuniOpcije.php',
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
</script>