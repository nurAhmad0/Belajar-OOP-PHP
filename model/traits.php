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










<!-- =========================================ini outputnya========================================= -->
/**
 * =====================================================================
 * PANDUAN LENGKAP & CATATAN: TRAIT INHERITANCE DI PHP
 * =====================================================================
 * 
 * Topik Utama:
 * 1. Apa itu Trait Inheritance (Trait composing Traits)?
 * 2. Menggabungkan/Mewarisi Trait ke dalam Trait lain.
 * 3. Aturan Prioritas / Override (Precedence Rules) di OOP PHP:
 *    Parent Class vs Trait vs Subclass.
 */

namespace App\Panduan;

// =====================================================================
// 1. DUA TRAIT DASAR
// =====================================================================

trait Loggable {
    public function log(string $pesan): string {
        return "[LOG]: " . $pesan;
    }
}

trait Authenticatable {
    public function checkAuth(): string {
        return "[AUTH]: User terverifikasi.";
    }
}


// =====================================================================
// 2. TRAIT INHERITANCE (Trait Mewarisi / Memakai Trait Lain)
// =====================================================================
/**
 * KONSEP:
 * Seperti halnya class yang bisa memakai trait, sebuah Trait JUGA BISA
 * menggunakan Trait lain! Ini sering disebut "Trait Composition" atau 
 * "Trait Inheritance".
 */
trait UserManagementTrait {
    // Trait ini menyerap kemampuan dari Loggable dan Authenticatable
    use Loggable, Authenticatable;

    public function createUser(string $nama): string {
        // Bisa mengakses method dari trait yang diserap ($this->log)
        $statusLog = $this->log("Membuat user baru: " . $nama);
        $statusAuth = $this->checkAuth();
        
        return $statusAuth . " | " . $statusLog;
    }
}


// =====================================================================
// 3. ATURAN PRIORITAS OVERRIDE (PRECEDENCE RULES)
// =====================================================================
/**
 * ATURAN EMAS PRIORITAS METHOD DI PHP:
 * 1. Method di Current Class (Subclass)  ==> PRIORITAS 1 (Paling Kuat / Menimpa Semua)
 * 2. Method di Trait                    ==> PRIORITAS 2 (Menimpa Parent Class)
 * 3. Method di Parent Class             ==> PRIORITAS 3 (Paling Lemah)
 */

// A. Class Induk (Parent)
class BaseService {
    public function getRole(): string {
        return "Role dari Parent Class (BaseService)";
    }
}

// B. Trait dengan Nama Method yang Sama
trait RoleTrait {
    public function getRole(): string {
        return "Role dari Trait (RoleTrait)";
    }
}

// C. Class Anak (Subclass) yang Menggabungkan Parent & Trait
class UserService extends BaseService {
    // Memakai Trait yang memiliki method getRole()
    use RoleTrait;

    // KETENTUAN:
    // Jika method getRole() TIDAK didefinisikan di class ini,
    // maka method milik RoleTrait yang akan menang dan MENIMPA milik BaseService.

    // Jika kamu meng-uncomment fungsi di bawah ini, 
    // maka method milik class ini yang akan MENANG menimpa Trait dan Parent:
    
    /*
    public function getRole(): string {
        return "Role dari Current Class (UserService)";
    }
    */
}


// =====================================================================
// 4. PENGUJIAN / DEMO CODE
// =====================================================================

class AppManager {
    // Memakai Trait hasil komposisi (UserManagementTrait)
    use UserManagementTrait;
}

echo "=== 1. DEMO TRAIT INHERITANCE / COMPOSITION ===\n";
$app = new AppManager();
echo $app->createUser("Budi") . "\n\n";

echo "=== 2. DEMO ATURAN PRIORITAS (PRECEDENCE) ===\n";
$userSvc = new UserService();
// Output ini akan membuktikan bahwa Method Trait MENIMPA Method Parent Class!
echo $userSvc->getRole() . "\n";

/**
 * CATATAN RINGKASAN UNTUK DIINGAT:
 * 
 * 1. Trait Inherit/Compose:
 *    - Trait A bisa `use Trait B, Trait C;` di dalam dirinya.
 *    - Class yang memakai Trait A otomatis mendapatkan method milik B & C.
 * 
 * 2. Hierarki Override:
 *    [ Current Class ] > [ Trait ] > [ Parent Class ]
 *    - Method di Class sendiri menimpa Method Trait.
 *    - Method di Trait menimpa Method dari Parent Class.
 */

