<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/perfil', function () {
        return view('perfil', [
            'user' => auth()->user()
        ]);
    })->name('perfil');
});

Route::get('/admin/panel', function () {
    return view('admin.panel');
})->middleware('verificar.rol:admin')->name('admin.panel');

Route::get('/movil/inicio', function () {
    return 'Bienvenido desde un dispositivo móvil.';
})->middleware('solo.celular');
Route::get('/movil/perfil', function () {
    return 'Perfil móvil.';
})->middleware('solo.celular');
Route::get('/movil/configuracion', function () {
    return 'Configuración móvil.';
})->middleware('solo.celular');

require __DIR__.'/auth.php';
