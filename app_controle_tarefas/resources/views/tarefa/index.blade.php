@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tarefas</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data Limite</th>                       
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
