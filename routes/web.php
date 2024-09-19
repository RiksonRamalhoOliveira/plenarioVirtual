<?php


use App\Livewire\Cargo\AddCargo;
use App\Livewire\Cargo\CargoList;
use App\Livewire\Cargo\EditCargo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\HomePageController;
use App\Livewire\Projeto\AddProjeto;
use App\Livewire\Projeto\EditProjeto;
use App\Livewire\Projeto\ProjetoList;

Route::get('/', [HomePageController::class, 'index']);
Route::get('/home', [HomePageController::class, 'index']);

Auth::routes();



Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/cargos/index', [CargoController::class, 'index'])->name('cargoIndex');
    // Route::get('/cargos/create', [CargoController::class, 'create'])->name('cargoCreate');
    // Route::post('/cargos/store', [CargoController::class, 'store'])->name('cargoStore');
    // Route::get('/cargos/show/{cargo}', [CargoController::class, 'show'])->name('cargoShow');
    // Route::get('/cargos/edit/{cargo}', [CargoController::class, 'edit'])->name('cargoEdit');
    // Route::post('/cargos/update/{cargo}', [CargoController::class, 'update'])->name('cargoUpdate');
    // Route::delete('/cargos/destroy/{cargo}', [CargoController::class, 'destroy'])->name('cargoDestroy');

    Route::get('/cargos', CargoList::class)->name('cargoList');
    Route::get('/add-cargo/new', AddCargo::class)->name('addCargo');
    Route::get('/edit/cargo/{id}',EditCargo::class);


    Route::get('/projetos', ProjetoList::class)->name('projetoList');
    Route::get('/add-projeto/new', AddProjeto::class)->name('addProjeto');
    Route::get('/edit/projeto/{id}',EditProjeto::class)->name('editProjeto');

});



