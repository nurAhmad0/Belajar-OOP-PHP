<?php
//jaid kita bisa melakukan iterasi ke semua properties yang terdapat dalam objek menggunakan foreach 
//tapi hanya bis yang public saja yang bsia dikases oleh foreach

class Data{
    var string $first = "First";
    public string $second = "Second";
    public string $second2 = "Baru";
    private string $third = "Third";
    protected string $fourth = "Forth";
}

$data = new Data();

foreach ($data as $key1 => $value) {
    echo "$key1 : $value" . PHP_EOL;
    echo "<br>";
}






echo"<br>";
echo"<br>";
echo"<br>";


class Data2{
    var string $first = "First";
    public string $second = "Second";
    public string $second2 = "Baru";
    private string $third = "Third";
    protected string $fourth = "Forth";

    public function getIterator() {
        yield "first" => $this->first;
        yield "second" => $this->second2;
        yield "third" => $this->third;
        yield "fourth" => $this->fourth;
    }
}

$data2 = new Data2();

foreach ($data2 as $key1 => $value) {
    echo "$key1 : $value" . PHP_EOL;
    echo "<br>";
}



echo"<br>";
echo"<br>";
echo"<br>";


function getAngkaGenerator(int $min, int $max) {
    for ($i = $min; $i <= $max; $i++) {
        // yield berfungsi "mengirim" data satu per satu dan menjeda fungsi sejenak
        yield $i; 
    }
}

// --- Cara Menggunakannya dalam Foreach ---
$deret = getAngkaGenerator(1, 3);

foreach ($deret as $angka) {
    echo $angka . " "; 
}
// Output: 1 2 3





echo"<br>";
echo"<br>";
echo"<br>";








// Kelas Wadah Data (Katalog Buku) mengimplementasikan IteratorAggregate
class KatalogBuku implements IteratorAggregate {
    private array $daftarBuku = [
        "Pemrograman PHP Lanjut",
        "Arsitektur Laravel",
        "Clean Code in PHP"
    ];

    // Wajib ada 1 metode ini untuk menyerahkan tugas looping ke ArrayIterator
    public function getIterator(): Traversable {
        return new ArrayIterator($this->daftarBuku);
    }
}

// --- Cara Menggunakannya ---
$katalog = new KatalogBuku();

// Objek kelas biasa langsung bisa di-foreach secara otomatis!
foreach ($katalog as $index => $buku) {
    echo "Buku ke-$index: $buku<br>";
}





echo"<br>";
echo"<br>";
echo"<br>";








//============================custom==================================

class DeretGanjilIterator implements Iterator {
    private int $max;
    private int $current;

    public function __construct(int $max) {
        $this->max = $max;
        $this->current = 1; // Mulai dari angka ganjil pertama
    }

    // 1. Mengembalikan posisi pointer ke awal
    public function rewind(): void {
        $this->current = 1;
    }

    // 2. Mengambil nilai saat ini
    public function current(): mixed {
        return $this->current;
    }

    // 3. Mengambil kunci/index saat ini
    public function key(): mixed {
        return $this->current;
    }

    // 4. Menggeser pointer ke data berikutnya (melompat 2 angka agar tetap ganjil)
    public function next(): void {
        $this->current += 2;
    }

    // 5. Mengecek apakah posisi pointer masih sah/belum habis
    public function valid(): bool {
        return $this->current <= $this->max;
    }
}

// --- Cara Menggunakannya ---
$ganjil = new DeretGanjilIterator(9);

foreach ($ganjil as $angka) {
    echo $angka . " "; 
}
// Output: 1 3 5 7 9






echo"<br>";
echo"<br>";
echo"<br>";

// Ini adalah fungsi Generator karena ada kata kunci "yield" di dalamnya
function cetakAngkaSatuPersatu() {
    echo "Fungsi mulai berjalan...\n";
    
    yield 1; // Jeda 1: Kirim angka 1, lalu berhenti sejenak
    echo "Fungsi dilanjutkan lagi...\n";
    
    yield 2; // Jeda 2: Kirim angka 2, lalu berhenti sejenak
    echo "Fungsi dilanjutkan terakhir kali...\n";
    
    yield 3; // Jeda 3: Kirim angka 3, lalu selesai
}

// --- Cara Menjalankannya ---
$generator = cetakAngkaSatuPersatu();

echo "--- Looping dimulai ---<br>";

foreach ($generator as $angka) {
    echo "Diterima di luar: " . $angka . "<br>";
}