<?php

// 1. Definisikan Kelas-kelas Hewan
class Animal {
    // Properti atau method umum hewan
}

class Cat extends Animal {
    public function meow(): void {
        echo "Meow! 🐱<br>";
    }
}

// 2. Definisikan Parent Class (Tempat Penampungan Umum)
interface AnimalShelterInterface {
    public function adopt(string $name): Animal; 
    // Kontrak awal: Method adopt() harus mengembalikan objek berjenis 'Animal'
}

// 3. Definisikan Child Class (Tempat Penampungan Khusus Kucing)
class CatShelter implements AnimalShelterInterface {
    
    // Menerapkan COVARIANCE pada return type!
    // Alih-alih mengembalikan 'Animal' secara umum, kita mengembalikan 'Cat' (yang lebih spesifik).
    public function adopt(string $name): Cat {
        echo "Mengadopsi kucing bernama {$name}.<br>";
        return new Cat();
    }
}

// --- CARA MENGGUNAKANNYA ---

$shelter = new CatShelter();
$myCat = $shelter->adopt("Milo");

// Karena return type-nya adalah 'Cat', kita bisa langsung memanggil method khusus kucing!
$myCat->meow();