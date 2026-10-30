<?php

// Kamu bisa menggunakan Trait jika memenuhi kondisi-kondisi berikut:

// 1. Digunakan oleh banyak class berbeda yang tidak punya hubungan silsilah (inheritance).

// 2. Fungsi/method tersebut sudah memiliki isi kode yang lengkap (bukan kontrak kosong seperti interface).

// 3. Isi kode atau logikanya sama persis sehingga tidak perlu ditulis ulang di tiap class.

// 4. Kode tersebut butuh mengakses $this atau mengelola properti/data milik objek yang memanggilnya.








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








// 1. Membuat Trait yang berisi fungsi siap pakai
trait TimestampTrait {
    public $dibuatPada;

    public function setWaktuBuat() {
        $this->dibuatPada = date('Y-m-d H:i:s');
        return "Data dibuat pada: " . $this->dibuatPada;
    }
}

// 2. Class Buku (Tidak ada hubungan keluarga dengan Transaksi)
class Buku {
    use TimestampTrait; // Menempelkan Trait
    public $judul;
}

// 3. Class Transaksi (Sama sekali berbeda dengan Buku)
class Transaksi {
    use TimestampTrait; // Menempelkan Trait yang SAMA persis
    public $totalHarga;
}

// --- CARA MENJALANKANNYA ---
$bukuBaru = new Buku();
echo $bukuBaru->setWaktuBuat(); // Berhasil! Padahal Buku bukan turunan TimestampTrait.

$transaksiBaru = new Transaksi();
echo $transaksiBaru->setWaktuBuat(); // Berhasil juga!
















trait CanRun
{
    public abstract function run(): void;//wajib di tulis ulang
}

class Person {
    use CanRun;
    
    public function run(): void
    {
        echo "Person {$this->name} is running" . PHP_EOL;
    }
}



// selain itu ada juga override oleh trait
//urutan prioritas override
//ParentClass = override by => Traits = override by => ChildClass




// bisa juga mengubah visibilitas dari funstion dari traits
// use SayGoodBye, SayHello, HasName, CanRun {
//     hello as private; jadi ini itu mengubah yang awlanya sebuh function nama hello dengan visibilitas public diubah menjadi private
//     goodBye as private;
// }













//==================================================jika functio sama tapi beda traits=========================================
trait TraitA {
    public function pesan() {
        return "Pesan dari Trait A";
    }
}

trait TraitB {
    public function pesan() {
        return "Pesan dari Trait B";
    }
}

class Komunikasi {
    use TraitA, TraitB; 
    // ERROR! PHP bingung: mau pakai pesan() milik TraitA atau TraitB?
}





//versi yang bnar

trait TraitA {
    public function pesan() {
        return "Pesan dari Trait A";
    }
}

trait TraitB {
    public function pesan() {
        return "Pesan dari Trait B";
    }
}

class Komunikasi {
    use TraitA, TraitB {
        // 1. Artinya: "Gunakan fungsi pesan() dari TraitB, abaikan yang dari TraitA"
        TraitB::pesan insteadof TraitA;

        // 2. Artinya: "Simpan juga fungsi pesan() milik TraitA, tapi ganti namanya jadi pesanA"
        TraitA::pesan as pesanA;
    }
}

// --- CARA MENJALANKANNYA ---
$objek = new Komunikasi();

echo $objek->pesan() . "<br>";   
// Output: Pesan dari Trait B (karena dipilih menggunakan insteadof)

echo $objek->pesanA(); 
// Output: Pesan dari Trait A (karena diganti namanya jadi pesanA menggunakan 'as')
?>










<!-- =========================================ini outputnya========================================= -->
<!-- 
Budi berhasil masuk ke aplikasi.
[LOG SISTEM] 2026-10-20 10:57:00 - User login ke sistem.

Stok produk Laptop Gaming diperbarui.
[LOG SISTEM] 2026-10-20 10:57:00 - Stok produk diperbarui. -->