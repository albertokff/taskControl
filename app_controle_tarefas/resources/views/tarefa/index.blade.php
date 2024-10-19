@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tarefas
                    <a href="{{ route('tarefa.exportacao', ['extensao' => 'xlsx']) }}" class="btn btn-success float-end">XLSX</a>
                    <a href="{{ route('tarefa.exportacao', ['extensao' => 'csv']) }}" class="btn btn-danger float-end" style="margin-right: 10px">CSV</a>
                    {{-- <a href="{{ route('tarefa.exportacao', ['extensao' => 'pdf']) }}" class="btn btn-info float-end" style="margin-right: 10px">PDF</a> --}}
                    <a href="{{ route('tarefa.exportar') }}" target="_blank" class="btn btn-info float-end" style="margin-right: 10px">PDF v2</a>
                    <a href="{{ route('tarefa.create') }}" class="btn btn-warning float-end" style="margin-right: 10px">Adicionar</a>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data Limite</th>                       
                                <th></th>         
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarefas as $tarefa)
                                <tr>
                                    <th scope="row">{{ $tarefa->id }}</th>
                                    <td>{{ $tarefa->tarefa }}</td>
                                    <td>{{ date('d/m/Y', strtotime($tarefa->data_limite_conclusao)) }}</td>                                    
                                    <td><a href="{{ route('tarefa.edit', $tarefa->id) }}" class="btn btn-primary">Editar</a></td>
                                    <td>
                                        <form id="form_{{ $tarefa->id }}" action="{{ route('tarefa.destroy', ['tarefa' => $tarefa->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" onclick="document.getElementById('form_{{ $tarefa->id }}').submit()" class="btn btn-danger">Excluir</a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <nav>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="{{ $tarefas->previousPageUrl() }}">Anterior</a>
                            </li>
                            @for ($i = 1; $i <= $tarefas->lastPage(); $i++)
                                <li class="page-item {{ $i == $tarefas->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $tarefas->url($i) }}">{{ $i }}</a>
                                </li>                                
                            @endfor
                            <li class="page-item">
                                <a class="page-link" href="{{ $tarefas->nextPageUrl() }}">Próximo</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
