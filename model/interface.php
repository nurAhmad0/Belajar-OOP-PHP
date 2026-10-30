<?php
// 1. Class Induk (Pewarisan / Inheritance)
class Manusia {
    public function bernapas() {
        return "Bernapas menggunakan oksigen.";
    }
}

// 2. Interface (Kontrak perilaku tambahan)
interface PegawaiInterface {
    public function bekerja();
}

interface AktifDiOrganisasiInterface {
    public function ikutRapat();
}

// 3. GABUNGAN: Menggunakan extends DAN implements sekaligus!
// Aturan: 'extends' harus di depan, baru 'implements' di belakang.
class Programmer extends Manusia implements PegawaiInterface, AktifDiOrganisasiInterface {
    
    // Wajib mengisi fungsi dari PegawaiInterface
    public function bekerja() {
        return "Sedang menulis kode program Laravel.";
    }

    // Wajib mengisi fungsi dari AktifDiOrganisasiInterface
    public function ikutRapat() {
        return "Hadir dalam rapat evaluasi project.";
    }
}

// --- CARA MENJALANKANNYA ---
$eko = new Programmer();

// Memanggil fungsi dari class induk (Manusia)
echo $eko->bernapas() . "<br>";        // Output: Bernapas menggunakan oksigen.

// Memanggil fungsi dari interface 1
echo $eko->bekerja() . "<br>";         // Output: Sedang menulis kode program Laravel.

// Memanggil fungsi dari interface 2
echo $eko->ikutRapat() . "<br>";       // Output: Hadir dalam rapat evaluasi project.


























//=-=-=-=-==-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-==-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=--==--=-=-=-


// ini jika interface dimasukkan dalam abstarct

// 1. Membuat Interface
interface PembayaranInterface {
    public function validasiToken();
    public function prosesBayar();
}

// 2. Abstract Class mengimplementasikan Interface
abstract class ECommerceGateway implements PembayaranInterface {
    
    // Kita bisa mengisi salah satu fungsi terlebih dahulu di sini
    public function validasiToken() {
        return "Token pembayaran berhasil diverifikasi secara global.";
    }
    
    // Fungsi prosesBayar() dibiarkan abstrak (tidak diisi), 
    // karena nanti cara bayarnya diserahkan ke masing-masing bank/dompet digital.
    abstract public function prosesBayar();
}

// 3. Class Anak (Subclass konkrit)
class BCA_Gateway extends ECommerceGateway {
    
    // Wajib mengisi prosesBayar() karena di parent belum diisi
    public function prosesBayar() {
        return "Memproses pembayaran via Virtual Account BCA.";
    }
}

// --- CARA MENJALANKANNYA ---
$bca = new BCA_Gateway();
echo $bca->validasiToken() . "<br>"; // Output dari Abstract Class
echo $bca->prosesBayar();            // Output dari Subclass














//============================================================================================================

// ini untuk interface melakuakn inheritanse oleh interface yang lain
// 1. Interface Dasar
interface KendaraanInterface {
    public function nyalakanMesin();
}

// 2. Interface Turunan (Mewarisi KendaraanInterface menggunakan extends)
// Interface ini otomatis punya fungsi nyalakanMesin(), plus ditambah aturan sendiri.
interface KendaraanListrikInterface extends KendaraanInterface {
    public function isiDayaBaterai();
}

// 3. Class yang mengimplementasikan interface turunan
// Otomatis wajib membuat SEMUA fungsi dari kedua interface tersebut!
class MobilTesla implements KendaraanListrikInterface {
    public function nyalakanMesin() {
        return "Sistem kelistrikan mobil menyala secara silent.";
    }

    public function isiDayaBaterai() {
        return "Mengisi daya menggunakan fast charging Supercharger.";
    }
}