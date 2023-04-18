<?php

class Kategorija {
    public $kategorijaID;
    public $nazivKategorije;

    public function __construct($kategorijaID = null, $nazivKategorije = null) {
        $this->kategorijaID = $kategorijaID;
        $this->nazivKategorije = $nazivKategorije;
    }

    public static function vratiKategorije(mysqli $konekcija) {
        $upit = "SELECT * FROM kategorija";
        $resultset = $konekcija->query($upit);
        $kategorije = [];

        while($kat = $resultset->fetch_object()){
            $kategorije[] = $kat;
        }

        return $kategorije;
    }

}

?>