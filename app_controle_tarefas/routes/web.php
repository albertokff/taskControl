<?php

use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('tarefa', App\Http\Controllers\TarefaController::class)->middleware('auth');
Route::get('/mensagem-teste', function () {
    // return new MensagemTesteMail();

    Mail::to('dev.albertokff@gmail.com')->send(new MensagemTesteMail());
    return 'E-mail enviado com sucesso!';
});
