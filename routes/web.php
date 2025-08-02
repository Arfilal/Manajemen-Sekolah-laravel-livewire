<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Livewire\Kelas\KelasComponent;
use App\Livewire\Siswa\SiswaComponent;
use App\Livewire\Guru\GuruComponent;
use App\Livewire\Guru\GuruByKelas;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth']) // optional: batasi hanya untuk yang login
    ->name('dashboard');

 Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/kelas', KelasComponent::class)->name('kelas.index');
Route::get('/siswa', SiswaComponent::class)->name('siswa.index');
Route::get('/guru', GuruComponent::class)->name('guru.index');
Route::get('/guru/kelas/{id}', GuruByKelas::class)->name('guru.by.kelas');

require __DIR__.'/auth.php';
