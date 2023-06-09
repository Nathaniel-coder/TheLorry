<?php

namespace App\Exports;

use App\Shop;
use App\Warehouse;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExportWarehouse implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if(Auth::user()->type != 'Merchant'){
            return Warehouse::all();
        }else{
            $data = Shop::where('userId', Auth::user()->id)->first();
            return Warehouse::where('user', $data->shopname)->get();
        }
    }

    public function headings(): array
    {
        return [
            'ID',
            'SHOP',
            'PRODUCT',
            'CATEGORY',
            'QUANTITY',
            'WEIGHT (KG)',
            'LENGTH (CM)',
            'WIDTH (CM)',
            'HEIGHT (CM)',
            'CREATED AT',
            'MODIDFIED AT',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFA0A0A0',
                ],
            ],
        ]);
    }
}
