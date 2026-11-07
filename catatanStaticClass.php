<?php

// 1. Diberi 'final' agar tidak bisa di-extend (diwarisi)
final class MatematikaHelper {

    // 2. Constructor dibuat 'private' agar tidak bisa di-new dari luar
    private function __construct() {
        // Kosongkan saja, tujuannya agar error jika seseorang menulis: new MatematikaHelper()
    }

    // 3. Method dibuat static
    public static function tambah($a, $b) {
        return $a + $b;
    }

    public static function luasPersegi($sisi) {
        return $sisi * $sisi;
    }
}

// --- CARA PENGGUNAANNYA ---

// Benar (Langsung panggil menggunakan '::'):
echo MatematikaHelper::tambah(5, 10); // Output: 15

// SALAH & AKAN ERROR:
// $matematika = new MatematikaHelper(); // Error: constructor bersifat private!
// class AnakMatematika extends MatematikaHelper {} // Error: class final tidak boleh di-extend!