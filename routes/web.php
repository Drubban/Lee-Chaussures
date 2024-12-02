<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
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


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('Bienvenida');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	// Route::get('shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop');
	// Route::get('shopAdd', [App\Http\Controllers\ShopController::class, 'add'])->name('Agregar Producto');

	Route::prefix('tables')->group(function () {
		Route::get('/', [TablesController::class, 'index'])->name('tables');
		Route::get('/new', [TablesController::class, 'create'])->name('tablesCreate');
		Route::post('/store', [TablesController::class, 'store'])->name('tablesStore');
		Route::get('/edit/{id}', [TablesController::class, 'editar'])->name('tablesEdit');
		Route::post('/edit/{id}', [TablesController::class, 'update'])->name('tablesUpdate');
		Route::delete('/{id}', [TablesController::class, 'destroy'])->name('deleteUser');
		Route::get('/{id}', [TablesController::class, 'show'])->name('tablesShow');
	});

	Route::prefix('Shop')->group(function(){
		Route::get('/', [ShopController::class, 'index'])->name('Shop');
		Route::get('/new', [ShopController::class, 'create'])->name('ShopAdd');
		Route::post('/store', [ShopController::class, 'store'])->name('ShopStore');
		Route::get('/edit/{id}', [ShopController::class, 'editar'])->name('ShopEdit');
		Route::post('/edit/{id}', [ShopController::class, 'update'])->name('ShopUpdate');
		Route::delete('/{id}', [ShopController::class, 'destroy'])->name('deleteShop');
		Route::get('/{id}', [ShopController::class, 'show'])->name('ShopShow');
	});
	
	



	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

	Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

	Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');


// 
// Rutas para clientes
Route::middleware(['role:Cliente'])->group(function () {
	// Route::get('/cliente/dashboard', [ClienteController::class, 'dashboard']);
	// Route::get('/cliente/perfil', [ClienteController::class, 'perfil']);
});

// Rutas para administradores
Route::middleware(['role:Admin'])->group(function () {
	// Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
	// Route::get('/admin/usuarios', [AdminController::class, 'usuarios']);
});

// Rutas para trabajadores
Route::middleware(['role:trabajador'])->group(function () {
	// Route::get('/trabajador/dashboard', [TrabajadorController::class, 'dashboard']);
});





// Route::get('/usuarios/activos', [UserController::class, 'usuarios']);



// 
// Route::get('/test-procedures', function () {
//     // Llamada al procedimiento de inserción
//     DB::statement('CALL sp_ins_cli_yair(?, ?, ?, ?, ?, ?, ?, ?)', [
//         'John', 'Doe', 'securepassword', 'john@example.com', '1234567890', 'NYC', 'Hello world', 'active'
//     ]);

//     // Llamada al procedimiento de obtención
//     $users = DB::select('CALL sp_get_cli_yair()');

//     return response()->json($users); // Devuelve los datos como JSON para comprobar
// });
// 