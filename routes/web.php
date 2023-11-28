<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::resource('report', ReportController::class)->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
]);
Route::get('report/{report}/employee', [ReportController::class, 'viewEmployee'])->name('report.employee.show')->middleware('auth');
Route::get('report/{report}/employer', [ReportController::class, 'viewEmployer'])->name('report.employer.show')->middleware('auth');
Route::get('report/{report}/Manager', [ReportController::class, 'viewManager'])->name('report.manager.show')->middleware('auth');

// Route::get('', [NotificationController::class, 'index'])->name('asd');

Route::resource('notification', NotificationController::class)->middleware('auth')->only(['index']);

Route::put('notification/{notification}/seen', NotificationSeenController::class)->middleware('auth')->name('notification.seen');
