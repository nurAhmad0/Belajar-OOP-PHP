<?php
class Orang {
    // ada private, public, protected
    // public $nama;
    // public $saldo;
    // public $umur;
    // atau bisa juga pakai yang dibawah ini 
    public $nama, $umur, $saldo;


    public function tampilkanNama() {
        // SALAH: echo nama; atau echo $nama; (akan error)
        // BENAR:
        echo "<br>";
        echo $this->nama; 
    }

    public function set_nama($nama) {//kalau tidak ada tertulsi public itu akan tetap publci karena public itu defaultnya
        $this->nama = $nama;
    }
    public function set_saldo($saldo) {//kalau tidak ada tertulsi public itu akan tetap publci karena public itu defaultnya
        $this->saldo = $saldo;
    }
    public function set_umur($umur) {//kalau tidak ada tertulsi public itu akan tetap publci karena public itu defaultnya
        $this->umur = $umur;
    }
}

















// ========================================================catatan=================================================================================





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