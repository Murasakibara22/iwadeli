<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\OrderControllerCopie;
use App\Http\Controllers\AuthLivreurController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::post('/connexion', [AuthController::class, 'connecte']);
Route::post('/inscription', [AuthController::class, 'enreg']);


////////////////////////////////////////////////////////////
////////////////***LIVREUR APPLICATION *///////////////////
//////////////////////////////////////////////////////////


Route::post('/enregistre_livreur',[AuthLivreurController::class,'enreg_livreur']);
Route::post('/connexion_livreur',[AuthLivreurController::class,'connecte_livreur']);
Route::post('/moi_livreur',[AuthLivreurController::class,'me_livreur'])->middleware('auth:sanctum');//
Route::post('/Logout_livreur', [AuthLivreurController::class, 'Logout_livreur'])->middleware('auth:sanctum');//deconnexion coter livreur
Route::post('/change_password_livreur/{livreur_id}', [AuthLivreurController::class,'updatePasswordLivreur'])->middleware('auth:sanctum')->whereNumber('livreur_id');
Route::put('/terminate_order_s/{id}', [OrderController::class, 'terminate_order'])->middleware('auth:sanctum');//Terminer une commande


//App Livreur ICI
Route::get('/livreur_order_e/{id}',[LivreurController::class,'order_in_livreur'])->whereNumber('id');//Toute les commande en Cour pour un livreur cible

Route::get('/livreur_order_terminer/{id}',[LivreurController::class,'order_livreur_terminate'])->whereNumber('id');//Toute les commande Terminer par un livreur cible

Route::get('/livreur_order_refuser/{id}',[LivreurController::class,'order_livreur_refused'])->whereNumber('id');//Toute les commande Refuser par un livreur cible

Route::post('/note_livreur/{livreur_id}',[NoteController::class, 'createNote'])->whereNumber('livreur_id'); //notez un livreur avec des etoiles

////////////////////////////////////////////////////////////
////////////////*** END LIVREUR APPLICATION *///////////////////
//////////////////////////////////////////////////////////

Route::post('/add', [OrderController::class, 'create']);//recuperer l'id du livreur et l'envoyer en base de Order (lorsque l'admin accepte avec l'id du livreur)


Route::post('/addCopie', [OrderControllerCopie::class, 'createTest'])->middleware('auth:sanctum');//recuperer les commandes et envoyer sur le Tableau de bord (users qui passe la commande)

Route::get('/edit/{id}',[UserController::class, 'change'])->middleware('auth:sanctum')->whereNumber('id');

Route::put('/modifyUser/{id}', [UserController::class, 'updateUser'])->middleware('auth:sanctum');//admin and users

Route::get('/destroyUser/{id}', [UserController::class, 'destroyUser'])->middleware('auth:sanctum');//admin and users

Route::get('/cancelCopie/{id}', [OrderControllerCopie::class, 'CancelCopie'])->middleware('auth:sanctum');//users annule la COM

Route::post('/logout', [AuthController::class, 'Logout'])->middleware('auth:sanctum');//deconnexion avec le login

Route::get('/getUsers', [UserController::class, 'getUser']);

Route::get('/return_order_user/{user_id}', [OrderController::class, 'getUserOrder'])->middleware('auth:sanctum')->whereNumber('user_id');

Route::get('/return_latest_order_user/{user_id}', [UserController::class, 'get_order_last'])->middleware('auth:sanctum')->whereNumber('user_id'); //la derniere commande d'un utilisateur

Route::get('/get_livreurs_details/{id}', [LivreurController::class, 'get_livreurs_det'])->middleware('auth:sanctum')->WhereNumber('id');

//admin
Route::middleware(['auth:sanctum', 'role:admin'])->group(function(){ 

    Route::get('/returnUser', [UserController::class, 'UserWhOrder'])->middleware('auth:sanctum');


    Route::get('search/{name}', [UserController::class, 'search'])->middleware('auth:sanctum');//effectuer une recherche sur une lettre dans le nom d'un utilisateurs
    



Route::get('/listCopie', [OrderControllerCopie::class, 'listAllCopie'])->middleware('auth:sanctum');//admin  retourner les commandes sur les tableau de bord (afficher toutes les commandes sur le TB qui ne sont pas encore accepeter )


Route::get('/list', [OrderController::class, 'listAll'])->middleware('auth:sanctum');//admin  retourne toutels vrai commandes ur Order(afficher toutes les commandes valider)

Route::put('/modifyy/{id}', [OrderController::class, 'updateCom'])->WhereNumber('id')->middleware('auth:sanctum'); //user and admin

Route::delete('/destroyer/{id}', [OrderController::class, 'destroyCom'])->middleware('auth:sanctum');

Route::get('/comAU', [OrderController::class, 'todayR'])->middleware('auth:sanctum');//commande du jours (admin)

Route::post('/comAll/{data}', [OrderController::class, 'PrecisedateOrder'])->middleware('auth:sanctum');//commande d'une date  (admin)

Route::post('/comAllUser/{data}', [OrderController::class, 'PrecisedateUserOrder'])->middleware('auth:sanctum');//commande d'un utilisateurs a une date precise  (admin)

Route::post('/comMonth/{data}', [OrderController::class, 'precisetheMonth'])->middleware('auth:sanctum');//les utilisateurs qui on commander dans le mois X  (admin)

Route::post('/comMonthOrder/{data}', [OrderController::class, 'precisetheMonthOrder'])->middleware('auth:sanctum'); //toutes les commander passée le mois X  (admin)


Route::post('/addLivreur', [LivreurController::class, 'createLivreur'])->middleware('auth:sanctum');//admin

Route::get('/listLivreur', [LivreurController::class, 'listAll'])->middleware('auth:sanctum');//admin



Route::get('/listLivreurOrder', [LivreurController::class, 'listOrderLivreur'])->middleware('auth:sanctum');//admin

Route::put('/modifyLivreur/{id}', [LivreurController::class, 'updateLivreur'])->middleware('auth:sanctum');//admin

Route::delete('/deleteLivreur/{id}', [LivreurController::class, 'destroyLivreur'])->middleware('auth:sanctum');//admin

Route::get('/total', [LivreurController::class, 'countCourse'])->middleware('auth:sanctum');//admin



  //modifier son mot de passe
  Route::post('/change_password_user/{user_id}', [AuthController::class,'updatePasswordUser'])->whereNumber('user_id');
});


