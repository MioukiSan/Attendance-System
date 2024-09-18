<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;
use App\DataTables\VisitorsDataTable;

Route::get('/', [VisitorController::class, 'landing'])->name('landing');
Route::get('/index', function () {
    return view(view: 'index');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/visitors/attendance-data-table', [VisitorController::class, 'AttendanceDataTable'])
//     ->middleware(['auth', 'verified'])
//     ->name('visitors.AttendanceDataTable');

Route::get('/visitors/attendance-data-table', function (VisitorsDataTable $dataTable) {
    return $dataTable->render('admin.attendance');
 })->middleware(['auth', 'verified'])->name('visitors.AttendanceDataTable');

Route::post('/check-pin', [VisitorController::class, 'CheckPin'])->name('check.pin');
Route::resource('/visitors', VisitorController::class);

require __DIR__.'/auth.php';