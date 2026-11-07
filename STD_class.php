<?php

// Membuat objek kosong dari stdClass
$mahasiswa = new stdClass();

// Menambahkan properti secara bebas
$mahasiswa->nama = "Budi Santoso";
$mahasiswa->nim = "252410102091";
$mahasiswa->jurusan = "Teknologi Informasi";

// Cara mengaksesnya menggunakan tanda panah (->)
echo "Nama: " . $mahasiswa->nama . "<br>";
echo "NIM: " . $mahasiswa->nim;





echo "<br>";
echo "<br>";
echo "<br>";



$jsonString = '{"judul": "Belajar OOP PHP", "penulis": "Osama"}';

// Mengubah JSON menjadi Objek stdClass
$data = json_decode($jsonString);

// Mengakses properti objek stdClass hasil decode

echo "<br>";
echo $data->judul;   // Output: Belajar OOP PHP

echo "<br>";
echo $data->penulis; // Output: Osama








echo "<br>";
echo "<br>";
echo "<br>";

$arrayData = [
    'nama_produk' => 'Mechanical Keyboard',
    'harga' => 750000
];

// Mengubah array menjadi stdClass object menggunakan (object)
$objekData = (object) $arrayData;

// Sekarang bisa diakses pakai tanda panah (->)

echo "<br>";
echo $objekData->nama_produk; // Output: Mechanical Keyboard
echo "<br>";
echo $objekData->harga;       // Output: 750000

















echo "<br>";
echo "<br>";
echo "<br>";



// 1. Membuat objek stdClass
$mahasiswa = new stdClass();
$mahasiswa->nama = "Budi Santoso";
$mahasiswa->nim = "252410102091";

// 2. Mengubah objek menjadi array
$arrayData = (array) $mahasiswa;

// 3. Menampilkan hasil array
print_r($arrayData);
// Output: Array ( [nama] => Budi Santoso [nim] => 252410102091 )

// Cara mengaksesnya sebagai array:
echo $arrayData['nama']; // Output: Budi Santoso




















// ==============================CATATAN ================================================
// Kebutuhan                                               Cara yang Digunakan

// Objek sederhana (stdClass atau class biasa)             Gunakan casting (array) $objek
// Hanya ingin mengambil properti publik                   Gunakan get_object_vars($objek)
// Objek kompleks yang punya sub-objek di dalamnya         Gunakan json_decode(json_encode($objek), true)