<?php
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















// Belajar_OOP_PHP/
// │
// ├── index.php
// └── app/
//     ├── Models/
//     │   └── User.php       <-- Ini file class User untuk data database
//     │
//     └── Admin/
//         └── User.php       <-- Ini file class User khusus halaman admin (nama sama!)


// File app/Models/User.php

// Namespace wajib mengikuti struktur foldernya (app/Models)
namespace App\Models;

class User {
    public function info() {
        echo "Ini adalah User biasa dari folder Models.<br>";
    }
}




// app/Admin/User.php

// Namespace wajib mengikuti struktur foldernya (app/Admin)
namespace App\Admin;

class User {
    public function info() {
        echo "Ini adalah User khusus Admin dari folder Admin.<br>";
    }
}













// index.php

// Memanggil file fisik menggunakan require_once
require_once "app/Models/User.php";
require_once "app/Admin/User.php";

// Mengimpor class berdasarkan namespace-nya
use App\Models\User as ModelUser;   // Kita beri alias (nama panggilan)
use App\Admin\User as AdminUser;   // Kita beri alias agar tidak tertukar

// Membuat objek dari User Models
$userBiasa = new ModelUser();
$userBiasa->info(); // Output: Ini adalah User biasa dari folder Models.

// Membuat objek dari User Admin
$admin = new AdminUser();
$admin->info(); // Output: Ini adalah User khusus Admin dari folder Admin.







// jadi namespace itu kalau bsia mengikuti letak file 






























// namespace untuk function dan const
namespace App\Helper;

// 1. Konstanta di dalam namespace
const KECEPATAN_CAHAYA = 300000;

// 2. Fungsi di dalam namespace (tanpa class)
function hitungLuasPersegi($sisi) {
    return $sisi * $sisi;
}













// cara memanggil
require_once "helper.php";

// Mengimport konstanta dan fungsi dari namespace App\Helper
use const App\Helper\KECEPATAN_CAHAYA;
use function App\Helper\hitungLuasPersegi;

// Memanggil konstanta
echo "Kecepatan cahaya: " . KECEPATAN_CAHAYA . " km/s<br>";

// Memanggil fungsi
echo "Luas persegi: " . hitungLuasPersegi(4) . "<br>";






// ini jika memanggil banyak function, class atau yang lain dalam satu namespace
use Data\One\{Conflict as Conflict1, Conflict as Conflict2};
use function Helper\{helpMe as help};
use const Helper\{APPLICATION as APP};

$conflict1 = new Conflict1();
$conflict2 = new Conflict2();

help();
echo APP . PHP_EOL;


























/**
 * =====================================================================
 * KUMPULAN CATATAN: REQUIRE/INCLUDE, NAMESPACE, DAN USE KEYWORD
 * =====================================================================
 * Catatan ini merangkum perbedaan mendasar, fungsi, serta cara kerja 
 * dari require/include, namespace, dan use, baik dalam PHP murni 
 * maupun di dalam framework modern seperti Laravel.
 */


/*
| =====================================================================
| 1. REQUIRE / INCLUDE (Urusan Fisik File)
| =====================================================================
| - Kegunaan: Memerintahkan PHP untuk mengambil dan menyalin isi fisik 
|   sebuah file .php ke dalam file yang sedang kita jalankan.
| - Cara Kerja: Berdasarkan jalur direktori file fisik (path folder), 
|   contoh: require 'app/Models/Buku.php';
| - Sifat: Jika file fisik yang dituju tidak ada atau salah ketik path-nya, 
|   PHP akan langsung memunculkan error fatal (Fatal Error) dan menghentikan program.
| - Catatan Khusus di Laravel: Kita HAMPIR TIDAK PERNAH menulis require/include 
|   secara manual. Urusan pencarian file fisik sudah otomatis diambil alih oleh 
|   sistem "Composer Autoloader" menggunakan standar PSR-4.
 */


/*
| =====================================================================
| 2. NAMESPACE (Urusan Alamat Logis / Rumah Folder)
| =====================================================================
| - Kegunaan: Menjadi tanda pengenal "alamat rumah" atau wadah logis 
|   dari sebuah file class di dalam proyek.
| - Aturan: Nama namespace selalu mengikuti struktur folder tempat file itu disimpan.
|   Contoh: File yang disimpan di folder `app/Models/Buku.php` wajib mendeklarasikan:
|   -> namespace App\Models;
| - Alasan Dibutuhkan: Mencegah tabrakan nama (name collision). Bayangkan jika 
|   ada banyak class bernama "User" untuk Admin, Member, dan Kurir. Dengan namespace, 
|   semuanya aman karena punya alamat unik masing-masing.
 */


/*
| =====================================================================
| 3. USE KEYWORD (Jembatan Alias / Panggilan Singkat)
| =====================================================================
| - Kegunaan: Berfungsi sebagai alat impor (import) atau memberikan nama 
|   panggilan singkat (alias) untuk sebuah class, function, atau constant 
|   yang berada di luar namespace file yang sedang kita buka.
| - Cara Kerja: Bukan mencari file fisik, melainkan mendaftarkan kamus alias 
|   di awal file agar kita tidak perlu menulis alamat namespace yang panjang 
|   berulang-ulang.
| - Contoh Penulisan:
|   -> use App\Models\Buku;
|   -> use Illuminate\Http\Request;
|   -> use App\Admin\User as AdminUser; (Memberi alias jika ada nama class kembar)
 */


/*
| =====================================================================
| 4. ILUSTRASI PERBANDINGAN NYATA
| =====================================================================
| 
| [A. GAYA PHP JADUL / TANPA NAMESPACE & USE]
| - Harus melakukan require file fisik secara manual satu per satu.
| - Rawan error fatal jika salah path, dan rentan konflik nama class yang sama.
| 
| [B. GAYA PHP MODERN / FRAMEWORK LARAVEL]
| - Urusan file fisik: Diurus otomatis oleh Composer Autoloader di belakang layar.
| - Urusan struktur: Setiap file wajib menulis `namespace [NamaFolder];` di baris atas.
| - Urusan kemudahan: Menggunakan `use [AlamatClass];` agar kode bersih, elegan, 
|   dan mudah dibaca tanpa harus menulis alamat panjang di setiap baris kodingan.
 */

// Selesai. Silakan simpan catatan ini di file .php pilihanmu!