<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Tarefa::all();
        return Tarefa::where('user_id', auth()->user()->id)->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Tarefa',
            'Data Limite Conclusão',
        ];
    }

    public function map($linha): array //Esse método vem da interface withMapping, e vai retornar um array com os dados que serão exportados
                                       //Podem ser adicionadas outras linhas também com outras lógicas, basta adicionar o nome entre aspas
    {
        return [
            $linha->id,
            $linha->tarefa,
            date('d/m/Y', strtotime($linha->data_limite_conclusao)),
        ];
    }
}
