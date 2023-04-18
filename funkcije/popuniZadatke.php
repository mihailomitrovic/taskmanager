<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadaci = Zadatak::vratiZadatkeZaOpcije($konekcija);

?>
<option value="" disabled selected hidden><?= "Zadaci" ?> </option>
<?php

foreach ($zadaci as $zad) {
    ?>
    <option value="<?= $zad->zadatakID ?>"><?= $zad->naziv ?> </option>
    <?php
}
?>