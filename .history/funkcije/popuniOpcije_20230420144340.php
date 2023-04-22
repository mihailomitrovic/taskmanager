<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$korisnik = trim($_GET["korisnik"]);

$zadaci = Zadatak::vratiZadatkeZaOpcije($korisnik, $konekcija);
?>

<option value="" disabled selected hidden><?= "Zadaci" ?> </option>
<?php

foreach ($zadaci as $zad) {
    ?>
    <option value="<?= $zad->zadatakID ?>"><?= $zad->naziv ?> </option>
    <?php
} }
?>

<script>  
    function popuniOpcije() {
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
    popuniOpcije();
</script>