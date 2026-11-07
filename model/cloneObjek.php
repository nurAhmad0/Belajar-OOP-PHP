<?php

class Penulis {
    public string $nama;
}

class Buku {
    public string $judul;
    public Penulis $penulis;

    // Magic method ini otomatis berjalan saat perintah 'clone' dipanggil
    public function __clone() {
        // Kita paksa objek penulis di dalamnya untuk ikut di-clone secara terpisah!
        $this->penulis = clone $this->penulis;
    }
}

$p = new Penulis();
$p->nama = "Budi";

$buku1 = new Buku();
$buku1->judul = "Pemrograman Web";
$buku1->penulis = $p;

$buku2 = clone $buku1;

// Mengubah nama penulis pada buku kedua
$buku2->penulis->nama = "Andi";

echo "Buku 1 Penulis: " . $buku1->penulis->nama . "<br>"; // Output: Budi (Aman!)
echo "Buku 2 Penulis: " . $buku2->penulis->nama . "<br>"; // Output: Andi