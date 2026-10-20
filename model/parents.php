<?php

class Kendaraan {
    public $jenisKendaraan, $jarakTempuh;

    public function __construct($jenisKendaraan, $jarakTempuh) {
        $this->jenisKendaraan = $jenisKendaraan;
        $this->jarakTempuh = $jarakTempuh;
    }

    public function sayJenis() {
        echo "<br>jenis kendaraan ini adalah {$this->jenisKendaraan}<br>";
    }

    final function antiOverride() {
        echo "<br>ini anti override jadi aman dan jenis kendaraan ini adalah adalah {$this->jenisKendaraan}<br>";
    }
}