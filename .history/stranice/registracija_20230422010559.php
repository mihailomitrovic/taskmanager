<?php
    require("../konekcija/konekcija.php");
    require("../modeli/korisnik.php");

    if(isset($_POST["button2b"])) {
        $ime = $_POST["ime"];
        $prezime = $_POST["prezime"];
        $email = $_POST["email"];
        $lozinka = password_hash($_POST["lozinka"], PASSWORD_DEFAULT);

        $korisnik = new Korisnik(1, $ime, $prezime, $email, $lozinka);
        $odgovor = Korisnik::provera($korisnik, $konekcija);
        Korisnik::registracija($ime, $prezime, $email, $lozinka, $konekcija);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Registracija</title>
    <link href="../style/style.css" rel="stylesheet">
</head>

<body>
    <div id="content">
        <div id = "logocontainer_reg">
            <a href="pocetna.php" id="logolink"><img src="../slike/logo.svg" id="logo"></a>
        </div>

        <h2 id="zelena">Registracija</h2>
    
        <form class="container" method="post" action="" autocomplete="off" id="forma" enctype="multipart/form-data">
            <h3>Ime*</h3>
            <input type="text" name="ime" class="input" placeholder="Ime" required>        
            <h3>Prezime*</h3>
            <input type="text" name="prezime" class="input" placeholder="Prezime" required>        
            <h3>Email*</h3>
            <input type="email" name="email" class="input" placeholder="Email" required>        
            <h3>Lozinka*</h3>
            <input type="password" name="lozinka" class="input" placeholder="Šifra" required>        

            <div class="buttoncontainer">
                <button class="button2b" name="button2b" type="submit" onclick="predaj();">Registruj se</button>
            </div>

            <a href="prijava.php" class="reroute" id="link"><p>Već imaš nalog? Prijavi se<p></a>

            <div class="prikazi" id="prikazi">
            <h4>Zadatak je uspešno dodat<h4>
            <div>
            
        </form>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script> 

<script>  
    function predaj() {
        $("#forma").ajaxForm(function() {
            $("#prikazi").css("visibility", "visible");
            $("#link").css("visibility", "none");
        })
    }
</script>

</body>
</html>