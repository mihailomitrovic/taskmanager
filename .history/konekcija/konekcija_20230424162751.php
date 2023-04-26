<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "taskmanager";

$konekcija = mysqli_connect($host, $user, $pass, $db);

if ($konekcija->errno) {
    exit('Neuspešno povezivanje');
}
