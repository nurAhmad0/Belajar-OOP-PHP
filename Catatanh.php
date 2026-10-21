<?php
// dokumentasi oop :https://www.w3schools.com/php/php_oop_classes_objects.asp




//=================================================================================================================================================

// __construct(...): Dijalankan secara otomatis begitu objek dicetak dari class.

// __destruct(): Dijalankan otomatis saat objek dihancurkan atau program selesai.

// __toString(): Mengatur bagaimana objek dibaca jika dipaksa dicetak sebagai teks (echo).








//============================================magic method===============================================================================

/**
 * =====================================================================
 * RANGKUMAN LENGKAP: MAGIC METHODS DI PHP
 * =====================================================================
 * Magic methods adalah fungsi khusus di PHP yang diawali dengan dua 
 * garis bawah (__) dan akan dieksekusi secara otomatis oleh sistem 
 * berdasarkan kondisi atau pemicu tertentu tanpa harus dipanggil manual.
 */

class PanduanMagicMethods {

    // =================================================================
    // 1. __construct()
    // =================================================================
    /**
     * Penjelasan: Dijalankan otomatis saat sebuah objek pertama kali dibuat (diinisiasi).
     * Kondisi: Digunakan untuk menyiapkan data awal (seperti mengisi properti wajib).
     */
    public function __construct($nama) {
        $this->nama =$nama;
    }


    // =================================================================
    // 2. __destruct()
    // =================================================================
    /**
     * Penjelasan: Dijalankan otomatis saat skrip selesai atau objek dihancurkan.
     * Kondisi: Digunakan untuk membersihkan memori atau menutup koneksi database/file.
     */
    public function __destruct() {
        // Contoh: echo "Objek dihancurkan.";
    }


    // =================================================================
    // 3. __toString()
    // =================================================================
    /**
     * Penjelasan: Mengatur apa yang akan dikembalikan saat objek dipaksa dicetak sebagai string (echo).
     * Kondisi: Ketika objek ingin ditampilkan langsung ke layar pakai echo.
     */
    public function __toString() {
        return "Nama objek ini adalah: " . $this->nama;
    }


    // =================================================================
    // 4. __invoke()
    // =================================================================
    /**
     * Penjelasan: Membuat objek agar bisa dipanggil langsung layaknya sebuah fungsi biasa.
     * Kondisi: Ketika objek dirancang agar bisa dieksekusi dengan tanda kurung (contoh: $objek()).
     */
    public function __invoke($pesan) {
        return "Objek dipanggil sebagai fungsi dengan pesan: " . $pesan;
    }


    // =================================================================
    // 5. __get($property)
    // =================================================================
    /**
     * Penjelasan: Dipanggil saat mencoba membaca properti yang bersifat private/protected atau tidak ada.
     * Kondisi: Berguna untuk enkapsulasi atau pengamanan data properti terbaca.
     */
    public function __get($property) {
        return "Properti '$property' tidak bisa diakses atau tidak ada.";
    }


    // =================================================================
    // 6. __set($property,$value)
    // =================================================================
    /**
     * Penjelasan: Dipanggil saat mencoba mengisi nilai ke properti private/protected atau tidak ada.
     * Kondisi: Berguna untuk validasi data sebelum properti dimasukkan nilai baru.
     */
    public function __set($property,$value) {
        // Contoh: $this->$property =$value;
    }


    // =================================================================
    // 7. __isset($property)
    // =================================================================
    /**
     * Penjelasan: Dipanggil saat fungsi isset() atau empty() dicek pada properti private/protected.
     * Kondisi: Untuk mendeteksi keberadaan properti tersembunyi.
     */
    public function __isset($property) {
        return isset($this->$property);
    }


    // =================================================================
    // 8. __unset($property)
    // =================================================================
    /**
     * Penjelasan: Dipanggil saat fungsi unset() digunakan untuk menghapus properti private/protected.
     * Kondisi: Mengatur izin penghapusan properti dari luar kelas.
     */
    public function __unset($property) {
        unset($this->$property);
    }


    // =================================================================
    // 9. __call($method,$arguments)
    // =================================================================
    /**
     * Penjelasan: Dipanggil saat mencoba menjalankan method (fungsi) biasa yang tidak ada atau tidak dapat diakses.
     * Kondisi: Membuat method dinamis (sering dipakai di framework untuk query builder).
     */
    public function __call($method,$arguments) {
        return "Method '$method' tidak ditemukan!";
    }


