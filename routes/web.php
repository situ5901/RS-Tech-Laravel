<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\Adminlogin;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\CategoryController;

/*_________________________________________________________________________
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------

|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|__________________________________________________________________________
*/

Route::get('/', function () {
    return view('admin.login');
});


Route::get('/category/create', function(){
    return view('admin.category.create');
});



Route::get('/costmor', function(){
    return view('costmor');
});

Route::group(['prefix'=>'admin'],function(){


    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('login', [Adminlogin::class, 'index'])->name('admin.login');
        Route::post('authenticate', [Adminlogin::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'auth:admin'], function () {

        Route::get('dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('logout', [HomeController::class, 'logout'])->name('admin.logout');
        Route::get('category/create',[CategoryController::class,'index']);
        Route::post('/admin/category',[CategoryController::class,'store'])->name('category.store');



    });


});