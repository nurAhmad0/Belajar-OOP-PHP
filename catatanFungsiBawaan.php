<?php
/**
 * =====================================================================
 * KUMPULAN CONTOH IMPLEMENTASI NYATA: GLOBAL HELPER FUNCTIONS
 * =====================================================================
 * Berikut adalah contoh skenario penggunaan nyata dari masing-masing 
 * helper di dalam file Controller atau tampilan Laravel.
 */


/*
| =====================================================================
| 1. CONTOH IMPLEMENTASI dd() [Dump and Die]
| =====================================================================
| Skenario: Kamu ingin mengecek isi data dari database sebelum ditampilkan.
 */
public function index() 
{
    $semuaBuku = Buku::all();
    
    // Program akan berhenti di baris ini dan menampilkan struktur data $semuaBuku di layar browser
    dd($semuaBuku); 
    
    // Kode di bawah ini TIDAK AKAN DIJALANKAN karena sudah dihentikan oleh dd()
    return view('buku.index', compact('semuaBuku'));
}


/*
| =====================================================================
| 2. CONTOH IMPLEMENTASI asset()
| =====================================================================
| Skenario: Memasang file CSS atau gambar di dalam file tampilan (Blade).
 */
?>
<!-- Di dalam file resources/views/buku/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- asset() memastikan jalur foldernya selalu benar meski diakses dari URL sub-domain -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <img src="{{ asset('images/logo-oniku.png') }}" alt="Logo">
</head>
<body>
<?php


/*
| =====================================================================
| 3. CONTOH IMPLEMENTASI url()
| =====================================================================
| Skenario: Membuat link manual secara dinamis menuju suatu alamat URL.
 */
public function buatLink() 
{
    // Menghasilkan string URL lengkap, misal: http://127.0.0.1:8000/profil-admin
    $urlProfil = url('/profil-admin');
    
    return $urlProfil;
}


/*
| =====================================================================
| 4. CONTOH IMPLEMENTASI route()
| =====================================================================
| Skenario: Membuat link berdasarkan nama rute (named route) di file routes/web.php.
*/
// Jika di routes/web.php rutenya didaftarkan seperti ini:
// Route::get('/buku/detail', [BukuController::class, 'show'])->name('buku.detail');

public function arahkanKeDetail() 
{
    // Mengambil URL rute secara aman berdasarkan namanya ('buku.detail')
    return redirect()->route('buku.detail');
}


/*
| =====================================================================
| 5. CONTOH IMPLEMENTASI old()
| =====================================================================
| Skenario: Mempertahankan inputan form user saat validasi gagal.
 */
?>
<!-- Di dalam file form Blade -->
<form action="/buku/simpan" method="POST">
    @csrf
    <label>Judul Buku:</label>
    <!-- old('judul') mengambil kembali data yang sempat diketik user sebelum halaman direload karena error -->
    <input type="text" name="judul" value="{{ old('judul') }}">
    <button type="submit">Simpan</button>
</form>
<?php


/*
| =====================================================================
| 6. CONTOH IMPLEMENTASI config()
| =====================================================================
| Skenario: Mengambil data setting atau konfigurasi aplikasi.
 */
public function cekKonfigurasi() 
{
    // Mengambil nilai 'name' dari file config/app.php
    $namaAplikasi = config('app.name'); 
    
    // Mengambil zona waktu aplikasi
    $timezone = config('app.timezone');
    
    return "Aplikasi: $namaAplikasi, Zona Waktu: $timezone";
}


/*
| =====================================================================
| 7. CONTOH IMPLEMENTASI redirect()
| =====================================================================
| Skenario: Memindahkan halaman setelah proses input data berhasil.
 */
public function store(Request $request) 
{
    // Proses simpan data buku ke database...
    
    // Setelah selesai, arahkan kembali user ke halaman daftar buku
    return redirect('/buku')->with('success', 'Data buku berhasil disimpan!');
}


/*
| =====================================================================
| 8. CONTOH IMPLEMENTASI auth()
| =====================================================================
| Skenario: Mengecek siapa yang sedang login di sistem.
 */
public function cekUserLogin() 
{
    // Mengecek apakah ada user yang sedang aktif login
    if (auth()->check()) {
        $idUser = auth()->id();               // Mengambil ID user
        $namaUser = auth()->user()->name;     // Mengambil Nama user
        
        return "Halo $namaUser, ID kamu adalah $idUser.";
    }
    
    return "Belum ada user yang login.";
}


/*
| =====================================================================
| 9. CONTOH IMPLEMENTASI request()
| =====================================================================
| Skenario: Menangkap data pencarian atau inputan dari form.
 */
public function cariBuku(Request $request) 
{
    // Mengambil nilai input dengan nama 'keyword' dari form pencarian
    $kataKunci = request('keyword');
    
    // Atau bisa juga menggunakan: $request->input('keyword');
    $hasil = Buku::where('judul', 'LIKE', "%$kataKunci%")->get();
    
    return view('buku.hasil', compact('hasil'));
}