    // =================================================================
    // 10. __callStatic($method,$arguments)
    // =================================================================
    /**
     * Penjelasan: Mirip seperti __call, tapi khusus untuk method berjenis static (bersifat global kelas).
     * Kondisi: Menangkap pemanggilan method static yang belum didefinisikan.
     */
    public static function __callStatic($method,$arguments) {
        return "Static method '$method' tidak ditemukan!";
    }


    // =================================================================
    // 11. __clone()
    // =================================================================
    /**
     * Penjelasan: Dipanggil secara otomatis ketika sebuah objek diduplikasi menggunakan kata kunci `clone`.
     * Kondisi: Mengatur ulang nilai tertentu pada objek baru hasil salinan agar unik.
     */
    public function __clone() {
        $this->nama =$this->nama . " (Salinan)";
    }


    // =================================================================
    // 12. __sleep()
    // =================================================================
    /**
     * Penjelasan: Dipanggil sebelum objek di-serialize (diubah menjadi bentuk byte/teks untuk disimpan).
     * Kondisi: Menentukan properti mana saja yang boleh ikut disimpan.
     */
    public function __sleep() {
        return ['nama', 'umur']; // Hanya properti ini yang akan disimpan
    }


    // =================================================================
    // 13. __wakeup()
    // =================================================================
    /**
     * Penjelasan: Dipanggil setelah objek di-unserialize (dikembalikan lagi dari bentuk byte/teks).
     * Kondisi: Menyambungkan kembali koneksi database yang terputus saat proses serialize.
     */
    public function __wakeup() {
        // $this->koneksi = mysqli_connect(...);
    }


    // =================================================================
    // 14. __serialize() (PHP 7.4+)
    // =================================================================
    /**
     * Penjelasan: Cara modern menggantikan __sleep() untuk mengontrol proses serialize.
     * Kondisi: Mengembalikan array yang merepresentasikan data objek.
     */
    public function __serialize(): array {
        return [
            'nama' => $this->nama
        ];
    }


    // =================================================================
    // 15. __unserialize() (PHP 7.4+)
    // =================================================================
    /**
     * Penjelasan: Cara modern menggantikan __wakeup() untuk mengontrol proses unserialize.
     * Kondisi: Memulihkan data objek dari array data serialize.
     */
    public function __unserialize(array $data): void {
        $this->nama =$data['nama'];
    }


    // =================================================================
    // 16. __toString() / __debugInfo()
    // =================================================================
    /**
     * Penjelasan: Mengatur data apa saja yang muncul saat fungsi var_dump() dijalankan pada objek.
     * Kondisi: Menyembunyikan data rahasia (seperti password) saat proses debugging.
     */
    public function __debugInfo() {
        return [
            'nama_saja' => $this->nama // Data umur/saldo disembunyikan dari var_dump
        ];
    }


    // =================================================================
    // 17. __set_state()
    // =================================================================
    /**
     * Penjelasan: Dipanggil saat fungsi var_export() dijalankan pada kelas ini.
     * Kondisi: Digunakan untuk mengekspor objek menjadi kode PHP yang valid.
     */
    public static function __set_state($array) {
        $obj = new self($array['nama']);
        return $obj;
    }
}





















//====================================================unset()=========================================================================
// unset digunakna untuk menghapus objek yang ada 


// kondisi dipakai seperti :
// Dalam Perulangan Besar (Looping) yang Membuat Banyak Objek
// Jika programmu membuat ribuan objek di dalam sebuah loop (perulangan), 
// memori RAM komputer/server akan cepat habis karena objek-objek lama menumpuk. 
// Dengan menggunakan unset() di setiap akhir perulangan, objek yang sudah tidak 
// dipakai bisa langsung dibuang untuk menghemat memori.

// Melepaskan Sumber Daya Lebih Awal (Early Resource Cleanup)
// Jika objekmu bertugas membuka file besar atau koneksi database, dan tugas 
// objek itu sudah selesai di tengah-tengah baris kode (padahal file PHP-nya 
// masih sangat panjang ke bawah), kamu bisa memakai unset() agar file atau 
// koneksi tersebut langsung tertutup saat itu juga, tidak perlu menunggu sampai skrip benar-benar habis.





// contoh kodenya:
class KoneksiSistem {
    private $nama;

    public function __construct($nama) {
        $this->nama = $nama;
        echo "Objek '{$this->nama}' berhasil dibuat dan memakan memori.<br>";
    }

