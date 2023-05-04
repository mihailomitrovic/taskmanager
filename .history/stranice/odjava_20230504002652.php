<?php

session_destroy();
setcookie("korisnik", "", time() - 3600);
header("Location:index.php");