<?php

namespace App\Exports;

use App\Usuario as user;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class pisExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    protected $promesa;

    public function __construct($promesa = null)
    {
        $this->promesa = $promesa;
    }
    public function headings(): array
    {
        return [
            'RUT',
            'Nombre',
            'Apellido',
            'Tipo',
            'Pis1',
            'Pis2',
            'Pis3',
            'Pis4',
            'Pis5'
        ];
    }


    public function collection()
    {
        return $this->promesa;
    }
}
