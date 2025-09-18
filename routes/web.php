<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ContactController;
use App\Models\Main;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\About;
use App\Models\Team;

Route::get('/', function () {
    $main = Main::first();
    $services = Service::all();
    $portfolios = Portfolio::all();
    $abouts = About::all();
    $teams = Team::all();

    return view('frontend.home', compact('main', 'services', 'portfolios', 'abouts', 'teams'));
})->name('frontend.home');

// Admin Routes
Route::get('admin/dashboard', [MainController::class, 'create'])->name('admin.dashboard');
Route::get('admin/main', [MainController::class, 'index'])->name('admin.main');
Route::post('admin/main', [MainController::class, 'store'])->name('admin.main.store');

// Services Routes
Route::get('admin/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
Route::get('admin/services/list', [ServiceController::class, 'list'])->name('admin.services.list');
Route::get('/admin/services/edit/{id}', [ServiceController::class, 'edit'])->name('admin.services.edit');
Route::post('admin/services/create', [ServiceController::class, 'store'])->name('admin.services.store');
Route::put('admin/services/update/{id}', [ServiceController::class, 'update'])->name('admin.services.update');
Route::delete('admin/services/delete/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');

// Portfolios Routes
Route::get('admin/portfolios/create', [PortfolioController::class, 'create'])->name('admin.portfolios.create');
Route::get('admin/portfolios/list', [PortfolioController::class, 'list'])->name('admin.portfolios.list');
Route::get('/admin/portfolios/edit/{id}', [PortfolioController::class, 'edit'])->name('admin.portfolios.edit');
Route::post('admin/portfolios/store', [PortfolioController::class, 'store'])->name('admin.portfolios.store');
Route::put('admin/portfolios/update/{id}', [PortfolioController::class, 'update'])->name('admin.portfolios.update');
Route::delete('admin/portfolios/delete/{id}', [PortfolioController::class, 'destroy'])->name('admin.portfolios.destroy');

// Abouts Routes
Route::get('admin/abouts/create', [AboutController::class, 'create'])->name('admin.abouts.create');
Route::get('admin/abouts/list', [AboutController::class, 'list'])->name('admin.abouts.list');
Route::get('/admin/abouts/edit/{id}', [AboutController::class, 'edit'])->name('admin.abouts.edit');
Route::post('admin/abouts/store', [AboutController::class, 'store'])->name('admin.abouts.store');
Route::put('admin/abouts/update/{id}', [AboutController::class, 'update'])->name('admin.abouts.update');
Route::delete('admin/abouts/delete/{id}', [AboutController::class, 'destroy'])->name('admin.abouts.destroy');

// Teams Routes
Route::get('admin/teams/create', [TeamController::class, 'create'])->name('admin.teams.create');
Route::get('admin/teams/list', [TeamController::class, 'list'])->name('admin.teams.list');
Route::get('/admin/teams/edit/{id}', [TeamController::class, 'edit'])->name('admin.teams.edit');
Route::put('admin/teams/store', [TeamController::class, 'store'])->name('admin.teams.store');
Route::put('admin/teams/update/{id}', [TeamController::class, 'update'])->name('admin.teams.update');
Route::delete('admin/teams/delete/{id}', [TeamController::class, 'destroy'])->name('admin.teams.destroy');

// Contacts Routes
Route::get('admin/contacts/list', [ContactController::class, 'list'])->name('admin.contacts.list');
Route::POST('/admin/contacts/store', [ContactController::class, 'store'])->name('admin.contacts.store');

Route::get('/admin/dashboard', function () {
    return view('backend.components.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