    // Destructor akan otomatis terpanggil saat objek dihapus
    public function __destruct() {
        echo "--> Objek '{$this->nama}' dihancurkan oleh unset(), memori dibersihkan.<br><br>";
    }
}

// --- EKSEKUSI PROGRAM ---

echo "1. Program mulai berjalan.<br>";
$db1 = new KoneksiSistem("Database-Utama");

echo "2. Melakukan beberapa pekerjaan dengan Database-Utama...<br>";

// KONDISI: Tugas database pertama sudah selesai di sini. 
// Padahal skrip PHP di bawah masih panjang. Kita sengaja pakai unset():
unset($db1); 

echo "3. Program masih lanjut berjalan jauh di bawah...<br>";
$db2 = new KoneksiSistem("Database-Kedua");

echo "4. Program mencapai baris paling akhir (Skrip Selesai).<br>";








// >================================================<output>================================================



class KoneksiSistem {
    private $nama;

    public function __construct($nama) {
        $this->nama = $nama;
        echo "Objek '{$this->nama}' berhasil dibuat dan memakan memori.<br>";
    }

    // Destructor akan otomatis terpanggil saat objek dihapus
    public function __destruct() {
        echo "--> Objek '{$this->nama}' dihancurkan oleh unset(), memori dibersihkan.<br><br>";
    }
}

// --- EKSEKUSI PROGRAM ---

echo "1. Program mulai berjalan.<br>";
$db1 = new KoneksiSistem("Database-Utama");

echo "2. Melakukan beberapa pekerjaan dengan Database-Utama...<br>";

// KONDISI: Tugas database pertama sudah selesai di sini. 
// Padahal skrip PHP di bawah masih panjang. Kita sengaja pakai unset():
unset($db1); 

echo "3. Program masih lanjut berjalan jauh di bawah...<br>";
$db2 = new KoneksiSistem("Database-Kedua");

echo "4. Program mencapai baris paling akhir (Skrip Selesai).<br>";


// 1. Program mulai berjalan.
// Objek 'Database-Utama' berhasil dibuat dan memakan memori.
// 2. Melakukan beberapa pekerjaan dengan Database-Utama...
// --> Objek 'Database-Utama' dihancurkan oleh unset(), memori dibersihkan.

// 3. Program masih lanjut berjalan jauh di bawah...
// Objek 'Database-Kedua' berhasil dibuat dan memakan memori.
// 4. Program mencapai baris paling akhir (Skrip Selesai).
// --> Objek 'Database-Kedua' dihancurkan oleh unset(), memori dibersihkan.</output>

















// ========================================pengguanaan get dan set ==============================================================

class RekeningBank {
    // Properti dibuat private agar aman dan tidak bisa diubah langsung dari luar
    private $namaPemilik;
    private $saldo;

    // 1. Constructor untuk memasukkan data awal saat objek pertama kali dibuat
    public function __construct($namaPemilik, $saldoAwal) {
        $this->namaPemilik = $namaPemilik;
        $this->saldo = $saldoAwal;
    }

