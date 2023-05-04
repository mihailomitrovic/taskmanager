<?php

require("../konekcija/konekcija.php");
require("../modeli/korisnik.php");

session_start();
if(isset($_POST["button"])) {
    $email = $_POST["email"];
    $lozinka = $_POST["lozinka"];

    $korisnik = new Korisnik(1, "", "", $email, $lozinka);
    $odgovor = Korisnik::prijava($email, $konekcija);
    $rez = $odgovor->fetch_array(MYSQLI_ASSOC); 
    $lozinka = $rez["lozinka"] ?? " ";
    $korisnikID = $rez["korisnikID"] ?? " ";
    $greska = 0;

    if (!password_verify($_POST["lozinka"], $lozinka)) {
        $greska = 1;
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
    <link href="../style/style.css" rel="stylesheet">
</head>
<body>
    <div id="contentreg">
        <div id = "logocontainer_reg">
            <a href="index.php" id="logolink"><img src="../slike/logo.svg" id="logo"></a>
        </div>

        <h2 id="crvena">Prijava</h2>
    
        <form class="container" method="post" action="" enctype="multipart/form-data" novalidate>      
            <h3>Email*</h3>
            <input type="email" name="email" id="email" class="input" placeholder="Email" required>        
            <h3>Lozinka*</h3>
            <input type="password" name="lozinka" id="lozinka" class="input" placeholder="Šifra" required>   
            
            <div id="nepoklapajuse">
                <h4 class="crvena">Email adresa i lozinka se ne poklapaju - pokušaj opet</h4>
            </div>

            <div class="buttoncontainer">
                <button class="button" name="button" id="button" type="submit">Prijavi se</button>
            </div>

            <a href="registracija.php" class="reroute"><p>Nemaš nalog? Registruj se<p></a>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script> 

<script>  
    function promeniFormu() {
        $("#button").on("click", function(){
            if($("#email").val() == null){
                $("#email").css("border", "2px solid red");
            }
    promeniFormu();
});
    }
</script>

</body>
</html>