<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EquipeController;
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
    return view('welcome');
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
  Route::get('/changeNewUser/{id}',[UserController::class,'changeUs'])->whereNumber('id');
  Route::put('/updaUser/{id}',[UserController::class,'updateU'])->name('updateUse')->whereNumber('id');
  Route::get('/deleteUs/{id}',[UserController::class,'deleteU'])->whereNumber('id');
  Route::delete('/destroyUs/{id}',[UserController::class,'destroyU'])->name('desctroyUse')->whereNumber('id');
  Route::get('/findSearch', [UserController::class , 'findSearch'])->name('findSearch');


  //commande
  Route::get('/listAllCom',[OrderController::class,'listAllC']);
  //associer un livreurs a une commande
  Route::put('/valideComm',[OrderController::class,'valideCommWithLivreur'])->name('valideCommWithLivreurs');

  //commande valider
  Route::get('/listAllComValide',[OrderController::class,'listAllCV']);
  //Terminer une commande
  Route::put('/valideCommTer',[OrderController::class,'TerminateCommWithLivreur'])->name('TerminateCommWithLivreurs');

  //delete une commande
  Route::get('/deleteCommande/{id}',[OrderController::class,'deleteCommande'])->whereNumber('id');
  Route::delete('/destroyCommande/{id}',[OrderController::class,'destroyCommande'])->name('destroyCommandes')->whereNumber('id');

  
  //commande terminer
  Route::get('/listAllComTerminer',[OrderController::class,'listAllComTerm']);




  //equipe
Route::get('/new_equipe', [EquipeController::class, 'nouvelle']);

Route::post('/newEquipe', [EquipeController::class, 'ajoutTeam'])->name('addEquipe');

Route::get('/equipe_list', [EquipeController::class, 'listAll']);

Route::get('/equipe_edit/{slug}', [EquipeController::class, 'change']);
 
Route::put('/equipEdit/{slug}', [EquipeController::class, 'modifyEquipe'])->name('modifierEquipe');

Route::get('/equipe_delete/{slug}', [EquipeController::class, 'supprime']);

Route::delete('/equipDelete/{slug}', [EquipeController::class, 'supprimeeEquipe'])->name('deleteEquipe'); 

Route::get('/findTeam',[EquipeController::class, 'findSearchEquipe'])->name('findSearchTeam');
});


require __DIR__.'/auth.php';


Route::get('/deconnexion',[AdminController::class , 'deconnexion'] );