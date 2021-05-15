<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ChecklistController;
use App\Http\Controllers\Admin\ChecklistGroupController;

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

Auth::routes();


Route::group(['middleware'=>'auth'],function() {
    Route::get('welcome',[PageController::class,'welcome'])->name('welcome');
    Route::get('consultation',[PageController::class,'consultation'])->name('consultation');
    Route::get('checklist/{checklist}',[ App\Http\Controllers\User\ChecklistController::class,'show'])->name('users.checklists.show');

    Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'is_admin'],function() {
      Route::resource( 'pages',PageController::class)
      ->only(['edit','update']);
      Route::resource( 'checklist_groups',ChecklistGroupController::class);
      Route::resource( 'checklist_groups.checklists',ChecklistController::class);
      Route::resource( 'checklists.tasks',TaskController::class);
      Route::get( 'users',[UserController::class,'index'])->name('users.index');

    });
});
