<?php

session_start();
session_destroy();
setcookie("korisnik", "", time() - 60*60*60);
header("Location:index.php");