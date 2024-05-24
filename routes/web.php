<?php

use App\Http\Controllers\ArriveController;
use App\Http\Controllers\ArrondissementController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\DecisionController;
use App\Http\Controllers\DecretController;
use App\Http\Controllers\DepartController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\IndemniteController;
use App\Http\Controllers\InterneController;
use App\Http\Controllers\LoiController;
use App\Http\Controllers\NomminationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProcesverbalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;








/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return view('user.login-page');
});
Route::get('/', [UserController::class, 'homePage'])->name('home');


Route::get('/login-page', [ProfileController::class, 'loginPage'])->name('login-page');
Route::get('/register-page', [ProfileController::class, 'registerPage'])->name('register-page');

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

/* Route::group(['middleware' => ['isAdmin']], function () { */
Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/home', [UserController::class, 'homePage'])->name('home');
    Route::get('/profil', [ProfileController::class, 'profilePage'])->name('profil');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    /* Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users/create', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update'); */

    Route::put('/arrives/{arriveId}/delete', [ArriveController::class, 'destroy']);
    Route::put('/departs/{departId}/delete', [DepartController::class, 'destroy']);


    Route::get('/roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionsToRole']);
    Route::put('/roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionsToRole']);


    Route::get('/employes/{employeId}/give-lois', [EmployeController::class, 'addLoisToEmploye']);
    Route::put('/employes/{employeId}/give-lois', [EmployeController::class, 'giveLoisToEmploye']);

    Route::get('/employes/{employeId}/give-decrets', [EmployeController::class, 'addDecretToEmploye']);
    Route::put('/employes/{employeId}/give-decrets', [EmployeController::class, 'giveDecretToEmploye']);

    Route::get('/employes/{employeId}/give-procesverbals', [EmployeController::class, 'addProcesverbalToEmploye']);
    Route::put('/employes/{employeId}/give-procesverbals', [EmployeController::class, 'giveProcesverbalToEmploye']);

    Route::get('/employes/{employeId}/give-decisions', [EmployeController::class, 'addDecisionToEmploye']);
    Route::put('/employes/{employeId}/give-decisions', [EmployeController::class, 'giveDecisionToEmploye']);

    Route::get('/employes/{employeId}/give-articles', [EmployeController::class, 'addArticleToEmploye']);
    Route::put('/employes/{employeId}/give-articles', [EmployeController::class, 'giveArticleToEmploye']);

    Route::get('/employes/{employeId}/give-nomminations', [EmployeController::class, 'addNomminationToEmploye']);
    Route::put('/employes/{employeId}/give-nomminations', [EmployeController::class, 'giveNomminationToEmploye']);

    Route::get('/employes/{employeId}/give-indemnites', [EmployeController::class, 'addIndemniteToEmploye']);
    Route::put('/employes/{employeId}/give-indemnites', [EmployeController::class, 'giveIndemniteToEmploye']);

    Route::get('/roles/{roleName}/get-users', [RoleController::class, 'getUsersToRole']);


    Route::get('arrive-imputations/{id}', [ArriveController::class, 'arriveImputation'])->name('arrive-imputations');
    Route::post('/arrive/fetch', [ArriveController::class, 'fetch'])->name('arrive.fetch');

    Route::get('depart-imputations/{id}', [DepartController::class, 'departImputation'])->name('depart-imputations');
    Route::post('/depart/fetch', [DepartController::class, 'fetch'])->name('depart.fetch');


    Route::post('/comments/{courrier}', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/commentReply/{comment}', [CommentController::class, 'storeCommentReply'])->name('comments.storeReply');

    Route::get('/showFromNotification/{courrier}/{notification}', [CourrierController::class, 'showFromNotification'])->name('courriers.showFromNotification');

    Route::get('coupon-arrive/{id}', [ArriveController::class, 'couponArrive'])->name('coupon-arrive');
    Route::get('file-decision/{id}', [EmployeController::class, 'fileDecision'])->name('file-decision');
    
    Route::get('notifications/', [CourrierController::class, 'notifications'])->name('notifications');

    /* Vues ressouces */
    Route::resource('/users', UserController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/courriers', CourrierController::class);
    Route::resource('/arrives', ArriveController::class);
    Route::resource('/departs', DepartController::class);
    Route::resource('/internes', InterneController::class);
    Route::resource('/directions', DirectionController::class);
    Route::resource('/employes', EmployeController::class);
    Route::resource('/regions', RegionController::class);
    Route::resource('/departements', DepartementController::class);
    Route::resource('/arrondissements', ArrondissementController::class);
    Route::resource('/communes', CommuneController::class);
    Route::resource('/categories', CategorieController::class);
    Route::resource('/fonctions', FonctionController::class);
    Route::resource('/lois', LoiController::class);
    Route::resource('/decrets', DecretController::class);
    Route::resource('/procesverbals', ProcesverbalController::class);
    Route::resource('/decisions', DecisionController::class);
    Route::resource('/articles', ArticleController::class);
    Route::resource('/nomminations', NomminationController::class);
    Route::resource('/indemnites', IndemniteController::class);
});



require __DIR__ . '/auth.php';
