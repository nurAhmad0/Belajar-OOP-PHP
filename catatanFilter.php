<?php

//dibawh ini adalah filter
//https://www.w3schools.com/php/php_ref_filter.asp




//https://www.w3schools.com/php/php_filter.asp

class User {
    // Properti dibuat private agar aman dari akses luar
    private $email;

    // --- GETTER ---
    public function getEmail() {
        return $this->email;
    }

    // --- SETTER DENGAN VALIDASI ---
    public function setEmail($email) {
        // Validasi sederhana sebelum data disimpan
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new \Exception("Format email tidak valid!");
        }
    }
}

// Cara menggunakannya:
$user = new User();
$user->setEmail("eko@gmail.com"); // Mengubah nilai via setter
echo $user->getEmail();             // Mengambil nilai via getter