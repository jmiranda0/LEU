<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome');
// })->name('home');

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// require __DIR__.'/settings.php';
// require __DIR__.'/auth.php';

Route::get('/', function () {
    // Esta línea le dice a Laravel que renderice el componente de Vue
    // ubicado en 'resources/js/Pages/Dashboard.vue'.
    // Crearemos ese archivo de Vue más adelante.
    return Inertia::render('Dashboard');
});
