<?php

class Zadatak {
    public $zadatakID;
    public $naziv;
    public $korisnik;
    public $kategorija;
    public $opis;
    public $datumKreiranja;
    public $izvrsen;
    public $datumZavrsetka;
    public $slika;

    public function __construct($zadatakID = null, $naziv = null, $korisnik = null, $kategorija = null, $opis = null, $datumKreiranja = null, $izvrsen = null, $datumZavrsetka = null, $slika = null) {
        $this->zadatakID = $zadatakID;
        $this->naziv = $naziv;
        $this->korisnik = $korisnik;
        $this->kategorija = $kategorija;
        $this->opis = $opis;
        $this->datumKreiranja = $datumKreiranja;
        $this->izvrsen = $izvrsen;
        $this->datumZavrsetka = $datumZavrsetka;
        $this->slika = $slika;
    }

    public static function vratiZadatke($izvrsen, $kategorija, mysqli $konekcija) {    
        $upit = "SELECT * FROM zadatak z JOIN kategorija k ON k.kategorijaID = z.kategorija WHERE izvrsen = " . $izvrsen;

        if ($kategorija != "0") {
            $upit .= " AND kategorija = " . $kategorija;
        }

        $upit .= " ORDER BY izvrsen ASC";

        $resultset = $konekcija->query($upit);
        $zadaci = [];

        while($zadatak = $resultset->fetch_object()) {
            $zadaci[] = $zadatak;
        }

        return $zadaci;
    }

    public static function vratiZadatkeZaOpcije(mysqli $konekcija) {    
        $upit = "SELECT * FROM zadatak";
        $resultset = $konekcija->query($upit);
        $zadaci = [];

        while($zadatak = $resultset->fetch_object()) {
            $zadaci[] = $zadatak;
        }

        return $zadaci;
    }

    public static function vratiPodatke($zadatakID, mysqli $konekcija) {    
        $upit = "SELECT * FROM zadatak z JOIN kategorija k ON k.kategorijaID = z.kategorija WHERE zadatakID = " . $zadatakID;
        $resultset = $konekcija->query($upit);
        $zadatak = $resultset->fetch_object();
        return $zadatak;
    }

    public static function dodaj($naziv, $korisnik, $kategorija, $opis, mysqli $konekcija) {
        $datumKreiranja = date('Y-m-d H:i:s');
        $izvrsen = 0;

        $dodaj = $konekcija->prepare("INSERT INTO zadatak(naziv, korisnik, kategorija, opis, datumKreiranja, izvrsen) VALUES (?,?,?,?,?,?)");
        $dodaj->bind_param("siissi", $naziv, $korisnik, $kategorija, $opis, $datumKreiranja, $izvrsen);
        $dodaj->execute();
        return $dodaj;
    }

    public static function izmeni($zadatak, $naziv, $kategorija, $opis, $izvrsen, mysqli $konekcija) {
        $datumZavrsetka = null;

        if ($izvrsen == "1") {
            $datumZavrsetka = date('Y-m-d H:i:s');
        }

        $dodaj = $konekcija->prepare("UPDATE zadatak SET naziv = ?, kategorija = ?, opis = ?, izvrsen = ?, datumZavrsetka = ? WHERE zadatakID = ?");
        $dodaj->bind_param("sisisi", $naziv, $kategorija, $opis, $izvrsen, $datumZavrsetka, $zadatak);
        $dodaj->execute();
        return $dodaj;
    }

    public static function izvrsiZadatak($zadatakID, $izvrsen, mysqli $konekcija) {
        if ($izvrsen == "1") {
            $nova = "0";
            $datumZavrsetka = date('Y-m-d H:i:s');
        } elseif ($izvrsen == "0") {
            $nova = "1";
            $datumZavrsetka = null;
        }

        $dodaj = $konekcija->prepare("UPDATE zadatak SET izvrsen = ? WHERE zadatakID = ?");
        $dodaj->bind_param("ii", $nova, $zadatakID);
        $dodaj->execute();
        return $dodaj;
    }

    public static function obrisi($zadatakID, mysqli $konekcija)
    {
        $query = "DELETE FROM zadatak WHERE zadatakID = " . $zadatakID;
        $odgovor =  $konekcija->query($query);
        return $odgovor;
    }


}

?>