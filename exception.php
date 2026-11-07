<?php

// ==========================================
// 1. MEMBUAT KELAS-KELAS CUSTOM EXCEPTION
// ==========================================

// A. Untuk Validasi Form (HTTP Status 422)
class ValidationException extends Exception {
    private array $errors;
    public function __construct(array $errors) {
        parent::__construct("Input pengguna tidak valid.", 422);
        $this->errors = $errors;
    }
    public function getErrors(): array { return $this->errors; }
}

// B. Untuk Data Tidak Ditemukan (HTTP Status 404)
class ModelNotFoundException extends Exception {
    public function __construct(string $modelName, int|string $id) {
        parent::__construct("Data {$modelName} dengan ID {$id} tidak ditemukan.", 404);
    }
}

// C. Untuk Masalah Autentikasi / Belum Login (HTTP Status 401)
class AuthenticationException extends Exception {
    public function __construct(string $message = "Pengguna belum login atau sesi telah kedaluwarsa.") {
        parent::__construct($message, 401);
    }
}

// D. Untuk Aturan Bisnis / Saldo Kurang (HTTP Status 400 / Business Logic)
class InsufficientBalanceException extends Exception {
    public function __construct(int $saldo, int $hargaBarang) {
        parent::__construct("Saldo Anda ({$saldo}) tidak cukup untuk membeli barang seharga ({$hargaBarang}).", 400);
    }
}


// ==========================================
// 2. SIMULASI FUNGSI BISNIS (LOGIKA APLIKASI)
// ==========================================

// Simulasi 1: Proses Validasi Input
function prosesRegistrasi(array $data) {
    $errors = [];
    if (empty($data['email']) || !str_contains($data['email'], '@')) {
        $errors['email'] = "Format email salah.";
    }
    if (strlen($data['password'] ?? '') < 8) {
        $errors['password'] = "Password kurang panjang (minimal 8 karakter).";
    }

    if (!empty($errors)) {
        throw new ValidationException($errors); // Lempar error validasi
    }
    echo "Registrasi berhasil!<br>";
}

// Simulasi 2: Pencarian Data Database
function ambilProfilUser(int $id) {
    $databaseMock = [1 => "Budi", 2 => "Andi"]; // Bayangkan data di database
    
    if (!isset($databaseMock[$id])) {
        throw new ModelNotFoundException("User", $id); // Lempar error 404
    }
    echo "Profil ditemukan: " . $databaseMock[$id] . "<br>";
}

// Simulasi 3: Pengecekan Sesi Login
function aksesHalamanAdmin(?string $token) {
    if ($token === null || $token !== "TOKEN_RAHASIA_VALID") {
        throw new AuthenticationException("Token kedaluwarsa atau belum login."); // Lempar error 401
    }
    echo "Selamat datang di Halaman Admin!<br>";
}

// Simulasi 4: Pengecekan Saldo E-commerce
function beliBarang(int $saldoUser, int $hargaBarang) {
    if ($saldoUser < $hargaBarang) {
        throw new InsufficientBalanceException($saldoUser, $hargaBarang); // Lempar error bisnis
    }
    echo "Pembayaran berhasil! Barang sedang diproses.<br>";
}


// ==========================================
// 3. CARA MENANGKAPNYA DI KONTROLER / BLOK UTAMA
// ==========================================

// Kamu bisa mengganti-ganti angka/parameter di bawah ini untuk menguji masing-masing Exception!
$skenarioUji = 1; 

try {
    if ($skenarioUji === 1) {
        // Uji ValidationException
        prosesRegistrasi(['email' => 'salah-format', 'password' => '123']);
    } 
    elseif ($skenarioUji === 2) {
        // Uji ModelNotFoundException
        ambilProfilUser(999); 
    } 
    elseif ($skenarioUji === 3) {
        // Uji AuthenticationException
        aksesHalamanAdmin(null); 
    } 
    elseif ($skenarioUji === 4) {
        // Uji InsufficientBalanceException
        beliBarang(10000, 50000); 
    }

} catch (ValidationException $e) {
    // [TUJUAN]: Kirim status 422 dan tampilkan pesan spesifik ke form UI
    echo "<b>[HTTP 422 - Unprocessable Entity]</b><br>";
    echo "Pesan: " . $e->getMessage() . "<br>Detail Error:<br>";
    foreach ($e->getErrors() as $field => $msg) {
        echo "- Kolom <u>{$field}</u>: {$msg}<br>";
    }

} catch (ModelNotFoundException $e) {
    // [TUJUAN]: Tampilkan halaman khusus "Error 404: Data Tidak Ditemukan"
    echo "<b>[HTTP 404 - Not Found Page]</b><br>";
    echo "Tampilan UI: Maaf, " . $e->getMessage() . "<br>";

} catch (AuthenticationException $e) {
    // [TUJUAN]: Redirect otomatis ke halaman Login
    echo "<b>[HTTP 401 - Unauthorized]</b><br>";
    echo "Aksi: " . $e->getMessage() . " -> <i>Redirecting ke halaman /login...</i><br>";

} catch (InsufficientBalanceException $e) {
    // [TUJUAN]: Tangani aturan bisnis tanpa dianggap kerusakan server
    echo "<b>[Business Logic Error]</b><br>";
    echo "Pemberitahuan ke User: " . $e->getMessage() . "<br>";

} catch (Exception $e) {
    // [PENGAMAN]: Menangkap error sistem umum tak terduga (Error 500)
    echo "<b>[HTTP 500 - System Error]</b><br>";
    echo "Terjadi kesalahan pada server: " . $e->getMessage();
}