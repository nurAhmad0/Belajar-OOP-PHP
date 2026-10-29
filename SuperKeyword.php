<?php
//Mengakses Konstanta Induk yang Ditimpa (Overridden Constants)
class Database {
    const TIMEOUT = 30; // Detik
}

class DatabaseKhusus extends Database {
    const TIMEOUT = 10; // Menimpa timeout jadi lebih cepat

    public function cekWaktu() {
        return "Waktu khusus: " . self::TIMEOUT . ", Waktu standar induk: " . parent::TIMEOUT;
    }
}






//Mengakses Static Method atau Static Property Milik Induk
class Induk {
    public static function info() {
        return "Ini info dari Induk";
    }
}

class Anak extends Induk {
    public static function info() {
        // Memanggil static method milik induk meskipun ditimpa oleh anak
        return parent::info() . " + Tambahan dari Anak";
    }
}

echo Anak::info(); 
// Output: Ini info dari Induk + Tambahan dari Anak








//Memanggil Constructor Induk (parent::__construct)
class Karyawan {
    public $nama, $gaji;
    public function __construct($nama, $gaji) {
        $this->nama = $nama;
        $this->gaji = $gaji;
    }
}

class Programmer extends Karyawan {
    public $bahasa;
    public function __construct($nama, $gaji, $bahasa) {
        // Memanggil constructor induk supaya tidak menulis ulang $this->nama & $gaji
        parent::__construct($nama, $gaji); 
        $this->bahasa = $bahasa;
    }
}