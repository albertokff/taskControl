<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TarefasExport;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    // public function __construct() {
    //     $this->middleware('auth');
    // }
    public function index()
    {
        $user_id = auth()->user()->id;
        $tarefas = Tarefa::where('user_id', $user_id)->paginate(10);

        return view('tarefa.index', ['tarefas' => $tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->all('tarefa', 'data_limite_conclusao');
        $dados['user_id'] = auth()->user()->id;

        $tarefa = Tarefa::create($dados);
        $destinatario = auth()->user()->email; //e-mail do usuário logado
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));
        return redirect()->route('tarefa.show', $tarefa->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {
        $user_id = auth()->user()->id;
        if ($tarefa->user_id != $user_id) {
            return view('acesso-negado');
        }

        return view('tarefa.edit', ['tarefa' => $tarefa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $user_id = auth()->user()->id;
        if ($tarefa->user_id != $user_id) {
            return view('acesso-negado');
        }

        $tarefa->update($request->all());
        return redirect()->route('tarefa.show', $tarefa->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        $user_id = auth()->user()->id;
        if ($tarefa->user_id != $user_id) {
            return view('acesso-negado');
        }
        $tarefa->delete();
        return redirect()->route('tarefa.index');
    }

    public function exportacao($extensao)
    {
        if (in_array($extensao, ['xlsx', 'xls', 'csv', 'dompdf'])) {
            return Excel::download(new TarefasExport, 'tarefas.' . $extensao);
        }
    }

    public function exportar()
    {
        $tarefas = auth()->user()->tarefas()->get();
        $pdf = PDF::loadView('tarefa.pdf', ['tarefas' => $tarefas]);
        // return $pdf->download('lista_de_tarefas.pdf');
        return $pdf->stream('lista_de_tarefas.pdf');
    }
}
