<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Builder\FallbackBuilder;

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
Route::fallback(function() {
    return view('app.404');
});

Route::get('/home', function(){
    return redirect()->route('home');
});
Route::get('/', 'HomeController@index')->name('home');

Route::resource('sorteio', 'SorteioController');
Route::resource('pessoa', 'PessoaController');
Route::group(['prefix' => 'pessoa', 'as' => 'pessoa.'], function () {
    Route::get('add/{id}/{pessoa?}', 'PessoaController@create')->name('add');
});
