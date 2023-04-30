<?php

namespace App\Exports;

use App\DropOff;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportDropOff implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if(Auth::user()->type != 'Customer'){
        return DropOff::all();
        }else{
            return DropOff::where('phone', Auth::user()->phone)->get();
        }
    }
    public function headings(): array
    {
        return [
            'ID',
            'DATE',
            'SENDER',
            'CONTACT NO.',
            'ORIGIN COUNTRY',
            'BRANCH',
            'DESTINED COUNTRY',
            'DESTINED PROVINCE',
            'RECEIVER',
            'CONTACT NO.',
            'DESTINED ADDRESS1',
            'DESTINED ADDRESS2',
            'DESTINED POSTCODE',
            'DESTINED CITY',
            'DRIVER',
            'VEHICLE',
            'STATUS',
            'PICTURE',
            'HEIGHT (CM)',
            'LENGTH (CM)',
            'WIDTH (CM)',
            'WEIGHT (KG)',
            'PRICE (RM)',
            'PURCHASE DATE',
            'MODIFIED DATE',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:Y1')->applyFromArray([
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

        $sheet->getStyle('S2:S' . ($this->collection()->count() + 1))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

        $sheet->getStyle('S2:S' . ($this->collection()->count() + 1))->applyFromArray([
            'conditionalStyles' => [
                [
                    'conditionType' => \PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_CELLIS,
                    'operatorType' => \PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_EQUAL,
                    'criteria' => 'Processing',
                    'style' => [
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => 'FFFFA500',
                            ],
                        ],
                    ],
                ],
                [
                    'conditionType' => \PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_CELLIS,
                    'operatorType' => \PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_EQUAL,
                    'criteria' => 'Delivering',
                    'style' => [
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => 'FFFFFF00',
                            ],
                        ],
                    ],
                ],
                [
                    'conditionType' => \PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_CELLIS,
                    'operatorType' => \PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_EQUAL,
                    'criteria' => 'Delivered',
                    'style' => [
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => 'FF008000',
                            ],
                        ],
                    ],
                ],
                [
                    'conditionType' => \PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_CELLIS,
                    'operatorType' => \PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_EQUAL,
                    'criteria' => 'Cancelled',
                    'style' => [
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => 'FFFF0000',
                            ],
                        ],
                    ],
                ],
                [
                    'conditionType' => \PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_CELLIS,
                    'operatorType' => \PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_EQUAL,
                    'criteria' => 'Penalty',
                    'style' => [
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => 'FFFF0000',
                            ],
                        ],
                    ],
                ],
                [
                    'conditionType' => \PhpOffice\PhpSpreadsheet\Style\Conditional::CONDITION_CELLIS,
                    'operatorType' => \PhpOffice\PhpSpreadsheet\Style\Conditional::OPERATOR_EQUAL,
                    'criteria' => 'Unpaid',
                    'style' => [
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => 'FFFF0000',
                            ],
                        ],
                    ],
                ],
            ],
        ]);
    }
}
