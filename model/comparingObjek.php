<?php

class Mahasiswa {
    public string $nama;
    
    public function __construct(string $nama) {
        $this->nama = $nama;
    }
}

// Membuat dua objek yang berbeda tempat di memori, tapi isinya sama
$mhs1 = new Mahasiswa("Budi");
$mhs2 = new Mahasiswa("Budi");

// Membuat objek dari class yang berbeda meskipun isinya sama
class Dosen {
    public string $nama = "Budi";
}
$dosen1 = new Dosen();

// 1. Membandingkan $mhs1 dan $mhs2
if ($mhs1 == $mhs2) {
    echo "Objek {$mhs1->nama} dan {$mhs2->nama} SAMA (Bernilai true karena class sama & propertinya sama)<br>";
} else {
    echo "Objek BERBEDA<br>";
}

// 2. Membandingkan $mhs1 dan $dosen1
if ($mhs1 == $dosen1) {
    echo "SAMA<br>";
} else {
    echo "Objek {$mhs1->nama} dan {$dosen1->nama} BERBEDA (Karena meskipun namanya sama, class-nya berbeda: Mahasiswa vs Dosen)!<br>";
}



















//=================ini yang "==="  ================================
class Buku {
    public string $judul;
}

$buku1 = new Buku();
$buku1->judul = "Pemrograman PHP";

// Kasus A: Menyalin dengan referensi (=)
$bukuA = $buku1; // Menunjuk ke objek fisik yang SAMA di memori

// Kasus B: Menyalin dengan clone
$bukuB = clone $buku1; // Membuat objek baru yang terpisah di memori

// 1. Membandingkan $buku1 dengan $bukuA (Pakai ===)
if ($buku1 === $bukuA) {
    echo "Buku 1 dan Buku A IDENTIK (Mengacu ke objek memori yang sama).<br>";
}

// 2. Membandingkan $buku1 dengan $bukuB (Pakai ===)
if ($buku1 === $bukuB) {
    echo "IDENTIK<br>";
} else {
    echo "Buku 1 dan Buku B TIDAK IDENTIK (Meskipun isinya sama 'Pemrograman PHP', tapi mereka adalah dua objek fisik yang berbeda di memori RAM).<br>";
}