<?php
require_once "model/parents.php";

class Mobil extends Kendaraan{
    public function khususMobil () {
        echo "ini Mobil";
    }

    public function sayJenis() {
        echo "<br>jenis kendaraan ini adalah {$this->jenisKendaraan} dan ini sudah di override<br>";
    }
}