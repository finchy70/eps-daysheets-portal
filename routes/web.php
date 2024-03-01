<?php

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DaysheetController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MileageController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
//use App\Livewire\Daysheet;
//use App\Livewire\Daysheets\DaysheetIndex;
use App\Http\Livewire\Daysheet\Index;
use App\Http\Livewire\Mileage;
use App\Models\Daysheet;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth', 'approved'])->group(function () {
    Route::get('/menu', [MenuController::class, 'menu'])->name('menu');
//    Route::get('/daysheets', [App\Livewire\Daysheets\DaysheetIndex::class])->name('daysheets');
});

//Route::get('/sheet', Daysheet::class)->name('daysheet');


Route::middleware(['auth', 'approved', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/users/unauth/{user}', [UserController::class, 'un_auth'])->name('users.un_auth');
    Route::get('/users/leaver/{user}', [UserController::class, 'leaver'])->name('users.leaver');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::patch('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::patch('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');

    Route::get('/rates/{rate}/edit', [RateController::class, 'edit'])->name('rates.edit');
//    Route::patch('/rates/{rate}', [RateController::class, 'update'])->name('rates.update');
    Route::post('/rates', [RateController::class, 'store'])->name('rates.store');


//    Route::get('/mileage', Mileage::class)-> name('mileage');
    Route::get('/mileage', [MileageController::class, 'index'])-> name('mileage');
    Route::get('/mileage/create', [MileageController::class, 'create'])-> name('mileage.create');
    Route::get('/mileage/{client}/edit', [MileageController::class, 'edit'])-> name('mileage.edit');
    Route::post('/mileage', [MileageController::class, 'store'])-> name('mileage.store');
});

Route::middleware(['auth', 'approved'])->group(function () {
    Route::get('/daysheets/index', Index::class)->name('daysheet.index');
    Route::get('/daysheets/create', [DaysheetController::class, 'create'])->name('daysheet.create');
    Route::get('/daysheets/{daysheet}/edit', [DaysheetController::class, 'edit'])->name('daysheet.edit');
    Route::get('/daysheets/{daysheet}/show', [DaysheetController::class, 'show'])->name('daysheet.show');
    Route::patch('/daysheets/{daysheet}/update', [DaysheetController::class, 'update'])->name('daysheet.update');
    Route::post('/daysheets', [DaysheetController::class, 'store'])->name('daysheet.store');


    Route::get('/daysheets/{daysheet}/download', [PDFController::class, 'download'])->name('pdf.download');

});

Route::get('/users/auth', [UserController::class, 'auth'])->name('users.auth')->middleware(['admin', 'auth', 'verified']);
Route::get('/pdf', function (){
    return view('pdfs.daysheet');
});
Route::get('/remittance', function (){
    return view('pdfs.remittance');
});

/** API Pages */
Route::get('/api_admin', [ApiTokenController::class, 'admin'])->name('api_admin')->middleware(['admin', 'auth']);
Route::get('/api_admin/manage', [ApiTokenController::class, 'manage'])->name('api_admin.manage')->middleware(['admin', 'auth', 'verified', 'approved']);
