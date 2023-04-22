<?php
require "../konekcija/konekcija.php";
require "../modeli/zadatak.php";

$zadatak = trim($_GET["zadatak"]);
$slika = trim($_GET["slika"]);

Zadatak::obrisiSliku($zadatak, $konekcija);
unlink($slika);
?>

<input type="file" name="real_file" id="real_file" accept=".jpg, .jpeg, .png" value="" hidden="hidden">
<button type="button" id="custom_button" class="inputslika1b">Ubaci sliku</button>

