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
    <div id="contentreg">
        <div id = "logocontainer_reg">
            <a href="index.php" id="logolink"><img src="../slike/logo.svg" id="logo"></a>
        </div>

        <h2 id="zelena">Registracija</h2>
    
        <form class="container" method="post" action="" autocomplete="off" id="formareg" enctype="multipart/form-data">
            <h3>Ime*</h3>
            <input type="text" name="ime" id="ime" class="input" placeholder="Ime" required>        
            <h3>Prezime*</h3>
            <input type="text" name="prezime" id="prezime" class="input" placeholder="Prezime" required>        
            <h3>Email*</h3>
            <input type="email" name="email" id="email" class="input" placeholder="Email" required>        
            <h3>Lozinka*</h3>
            <input type="password" name="lozinka" id="lozinka" class="input" placeholder="Šifra" required>        

            <div class="buttoncontainerreg">
                <button class="button2b" name="button2b" type="submit" onclick="predajKorisnika();">Registruj se</button>
            </div>

            <div class="prikazilink" id="prikazilink">
                <a href="prijava.php" class="reroute" id="link"><p>Već imaš nalog? Prijavi se<p></a>
            <div>
            
        </form>
    </div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script> 

<script>  
    function predajKorisnika() {
        $("#formareg").ajaxForm(function() {
            $("#prikazilink").html("<h4>Uspešno si se registrovao<h4>");
            $("#prikazilink").html("<a><p>Prijavi se<p></a>");
            $("#ime").val("").change();
            $("#prezime").val("").change();
            $("#email").val("").change();
            $("#lozinka").val("").change();
        })
    }
</script>

</body>
</html>