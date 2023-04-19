<?php
require "../konekcija/konekcija.php";
require "../modeli/kategorija.php";

$kategorije = Kategorija::vratiKategorije($konekcija);

?>
<option value="" disabled selected hidden><?= "Kategorija zadatka" ?> </option>
<?php

foreach ($kategorije as $kat) {
    ?>
    <option value="<?= $kat->kategorijaID ?>"><?= $kat->nazivKategorije ?> </option>
    <?php
}
?>

<script>
</script>