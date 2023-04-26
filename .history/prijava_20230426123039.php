<?php

require("./konekcija/konekcija.php");
require("./modeli/korisnik.php");

session_start();
if(isset($_POST["button"])) {
    $email = $_POST["email"];
    $lozinka = $_POST["lozinka"];

    $korisnik = new Korisnik(1, "", "", $email, $lozinka);
    $odgovor = Korisnik::prijava($email, $konekcija);
    $rez = $odgovor->fetch_array(MYSQLI_ASSOC); 
    $lozinka = $rez["lozinka"] ?? " ";
    $korisnikID = $rez["korisnikID"] ?? " ";

    if (!password_verify($_POST["lozinka"], $lozinka)) {
        echo '<script type="text/javascript">
               window.onload = function () { alert("Pogrešno uneti podaci!"); } 
              </script>'; 
    } else {
        $_SESSION["korisnik"] = $korisnikID;
        setcookie("korisnik", $korisnikID, time() + 60*60*60);
        header("Location: glavna.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager - Prijava</title>
    <link href="./style/style.css" rel="stylesheet">
</head>
<body>
    <div id="contentreg">
        <div id = "logocontainer_reg">
            <a href="index.php" id="logolink"><img src="./slike/logo.svg" id="logo"></a>
        </div>

        <h2 id="crvena">Prijava</h2>
    
        <form class="container" method="post" action="" enctype="multipart/form-data">      
            <h3>Email*</h3>
            <input type="email" name="email" class="input" placeholder="Email" required>        
            <h3>Lozinka*</h3>
            <input type="password" name="lozinka" class="input" placeholder="Šifra" required>        

            <div class="buttoncontainer">
                <button class="button" name="button" type="submit">Prijavi se</button>
            </div>

            <a href="registracija.php" class="reroute"><p>Nemaš nalog? Registruj se<p></a>
        </form>
    </div>

<script>  
    function promeniFormu() {
        $("#formareg").ajaxForm(function() {
            $("#prikazilink").html("<a href='prijava.php' style='color: #1bb793'><h4>Registracija je uspešna - prijavi se!</h4></a>");
            $("#ime").val("").change();
            $("#prezime").val("").change();
            $("#email").val("").change();
            $("#lozinka").val("").change();
        })
    }

    function promeniFormu() {

    }
</script>

</body>
</html>