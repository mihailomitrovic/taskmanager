<?php

require("../stranice/glavna.phpglavna.php");

session_start();
session_destroy();
setcookie("korisnik", "", time() - 3600);
header("Location:index.php");