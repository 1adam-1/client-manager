<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\airlodAvisController;
use App\Http\Controllers\commandeController;
use App\Http\Controllers\productController;
use App\Http\Controllers\venteController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


// Dashboard Route
Route::get('/',[dashboardController::class,'showDashboard'])->name('dashboard');
Route::post('filteredDashboard',[dashboardController::class,'filteredDashboard'])->name('filteredDashboard');
Route::get('sortedClients/{token}',[dashboardController::class, 'sortedClients'])->name('sorted');

//Commandes Route
Route::group(['prefix' => 'commandes'], function(){
    Route::get('detailsCommandes/{token}',[commandeController::class,'detailsCommandes'])->name('detailsCommandes');
    Route::get('show/{id}',[commandeController::class,'showCommande'])->name('showCommande');
    Route::post('confirmer/{id}',[commandeController::class,'confirm'])->name('confirmer');
    Route::get('showAirlodAvis/{id}',[commandeController::class,'showCommandeAirlodAvis'])->name('showCommandeAirlodAvis');

});


// Auth Routes
Route::group(['prefix' => 'auth'], function(){
    Route::get('register', [UserController::class, 'showR'])->name('register');
    Route::post('create', [UserController::class, 'create'])->name('create');
    Route::get('login', [UserController::class, 'showLogin'])->name('showL');
    Route::post('submitlogin', [UserController::class, 'login'])->name('login');
    Route::post('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('edit/{id}', [UserController::class, 'showEdit'])->name('showEdit');
    Route::put('update/{id}', [UserController::class, 'update'])->name('update');
    Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    Route::get('showUsers', [UserController::class, 'showUsers'])->name('showUsers');
    Route::post('searchUser', [UserController::class, 'searchUser'])->name('searchUser');
    Route::delete('deleteUser/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
});

// Clients Routes
Route::group(['prefix' => 'clients'], function(){
    Route::get('show', [clientController::class, 'showForm'])->name('showForm');
    Route::post('create', [clientController::class, 'createClient'])->name('createClient');
    Route::get('showClient', [clientController::class, 'affich'])->name('affich');
    Route::post('searchClient', [clientController::class, 'searchClient'])->name('search');
    Route::get('showUpdate/{id}', [clientController::class, 'showUpdate'])->name('showUpdate');
    Route::put('updateClient/{id}', [clientController::class, 'updateClient'])->name('updateClient');
    Route::delete('deleteClient/{id}', [clientController::class, 'deleteClient'])->name('deleteClient');
    Route::get('infosFacture', [clientController::class, 'infosFacture'])->name('infosFacture');
});


// Airlod Avis Routes
Route::group(['prefix' => 'airlod_avis'], function(){
    Route::get('show', [airlodAvisController::class, 'showForm'])->name('showFormAirlodAvis');
    Route::post('create', [airlodAvisController::class, 'createClient'])->name('createClientAirlodAvis');
    Route::get('showClient', [airlodAvisController::class, 'affich'])->name('affichAirlodAvis');
    Route::post('searchClient', [airlodAvisController::class, 'searchClient'])->name('searchAirlodAvis');
    Route::get('showUpdate/{id}', [airlodAvisController::class, 'showUpdate'])->name('showUpdateAirlodAvis');
    Route::put('updateClient/{id}', [airlodAvisController::class, 'updateClient'])->name('updateClientAirlodAvis');
    Route::delete('deleteClient/{id}', [airlodAvisController::class, 'deleteClient'])->name('deleteClientAirlodAvis');
});

Route::group(['prefix' => 'products'], function(){
    Route::get('show', [productController::class, 'showProducts'])->name('showProducts');
    Route::get('add', [productController::class, 'addProduct'])->name('addProduct');
    Route::post('create', [productController::class, 'createProduct'])->name('createProduct');
    Route::get('product/{id}', [productController::class, 'showProduct'])->name('showProduct');
    Route::get('search', [productController::class, 'searchProduct'])->name('searchProduct');
    Route::post('addCart{id}', [productController::class, 'addToCart'])->name('addCart');
    Route::get('showCart', [productController::class, 'showCart'])->name('showCart');
    Route::delete('deleteCart{id}',[productController::class,'deleteCart'])->name('deleteCart');
    Route::get('checkout', [productController::class, 'checkout'])->name('checkout');

});



// Clear Cache Route
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

?>