    // ==========================================
    // GETTER: Untuk membaca data private
    // ==========================================
    public function getNamaPemilik() {
        return $this->namaPemilik;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    // ==========================================
    // SETTER: Untuk mengubah/memanipulasi data private
    // ==========================================
    public function setSetorUang($jumlah) {
        // Keuntungan profesional: Kita bisa menyisipkan validasi di sini!
        if ($jumlah > 0) {
            $this->saldo += $jumlah;
            echo "Berhasil setor Rp{$jumlah}. Saldo sekarang: {$this->saldo}<br>";
        } else {
            echo "Jumlah setor tidak valid!<br>";
        }
    }
}

// --- CARA MENGGUNAKANNYA DI LUAR CLASS ---

$akun = new RekeningBank("Budi", 500000);

// ❌ SALAH & AKAN ERROR (Karena properti private):
// echo $akun->saldo; 
// $akun->saldo = 1000000;

// BENAR (Menggunakan Getter untuk membaca):
echo "Pemilik: " . $akun->getNamaPemilik() . "<br>";
echo "Saldo awal: " . $akun->getSaldo() . "<br>";

// BENAR (Menggunakan Setter untuk mengubah data dengan aman):
$akun->setSetorUang(200000);











































































// ========================================pengguanaan konstan ==============================================================
// Mendefinisikan konstanta global
define("APP_VERSION", "2.1.0");
define("BASE_URL", "https://websiteku.com/");

// Cara mengaksesnya langsung dipanggil namanya (tanpa tanda $)
echo "Selamat datang di aplikasi versi " . APP_VERSION . "<br>";
echo "Akses URL utama: " . BASE_URL;

// define() adalah fungsi bawaan PHP yang digunakan untuk mendeklarasikan sebuah 
// nilai tetap yang bisa diakses dari seluruh bagian program (bersifat global), 
// baik di dalam file utama maupun di dalam class. Nilainya tidak akan pernah bisa diubah lagi setelah dideklarasikan.

// Kapan digunakan?
// Biasanya digunakan untuk menyimpan konfigurasi atau pengaturan utama aplikasi yang 
// sifatnya universal dan berlaku untuk seluruh sistem.







/**
 * =====================================================================
 * CATATAN LENGKAP: MEMAHAMI "define()" DAN "const" DI PHP & OOP
 * =====================================================================
 * File ini merangkum seluruh aturan, perbedaan, fungsi, dan kapan harus 
 * menggunakan define(), const, serta perbandingannya dengan properti biasa.
 */


// =====================================================================
// BAGIAN 1: APA ITU KONSTANTA?
// =====================================================================
/**
 * Konstanta adalah wadah untuk menyimpan nilai yang SIFATNYA TETAP, 
 * mutlak, dan tidak bisa diubah-ubah sepanjang program berjalan.
 * Jika dipaksa diubah di tengah jalan, PHP akan mengeluarkan Fatal Error.
 */


// =====================================================================
// BAGIAN 2: FUNGSI define() (Konstanta Global & Dinamis)
// =====================================================================
/**
 * ATURAN PENTING define():
 * 1. Bersifat global (bisa dipanggil di mana saja dalam file).
 * 2. HANYA BISA ditulis di LUAR class. Tidak boleh ditaruh di dalam class!
 * 3. Bersifat run-time (bisa ditaruh di dalam blok kondisi seperti if/else).
 */

// Contoh penggunaan define():
define("APP_NAME", "Sistem Informasi Akademik");
define("APP_VERSION", "1.5.0");

// Contoh define di dalam kondisi (ini TIDAK BISA dilakukan oleh const):
$statusServer = "development";
if ($statusServer == "development") {
    define("DB_HOST", "localhost_dev");
} else {
    define("DB_HOST", "localhost_production");
}

echo "Aplikasi: " . APP_NAME . " (Versi " . APP_VERSION . ")<br>";
echo "Database Host aktif: " . DB_HOST . "<br><br>";


// =====================================================================
// BAGIAN 3: KEYWORD const (Di Luar Class / Global)
// =====================================================================
/**
 * Di PHP modern, const juga bisa digunakan di luar class (global).
 * Fungsinya mirip define, tapi bersifat static/compile-time (tidak bisa 
 * ditaruh di dalam blok if/else).
 */

const WEBSITE_URL = "https://belajaroop.test";
const MAX_LOGIN_ATTEMPT = 3;

echo "Situs web: " . WEBSITE_URL . "<br>";
echo "Maksimal percobaan login: " . MAX_LOGIN_ATTEMPT . "<br><br>";


// =====================================================================
// BAGIAN 4: KEYWORD const DI DALAM CLASS (Standar OOP Profesional)
// =====================================================================
/**
 * Di dalam OOP modern, const ditaruh di dalam class agar nilainya 
 * terkurung rapi dan khusus melekat pada class tersebut (Encapsulation).
 * 
 * Cara Akses:
 * - Dari DALAM class sendiri : menggunakan keyword "self::NAMA_CONST"
 * - Dari LUAR class          : menggunakan "NamaClass::NAMA_CONST" (tanpa new)
 */

class KeranjangBelanja {
    // Konstanta khusus di dalam class
    const DISKON_MEMBER = 0.15; // Diskon 15%
    const PAJAK_LAYANAN = 0.05; // Pajak 5%

    private $totalBelanja;

    public function __construct($total) {
        $this->totalBelanja = $total;
    }

