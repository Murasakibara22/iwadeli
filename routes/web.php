<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LivreurController;

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
    return redirect('/register');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::middleware(['auth', 'roles:admin'])->group(function(){
  Route::get('/dashboard',[AdminController::class , 'index'])->middleware(['auth'])->name('dashboard');


  //Livreur 
  Route::get('/newLivreur',[LivreurController::class,'nouveau']);
  Route::post('/createNewLivreur',[LivreurController::class,'createNewLivreur'])->name('createNewLivreurs');
  Route::get('/listAllLivreur',[LivreurController::class,'listAllLiv']);
  Route::get('/changeLivreur/{id}',[LivreurController::class,'change'])->whereNumber('id');
  Route::put('/UpdaLivreur/{id}',[LivreurController::class,'updateL'])->name('updateLi')->whereNumber('id');
  Route::get('/deleteLiv/{id}',[LivreurController::class, 'deleteL'])->whereNumber('id');
  Route::delete('/destroyLiv/{id}',[LivreurController::class,'destroyL'])->name('destroyLi')->whereNumber('id');

  //Utilisateurs
  Route::get('/listAllUs',[UserController::class,'listAllU']);
  Route::get('/newUser',[UserController::class,'nouveau']);
  Route::post('/createNewUser',[UserController::class,'createNewUser'])->name('createNewUsers');



  //commande
  Route::get('/listAllCom',[OrderController::class,'listAllC']);
  //associer un livreurs a une commande
  Route::put('/valideComm',[OrderController::class,'valideCommWithLivreur'])->name('valideCommWithLivreurs');

  Route::get('/listAllComValide',[OrderController::class,'listAllCV']);

  Route::put('/valideCommTer',[OrderController::class,'TerminateCommWithLivreur'])->name('TerminateCommWithLivreurs');
});


require __DIR__.'/auth.php';


Route::get('/deconnexion',[AdminController::class , 'deconnexion'] );