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





























































