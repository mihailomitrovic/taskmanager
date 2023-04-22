<?php

class Korisnik {
    public $korisnikID;
    public $ime;
    public $prezime;
    public $email;
    public $lozinka;

    public function __construct($korisnikID = null, $ime = null, $prezime = null, $email = null, $lozinka = null) {
        $this->korisnikID = $korisnikID;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->email = $email;
        $this->lozinka = $lozinka;
    }

    public static function provera($korisnik, mysqli $konekcija)
    {
        $upit = "SELECT * FROM korisnik WHERE email = '$korisnik->email'";
        $korisnik = $konekcija->query($upit);
        return $korisnik;
    }

    public static function prijava($email, mysqli $konekcija) {
        $upit = "SELECT * FROM korisnik WHERE email = '$email'";
        $korisnik = $konekcija->query($upit);
        return $korisnik;
    }
}

?>