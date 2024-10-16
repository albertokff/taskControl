<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TarefasExport implements FromCollection, WithHeadings
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
}
