<?php

use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('verified');

Route::resource('tarefa', App\Http\Controllers\TarefaController::class)
    ->middleware('verified');
    
Route::get('/mensagem-teste', function () {
    // return new MensagemTesteMail();

    Mail::to('dev.albertokff@gmail.com')->send(new MensagemTesteMail());
    return 'E-mail enviado com sucesso!';
});
