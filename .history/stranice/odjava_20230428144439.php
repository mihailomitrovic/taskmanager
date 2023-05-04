<?php

require("../stranice/glavna.php");

session_start();
session_destroy();
setcookie("korisnik", "", time() - 3600);
header("Location:index.php");