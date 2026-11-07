<?php


// 1. Kita buat sebuah class sederhana dengan berbagai visibilitas
class Mahasiswa {
    public string $nama = "Budi";
    private string $nim = "25241010";

    public function belajar(string $mataKuliah): void {
        echo "{$this->nama} sedang belajar {$mataKuliah}.<br>";
    }
}

// 2. Memulai Reflection pada class 'Mahasiswa'
$reflector = new ReflectionClass('Mahasiswa');

echo "<h2>Informasi Kelas:</h2>";
echo "Nama Kelas: " . $reflector->getName() . "<br>";

// 3. Mengintip daftar metode (methods) yang ada di dalam class
echo "<h3>Daftar Method:</h3>";
foreach ($reflector->getMethods() as $method) {
    echo "- " . $method->getName() . "<br>";
}

// 4. Mengintip daftar properti beserta hak aksesnya (bahkan yang private!)
echo "<h3>Daftar Properti:</h3>";
foreach ($reflector->getProperties() as $property) {
    $akses = $property->isPublic() ? 'Public' : 'Private/Protected';
    echo "- " . $property->getName() . " (Akses: {$akses})<br>";
}

echo "<h2>Akses Data Private Lewat Reflection:</h2>";
// Biasanya properti private $nim tidak bisa diakses dari luar class.
// Tapi dengan Reflection, kita bisa menjebolnya secara paksa untuk keperluan debugging!
$mhs = new Mahasiswa();
$propertyNim = $reflector->getProperty('nim');
$propertyNim->setAccessible(true); // Paksa ubah akses menjadi bisa dibaca

echo "NIM privat yang berhasil diintip: " . $propertyNim->getValue($mhs);