    public function hitungTotalAkhir() {
        // Mengakses const di dalam class menggunakan self::
        $potongan = $this->totalBelanja * self::DISKON_MEMBER;
        $pajak    = $this->totalBelanja * self::PAJAK_LAYANAN;
        $hasil    = ($this->totalBelanja - $potongan) + $pajak;
        
        return $hasil;
    }
}

// Cara mengakses const dari luar class (Tanpa buat objek):
echo "Besaran Diskon Member: " . (KeranjangBelanja::DISKON_MEMBER * 100) . "%<br>";

// Menggunakan class secara utuh
$belanjaanBudi = new KeranjangBelanja(500000);
echo "Total bayar setelah diskon dan pajak: Rp" . $belanjaanBudi->hitungTotalAkhir() . "<br><br>";


// =====================================================================
// BAGIAN 5: KENAPA PAKAI const, BUKAN PROPERTI BIASA (public/private)?
// =====================================================================
/**
 * Perbedaan Mendasar:
 * 1. Properti Biasa (public/private $variabel):
 *    - Sifatnya DINAMIS (bisa diisi, diubah, dan nilainya bisa berbeda-beda 
 *      untuk tiap objek yang dibuat). Contoh: saldo user, nama, status bayar.
 * 
 * 2. Konstanta Kelas (const NAMA):
 *    - Sifatnya KAKU & TETAP (tidak boleh berubah sampai kapan pun). 
 *      Nilainya sama persis untuk seluruh objek yang dibuat dari class tersebut. 
 *      Contoh: biaya pendaftaran wajib, persentase pajak, kode status baku.
 */

class PendaftaranKuliah {
    // --- INI CONST (Aturan tetap untuk semua orang, tidak boleh diubah) ---
    const BIAYA_PENDAFTARAN = 250000;

    // --- INI PROPERTI BIASA (Data dinamis yang bisa beda-beda tiap orang) ---
    private $namaMahasiswa;
    private $statusPembayaran;

    public function __construct($nama) {
        $this->namaMahasiswa = $nama;
        $this->statusPembayaran = "Belum Bayar"; // Bisa diubah nanti
    }

    public function cetakInfo() {
        echo "Mahasiswa: {$this->namaMahasiswa}<br>";
        // Mengakses const di dalam method
        echo "Wajib Bayar: Rp" . self::BIAYA_PENDAFTARAN . "<br>";
        echo "Status: {$this->statusPembayaran}<br>";
    }

    public function lunasi() {
        // Mengubah properti biasa (BOLEH karena ini variabel dinamis)
        $this->statusPembayaran = "Lunas";
        echo "Status {$this->namaMahasiswa} berhasil diubah menjadi Lunas!<br>";
    }
}

// Simulasi penggunaan:
$mhs1 = new PendaftaranKuliah("Siti");
$mhs1->cetakInfo();
$mhs1->lunasi();


// =====================================================================
// BAGIAN 6: RINGKASAN & KAPAN HARUS MEMAKAI YANG MANA?
// =====================================================================
/**
 * 1. Gunakan "const" di dalam class  -> Untuk aturan/konstanta yang spesifik 
 *                                      milik suatu class (Standar Utama OOP).
 * 2. Gunakan "const" di luar class  -> Untuk konstanta global file konfigurasi.
 * 3. Gunakan "define()"             -> Hanya jika butuh konstanta dinamis yang 
 *                                      harus ditaruh di dalam blok if/else.
 * 4. Gunakan properti biasa         -> Untuk data objek yang nilainya dinamis 
 *                                      dan bisa berubah-ubah (saldo, nama, dll).
 */






//kalau akses const didalam clas itu pakai self

class Person{

    const AUTHOR = "Programmer Zaman Now";

