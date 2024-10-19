<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style>
            .titulo {
                border: 1px;
                background-color: #c2c2c2;
                text-align: center;
                width: 100%;
                text-transform: uppercase;
                font-weight: bold;
                margin-bottom: 25px;
            }

            table th {
                text-align: left;
            }

            .page-break {
                page-break-after: always;
            }
        </style>
    </head>

    <body>
        <h2 class="titulo">Lista de Tarefas</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tarefa</th>
                    <th>Data Limite</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tarefas as $tarefa)
                    <tr>
                        <td>{{ $tarefa->id }}</td>
                        <td>{{ $tarefa->tarefa }}</td>
                        <td>{{ date('d/m/Y', strtotime($tarefa->data_limite_conclusao)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="page-break"></div>
        <h2>Página 2</h2>
    </body>
</html>

