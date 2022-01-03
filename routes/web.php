<?php

use App\Http\Controllers\EntrarController;
use App\Http\Controllers\EpisodiosController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadasController;
use App\Mail\NovaSerie;
use App\Serie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['autenticador'])->name('dashboard');

Route::get('/series', [SeriesController::class, 'index'])
    ->name('listar_series');

Route::get('/series/criar', [SeriesController::class, 'create'])
    ->middleware(['autenticador'])
    ->name('form_nova_serie');

Route::post('series/criar', [SeriesController::class, 'store'])
    ->middleware(['autenticador'])
    ->name('adicionar_serie');

Route::post('series/remover/{id}', [SeriesController::class, 'destroy'])
    ->middleware(['autenticador'])
    ->name('excluir_serie');

Route::post('/series/{id}/editaNome', [SeriesController::class, 'editaNome'])
    ->middleware(['autenticador']);

Route::get('/series/{serieId}/temporadas', [TemporadasController::class, 'index']);

Route::get('/temporada/{temporada}/episodios', [EpisodiosController::class, 'index']);

Route::post('/temporada/{temporada}/episodios/assistir', [EpisodiosController::class, 'assistir'])->middleware(['autenticador']);

//criando nossa própia rota de login
Route::get('/entrar', [EntrarController::class, 'index'])
    ->name('form_login');
//rota que realiza o login de fato
Route::post('/entrar', [EntrarController::class, 'entrar']);

//rota para abrir formulário de registro
Route::get('/registrar', [RegistroController::class, 'create'])
    ->name('form_registro');

//rota para cadastrar usuário
Route::post('/registrar', [RegistroController::class, 'store']);

//rota para sair
Route::get('/sair', function() {
    Auth::logout();
    return redirect()->route('form_login');
});

//rota para email
Route::get('/visualizando-email', function() {
    return new NovaSerie(
        'The Mandalorian',
        2,
        16
    );
});

//rota para email
Route::get('/enviando-email', function() {
    $email = new NovaSerie(
        'The Mandalorian',
        2,
        16
    );

    $user = (object)[
        'email' => 'lucas@teste.com',
        'name' => 'Lucas'
    ];
    
    
    Mail::to($user)->send($email);

    return 'Email enviado';
});

require __DIR__.'/auth.php';
