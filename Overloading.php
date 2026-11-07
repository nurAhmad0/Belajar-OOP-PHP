<?php

class UserProfile {
    // Menyimpan data properti dinamis di dalam array privat
    private array $data = [];

    // 1. PROPERTY OVERLOADING: Dipanggil saat kita MENULIS properti yang tidak ada/privat
    public function __set(string $namaProperti, mixed $nilai): void {
        echo "Properti '{$namaProperti}' tidak ada, tapi disimpan secara dinamis lewat __set().<br>";
        $this->data[$namaProperti] = $nilai;
    }

    // 2. PROPERTY OVERLOADING: Dipanggil saat kita MEMBACA properti yang tidak ada/privat
    public function __get(string $namaProperti): mixed {
        if (array_key_exists($namaProperti, $this->data)) {
            echo "Mengambil properti '{$namaProperti}' dari wadah dinamis __get().<br>";
            return $this->data[$namaProperti];
        }
        
        return "Properti '{$namaProperti}' tidak ditemukan!";
    }

    // 3. METHOD OVERLOADING: Dipanggil saat kita MEMERINTAHKAN method yang tidak ada
    public function __call(string $namaMethod, array $arguments): void {
        echo "Method <b>{$namaMethod}</b> tidak ada di dalam class ini! ";
        echo "Argumen yang dikirim: " . implode(', ', $arguments) . "<br>";
    }
}

// --- CARA MENGGUNAKANKANNYA ---

$user = new UserProfile();

// A. Menguji Property Overloading (__set dan __get)
// Properti 'nama' dan 'hobi' tidak pernah dideklarasikan di dalam class UserProfile!
$user->nama = "Budi Santoso"; // Otomatis memicu __set()
$user->hobi = "Coding PHP";   // Otomatis memicu __set()

echo "<br>";

// Membaca properti dinamis tersebut
echo "Nama saya: " . $user->nama . "<br>"; // Otomatis memicu __get()
echo "Hobi saya: " . $user->hobi . "<br>"; // Otomatis memicu __get()

echo "<br>-----------------------------------<br><br>";

// B. Menguji Method Overloading (__call)
// Memanggil method 'kirimPesan' yang sama sekali tidak pernah dibuat di dalam class
$user->kirimPesan("Halo, apa kabar?", 2026); // Otomatis memicu __call()







echo"<br>";
echo"======================================================================================================================================<br>";
echo"<br>";




class Person {
    // Menyimpan data properti dinamis di dalam array privat
    private array $storage = [];

    // 1. Menggunakan __isset dengan parameter '$property' (bukan '$name') dan return 'bool'
    public function __isset(string $property): bool {
        echo "<b>[Trigger __isset]</b> Mengecek apakah properti '{$property}' ada?<br>";
        
        // Mengecek apakah key tersebut ada di dalam array storage DAN nilainya tidak null
        return isset($this->storage[$property]);
    }

    // 2. Menggunakan __unset dengan parameter '$property' dan return 'void'
    public function __unset(string $property): void {
        echo "<b>[Trigger __unset]</b> Mencoba menghapus properti '{$property}'...<br>";
        
        // Menghapus data dari array internal kita
        if (array_key_exists($property, $this->storage)) {
            unset($this->storage[$property]);
            echo "Properti '{$property}' berhasil dihapus dari storage!<br>";
        } else {
            echo "Properti '{$property}' tidak ditemukan untuk dihapus.<br>";
        }
    }

    // Tambahan __set untuk memasukkan data uji coba ke dalam storage
    public function __set(string $property, mixed $value): void {
        $this->storage[$property] = $value;
    }
}

// --- CARA MENGGUNAKANNYA ---

$person = new Person();

// Mengisi properti dinamis menggunakan __set (misal: 'hobi' dan 'alamat')
$person->hobi = "Membaca Buku";
$person->alamat = "Jember";

echo "--------------------------------------------------<br>";

// A. Menguji fungsi isset() -> Otomatis memicu __isset()
if (isset($person->hobi)) {
    echo "Hasil isset: Properti 'hobi' ADA dan bernilai aktif.<br>";
} else {
    echo "Hasil isset: Properti TIDAK ADA.<br>";
}

echo "<br>";

// Mengecek properti yang memang tidak pernah dibuat
if (isset($person->nomorTelepon)) {
    echo "Hasil isset: ADA<br>";
} else {
    echo "Hasil isset: Properti 'nomorTelepon' TIDAK ADA.<br>";
}

echo "--------------------------------------------------<br>";

// B. Menguji fungsi unset() -> Otomatis memicu __unset()
echo "Sebelum di-unset, alamat: " . ($person->alamat ?? 'Kosong') . "<br>";

// Menghapus properti dinamis menggunakan unset()
unset($person->alamat); 

// Memeriksa kembali setelah di-unset
if (isset($person->alamat)) {
    echo "Alamat masih ada.<br>";
} else {
    echo "Alamat sudah bersih / terhapus sepenuhnya!<br>";
}