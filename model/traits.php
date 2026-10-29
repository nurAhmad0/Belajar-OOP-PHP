<?php

// 1. Membuat Trait
trait Logger {
    public function catatLog($pesan) {
        echo "[LOG SISTEM] " . date('Y-m-d H:i:s') . " - " . $pesan . "<br>";
    }
}

// 2. Class User menggunakan Trait Logger
class User {
    use Logger; // Menempelkan Trait di sini
    
    public $nama = "Budi";

    public function login() {
        echo "{$this->nama} berhasil masuk ke aplikasi.<br>";
        // Memanggil method yang berasal dari Trait
        $this->catatLog("User login ke sistem.");
    }
}

// 3. Class Product menggunakan Trait Logger yang SAMA
class Product {
    use Logger; // Menempelkan Trait yang sama tanpa duplikasi kode
    
    public $namaProduk = "Laptop Gaming";

    public function updateStok() {
        echo "Stok produk {$this->namaProduk} diperbarui.<br>";
        // Memanggil method yang berasal dari Trait
        $this->catatLog("Stok produk diperbarui.");
    }
}

// --- EKSEKUSI ---
$user = new User();
$user->login();

echo "<br>";

$product = new Product();
$product->updateStok();




//perbedaan static method dengan traits
//static method
class Kalkulator {
    // Dibuat static
    public static function tambah($a, $b) {
        // Static method TIDAK BISA pakai $this
        return $a + $b; 
    }
}

// Cara Memanggilnya (TIDAK PERLU pakai 'new')
$hasil = Kalkulator::tambah(5, 10); 
echo $hasil; // Output: 15







//traits
// 1. Buat Trait
trait BisaTeriak {
    public function teriak() {
        // Trait BISA pakai $this karena nanti melekat pada objek
        return "Halo, nama saya adalah " . $this->nama; 
    }
}

// 2. Tempelkan ke Class
class Orang {
    use BisaTeriak; // Menyatu di sini
    public $nama = "Budi";
}

// 3. Cara Memanggilnya (Wajib pakai 'new' karena pakai $this)
$orang = new Orang();
echo $orang->teriak(); // Output: Halo, nama saya adalah Budi
?>









<!-- =========================================ini outputnya========================================= -->
<!-- 
Budi berhasil masuk ke aplikasi.
[LOG SISTEM] 2026-10-20 10:57:00 - User login ke sistem.

Stok produk Laptop Gaming diperbarui.
[LOG SISTEM] 2026-10-20 10:57:00 - Stok produk diperbarui. -->