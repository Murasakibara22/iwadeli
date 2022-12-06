<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\FiltreController;
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

Route::get('/',[HomeController::class,'index']);
Route::get('/about',[HomeController::class,'store']);
Route::get('/contactez-nous',[HomeController::class,'contact']);
Route::get('/404-iwa',[HomeController::class,'notfound']);
Route::get('/tarification',[HomeController::class,'tarif']);


// Route::get('/get_all_note_livreur/{livreur_id}',[NoteController::class,'get_all_note_livreur'])->whereNumber('livreur_id');

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
  Route::get('/findSearchLivreur', [LivreurController::class , 'findSearchLivreur'])->name('findSearchLivreurs');
  Route::get('/detailsLiv/{id}',[LivreurController::class,'detailsLivr'])->whereNumber('id'); // details des commades sur le livreur

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

  //recherche des commandes en Attentes
  Route::get('/findSearchOrderEA', [OrderController::class , 'findSearOrderEA'])->name('findSearOrderEAs');
  //recherche des commandes en En cour
  Route::get('/findSearchOrderEnCour', [OrderController::class , 'findSearOrderEC'])->name('findSearOrderECs');
  //recherche des commandes en Effectuer


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

/**FILTRE */
//dans la page commande terminer
Route::get('/filtreAllCterminer', [FiltreController::class, 'filtreAllCT'])->name('filtreAllCTs');
//dans le resultat de la page 
Route::get('/filtreInAllCterminer', [FiltreController::class, 'findSearInOrderT'])->name('findSearInOrderTs');
//filtre dans le resultat du filtre des CT
Route::get('/RangeInAllCterminer', [FiltreController::class, 'RangeInAllCT'])->name('RangeInAllCTs');
//Range dans la recherche du filtre de toutes les commandes Terminer
// Route::get('/RangeInSearchAllCterminer', [FiltreController::class, 'RangeInSearchAllCT'])->name('RangeInSearchAllCTs');



//dans la page commande En Cour
Route::get('/filtreAllCEnCour', [FiltreController::class, 'filtreAllCEC'])->name('filtreAllCECs');
//dans le resultat de la page 
Route::get('/filtreInAllCEnCour', [FiltreController::class, 'findSearInOrderEC'])->name('findSearInOrderECs');
//filtre dans le resultat du filtre des CT
Route::get('/RangeInAllCEnCour', [FiltreController::class, 'RangeInAllCEC'])->name('RangeInAllCECs');


//dans la page commande En Attente
Route::get('/filtreAllCEnAttente', [FiltreController::class, 'filtreAllCEA'])->name('filtreAllCEAs');
//dans le resultat de la page 
Route::get('/filtreInAllCEnAttente', [FiltreController::class, 'findSearInOrderEA'])->name('findSearInOrderEAs');
//filtre dans le resultat du filtre des CEA
Route::get('/RangeInAllCEnAttente', [FiltreController::class, 'RangeInAllCEA'])->name('RangeInAllCEAs');


//filtre dans toutes commandes
Route::get('/FilterAllCom', [FiltreController::class, 'FilterAllCommande'])->name('FilterAllCommandes');
/**END FILTRE */


/**PAGE DE TOUTES LES COMMANDES */
Route::get('/AllOrders', [OrderController::class, 'PagesAllCOmmandes']);
//detail commande
Route::get('/DetailOneOrder/{id}', [OrderController::class, 'PagesDetailOneOrder'])->whereNumber('id');
});


require __DIR__.'/auth.php';


Route::get('/deconnexion',[AdminController::class , 'deconnexion'] );