    function info() {

        echo "AUTHOR : " . self::AUTHOR . PHP_EOL;
    }

}


//kalau akses const didalam clas itu pakai nama classnya sediri
class KonfigurasiApp {
    // Membuat const di dalam class
    const NAMA_APLIKASI = "Sistem Toko Online";
    const VERSI = "2.5.0";
}

// --- CARA MENGAKSES CONST DARI LUAR CLASS ---

// 1. Mengakses const NAMA_APLIKASI
echo "Nama Aplikasi: " . KonfigurasiApp::NAMA_APLIKASI . "<br>";

// 2. Mengakses const VERSI
echo "Versi: " . KonfigurasiApp::VERSI . "<br>";














// ========================================namespace ==============================================================


/**
 * =====================================================================
 * CATATAN LENGKAP: MEMAHAMI "NAMESPACE" DALAM PHP & OOP MODERN
 * =====================================================================
 * File ini merangkum seluruh konsep, fungsi, hubungan dengan folder fisik,
 * serta contoh penerapan namespace untuk mencegah bentrokan nama class.
 */


// =====================================================================
// BAGIAN 1: APA ITU NAMESPACE?
// =====================================================================
/**
 * 1. Pengertian Dasar:
 *    Namespace adalah "marga" atau alamat logis yang diberikan kepada sebuah 
 *    class di dalam kode PHP.
 * 
 * 2. Analogi Dunia Nyata:
 *    Bayangkan ada dua orang anak bernama "Budi". Kalau hanya dipanggil "Budi", 
 *    orang akan bingung Budi yang mana. Tapi kalau diberi marga (namespace):
 *    - Keluarga\Jember\Budi
 *    - Keluarga\Jakarta\Budi
 *    Meskipun namanya sama, keduanya tidak akan tertukar.
 * 
 * 3. Masalah Utama yang Diselesaikan:
 *    Mencegah error "Fatal Error: Cannot declare class..., because the name 
 *    is already in use" saat aplikasi kita menggunakan dua class berbeda dengan 
 *    nama yang sama persis (misalnya class User buatan kita sendiri dan class 
 *    User dari library/vendor pihak ketiga seperti Google/Laravel).
 */


// =====================================================================
// BAGIAN 2: HUBUNGAN ANTARA FOLDER FISIK DAN NAMESPACE
// =====================================================================
/**
 * - Folder Fisik (di Hard Disk / VS Code): Digunakan untuk merapikan file 
 *   secara fisik agar kita sebagai developer mudah mencarinya 
 *   (Satu File Idealnya Berisi Satu Class).
 * 
 * - Namespace (di dalam kode PHP): Digunakan agar PHP mengenali identitas 
 *   dan alamat class tersebut di dalam memori.
 * 
 * ATURAN STANDAR PROFESIONAL (PSR-4):
 * Nama namespace wajib disesuaikan dengan struktur folder fisiknya!
 * Contoh: Jika file disimpan di folder `app/Models/`, maka namespace-nya 
 * wajib `namespace App\Models;`.
 */


// =====================================================================
// BAGIAN 3: CONTOH KASUS & IMPLEMENTASI NYATA
// =====================================================================
/**
 * SKENARIO:
 * Kita memiliki dua class yang namanya SAMA PERSIS yaitu class `User`, 
 * tetapi fungsinya berbeda dan disimpan di folder yang berbeda:
 * 1. `app/Models/User.php` -> Class User untuk data database umum.
 * 2. `app/Admin/User.php`  -> Class User khusus untuk panel admin.
 * 
 * Bagaimana cara membuatnya dan memanggilnya tanpa error? 
 * Perhatikan simulasi struktur dan kode di bawah ini:
 */


// --- CONTOH ISI FILE 1: app/Models/User.php ---
/*
<?php
namespace App\Models; // Marga / namespace sesuai folder app/Models

class User {
    public function info() {
        echo "Ini adalah User biasa dari folder Models.<br>";
    }
}
*/


// --- CONTOH ISI FILE 2: app/Admin/User.php ---
/*
<?php
namespace App\Admin; // Marga / namespace sesuai folder app/Admin

class User {
    public function info() {
        echo "Ini adalah User khusus Admin dari folder Admin.<br>";
    }
}
*/


// --- CONTOH ISI FILE UTAMA: index.php ---
/**
 * Cara memanggil dua class dengan nama sama menggunakan "alias" (kata kunci "as"):
 */
/*
<?php
// 1. Panggil file fisiknya menggunakan require_once
require_once "app/Models/User.php";
require_once "app/Admin/User.php";

// 2. Import class menggunakan namespace-nya dan berikan nama alias (as) 
//    agar PHP tidak bingung membedakannya.
use App\Models\User as ModelUser; 
use App\Admin\User as AdminUser;  

// 3. Eksekusi objek
$userBiasa = new ModelUser();$userBiasa->info(); // Output: Ini adalah User biasa dari folder Models.

$admin = new AdminUser();$admin->info(); // Output: Ini adalah User khusus Admin dari folder Admin.
*/


// =====================================================================
// BAGIAN 4: KESIMPULAN UTAMA
// =====================================================================
/**
 * 1. Apakah folder fisik saja cukup? 
 *    Tidak. Walaupun file sudah dipisah ke dalam folder berbeda, PHP tetap 
 *    bisa mengalami bentrok jika ada nama class yang sama di dalam memori global.
 * 2. Apakah folder dan namespace harus sinkron? 
 *    Ya! Di PHP modern (dan framework seperti Laravel), struktur folder dan 
 *    namespace harus sejalan agar sistem pemuatan otomatis (Autoloading / Composer) 
 *    bisa berjalan lancar tanpa harus menulis require_once satu per satu.
 */

























