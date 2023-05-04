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
    
        <form class="container" method="post" action="" autocomplete="off" id="formareg" enctype="multipart/form-data" novalidate>
            <h3>Ime*</h3>
            <input type="text" name="ime" id="ime" class="input" placeholder="Ime" required>
            
            <div id="faliime">
                <h5 class="crvena">Unesi ime</h5>
            </div>

            <h3>Prezime*</h3>
            <input type="text" name="prezime" id="prezime" class="input" placeholder="Prezime" required>    
            
            <div id="faliprezime">
                <h5 class="crvena">Unesi prezime</h5>
            </div>
            
            <h3>Email*</h3>
            <input type="email" name="email" id="email" class="input" placeholder="Email" required>   
            
            <div id="faliemail" >
                <h5 class="crvena">Unesi email</h5>
            </div>

            <h3>Lozinka*</h3>
            <input type="password" name="lozinka" id="lozinka" class="input" placeholder="Šifra" required>  
            
            <div id="falilozinka" >
                <h5 class="crvena">Unesi lozinku</h5>
            </div>

            <div id="kratkalozinka" >
                <h5 class="crvena">Lozinka mora imati najmanje 6 karaktera</h5>
            </div>


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
            $("#prikazilink").html("<a href='prijava.php' style='color: #1bb793'><h4>Registracija je uspešna - prijavi se!</h4></a>");
            $("#ime").val("").change();
            $("#prezime").val("").change();
            $("#email").val("").change();
            $("#lozinka").val("").change();
        })
    }

    const form = document.getElementById('formareg');
    const email = document.getElementById('email');
    const lozinka = document.getElementById('lozinka');
    const ime = document.getElementById('ime');
    const prezime = document.getElementById('prezime');

    
    form
  .addEventListener(
    'submit',
    (event) => {
        email.classList.toggle('error', !email.validity.valid);
        lozinka.classList.toggle('error', !lozinka.validity.valid);
        ime.classList.toggle('error', !ime.validity.valid);
        prezime.classList.toggle('error', !prezime.validity.valid);
        faliemail.classList.toggle('promeni', !email.validity.valid);
        falilozinka.classList.toggle('promeni', !lozinka.validity.valid);
        faliime.classList.toggle('promeni', !ime.validity.valid);
        faliprezime.classList.toggle('promeni', !prezime.validity.valid);

      if(!email.validity.valid){
        event.preventDefault();
      }

      if(!lozinka.validity.valid){
        event.preventDefault();
      }

      if(lozinka.value.length < 6) {
        kratkalozinka.classList.toggle('promeni', !lozinka.validity.valid);
        event.preventDefault();
      }

      if(!ime.validity.valid){
        event.preventDefault();
      }


      if(!prezime.validity.valid){
        event.preventDefault();
      }
    }
);

email
  .addEventListener(
    'input',
    () => {
        email.classList.toggle('uredu', email.validity.valid);
    }
);

lozinka
  .addEventListener(
    'input',
    () => {
        lozinka.classList.toggle('uredu', lozinka.validity.valid);
    }
);

ime
  .addEventListener(
    'input',
    () => {
        ime.classList.toggle('uredu', ime.validity.valid);
    }
);

prezime
  .addEventListener(
    'input',
    () => {
        prezime.classList.toggle('uredu', prezime.validity.valid);
    }
);
</script>

</body>
</html>