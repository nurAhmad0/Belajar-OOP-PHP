<?php

/**
 * =====================================================================
 * PANDUAN ATURAN & URUTAN KEYWORD OOP PHP
 * =====================================================================
 * File ini merangkum aturan visibilitas, abstract, final, dan static.
 */

namespace App\Panduan;

// =====================================================================
// 1. ATURAN FINAL CLASS (Class yang tidak boleh diwariskan lagi)
// =====================================================================
// Penulisan: 'final' diletakkan sebelum kata kunci 'class'.
final class PengaturanSistem {
    public static function info() {
        return "Ini adalah class final, tidak boleh ada class anak yang mewarisinya.";
    }
}


// =====================================================================
// 2. ATURAN ABSTRACT CLASS DAN ABSTRACT FUNCTION
// =====================================================================
abstract class Kendaraan {
    
    // Properti standar
    public $merk;

    /**
     * URUTAN PENULISAN ABSTRACT FUNCTION:
     * [visibilitas] abstract function [nama]();  ATAU  abstract [visibilitas] function [nama]();
     * *Catatan: Visibilitas tidak boleh 'private', minimal 'protected' atau 'public'.
     */
    abstract public function nyalakanMesin(); // Wajib diisi oleh class anak

    /**
     * ATURAN FINAL METHOD PADA KELUARGA NON-ABSTRACT:
     * Urutan: [visibilitas] final function [nama]()
     * Fungsi ini punya isi, tapi DILARANG di-override oleh class anak.
     */
    final public function cekRoda() {
        return "Semua kendaraan wajib memiliki roda standar.";
    }
}


// =====================================================================
// 3. IMPLEMENTASI CLASS ANAK (INHERITANCE)
// =====================================================================
class Mobil extends Kendaraan {

    // Properti dengan visibilitas berbeda
    private $bensin = 100;      // Hanya bisa diakses di dalam class Mobil saja
    protected $kecepatan = 0;   // Bisa diakses oleh class ini dan class turunannya
    public $warna = 'Merah';    // Bisa diakses dari luar class / Controller

    /**
     * Wajib mengimplementasikan abstract function dari induknya.
     * Urutan: [visibilitas] function [nama]()
     */
    public function nyalakanMesin() {
        return "Mesin mobil dinyalakan dengan kunci kontak.";
    }

    /**
     * CONTOH STATIC METHOD
     * Urutan penulisan: [visibilitas] static function [nama]()
     */
    public static function getKategori() {
        return "Kategori: Kendaraan Bermotor Roda Empat";
    }

    // CATATAN KESALAHAN YANG SERING TERJADI:
    // public final function nyalakanMesin() { ... } 
    // ^ ERROR! Karena fungsi 'nyalakanMesin' sudah di-set abstract (harus bisa diubah anak), 
    //   tidak boleh digabung dengan 'final' (yang melarang anak mengubah).
}


// =====================================================================
// 4. CARA MENJALANKAN / PENGUJIAN
// =====================================================================

// A. Memanggil Static Method (Tanpa pakai 'new')
echo Mobil::getKategori() . "<br>";
echo PengaturanSistem::info() . "<br>";

// B. Membuat Objek dari Class Turunan
$mobilku = new Mobil();
echo $mobilku->nyalakanMesin() . "<br>"; // Output dari abstract function
echo $mobilku->cekRoda() . "<br>";      // Output dari final method induk
echo "Warna mobil: " . $mobilku->warna . "<br>"; // Mengakses public property

// C. Pengecekan Instance (instanceof)
if ($mobilku instanceof Kendaraan) {
    echo "Ya, objek \$mobilku adalah turunan sah dari class Kendaraan!<br>";
}