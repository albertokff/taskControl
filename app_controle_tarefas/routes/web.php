<?php

use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TarefaController;

Route::get('/', function () {
    return view('bem-vindo');
});

Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
//     ->name('home')
//     ->middleware('verified');
Route::get('tarefa/exportacao/{extensao}', [TarefaController::class, 'exportacao'])->name('tarefa.exportacao');
Route::get('tarefa/exportar', [TarefaController::class, 'exportar'])->name('tarefa.exportar');
Route::resource('tarefa', App\Http\Controllers\TarefaController::class)
    ->middleware('verified');
    
Route::get('/mensagem-teste', function () {
    // return new MensagemTesteMail();

    Mail::to('dev.albertokff@gmail.com')->send(new MensagemTesteMail());
    return 'E-mail enviado com sucesso!';
});
