<?php
// 1. Membuat Abstract Class
//tidak bsia membuat objek dari abstract class
abstract class Hewan {
    
    // Ini adalah Abstract Function (tidak punya tubuh/isi {})
    abstract public function bersuara(); 

    // Ini adalah function biasa (boleh punya isi, opsional dipakai anak)
    public function bernapas() {
        return "Semua hewan bernapas menggunakan oksigen.";
    }
}

// 2. Class Anak 1 (Wajib mewarisi dan mengisi fungsi bersuara())
class Kucing extends Hewan {
    public function bersuara() {
        return "Meow! Meow!";
    }
}

// 3. Class Anak 2 (Wajib mewarisi dan mengisi fungsi bersuara())
class Anjing extends Hewan {
    public function bersuara() {
        return "Guk! Guk!";
    }
}

// --- CARA MENJALANKANNYA ---
// $hewan = new Hewan(); // ERROR! Abstract class tidak bisa di-new.

$kucing = new Kucing();
echo $kucing->bernapas() . "<br>"; // Output: Semua hewan bernapas menggunakan oksigen.
echo $kucing->bersuara() . "<br>";  // Output: Meow! Meow!

$anjing = new Anjing();
echo $anjing->bersuara();          // Output: Guk! Guk!