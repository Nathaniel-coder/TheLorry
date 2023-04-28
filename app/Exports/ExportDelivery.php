<?php

namespace App\Exports;

use App\Dropoff;
use App\Pickup;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExportDelivery implements FromCollection, WithHeadings, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $dropOff = Dropoff::all()->pluck('price')->toArray();
        $pickUp = Pickup::all()->pluck('price')->toArray();
        $trackingDrop = 'Drp' . date('mdy', strtotime(Dropoff::all()->pluck('created_at')));
        $trackingPick = 'PCu' . date('mdy', strtotime(Pickup::all()->pluck('created_at')));
        $dataDrop = Dropoff::all();
        $dataPick = Pickup::all();

        // $data = [
        //     ['MODE', 'TRACKING ID', 'SENDER', 'CONTACT NO.', 'BRANCH', 'ORIGIN ADDRESS', 'DESTINED ADDRESS', 'TRANSPORTER', 'PURCHASED AT', 'PRICE'],
        // ];

        foreach ($dropOff as $key => $value) {
            if (Dropoff::where('id', $key + 1)->value('status') != 'unpaid' && Dropoff::where('id', $key + 1)->value('status') != 'unpaid') {
                $data[] = ['Drop Off', $trackingDrop . ($key + 1), Dropoff::where('id', $key + 1)->value('name'), Dropoff::where('id', $key + 1)->value('phone'), Dropoff::where('id', $key + 1)->value('branch'), '', Dropoff::where('id', $key + 1)->value('toaddress1') . ',' . Dropoff::where('id', $key + 1)->value('toaddress2') . ',' . Dropoff::where('id', $key + 1)->value('topostcode') . ',' . Dropoff::where('id', $key + 1)->value('tocity') . ',' . Dropoff::where('id', $key + 1)->value('toprovince') . ',' . Dropoff::where('id', $key + 1)->value('tocountry'), Dropoff::where('id', $key + 1)->value('driverId') . '(' . Dropoff::where('id', $key + 1)->value('vehicleId') . ')', Dropoff::where('id', $key + 1)->value('created_at'), $value];
            }
        }

        foreach ($pickUp as $key => $value) {
            if (Pickup::where('id', $key + 1)->value('status') != 'unpaid' && Pickup::where('id', $key + 1)->value('status') != 'unpaid') {
                $data[] = ['Pick Up', $trackingPick . ($key + 1), Pickup::where('id', $key + 1)->value('name'), Pickup::where('id', $key + 1)->value('phone'), '', Pickup::where('id', $key + 1)->value('address1') . ',' . Pickup::where('id', $key + 1)->value('address2') . ',' . Pickup::where('id', $key + 1)->value('postcode') . ',' . Pickup::where('id', $key + 1)->value('city') . ',' . Pickup::where('id', $key + 1)->value('province') . ',' . Pickup::where('id', $key + 1)->value('country'), Pickup::where('id', $key + 1)->value('toaddress1') . ',' . Pickup::where('id', $key + 1)->value('toaddress2') . ',' . Pickup::where('id', $key + 1)->value('topostcode') . ',' . Pickup::where('id', $key + 1)->value('tocity') . ',' . Pickup::where('id', $key + 1)->value('toprovince') . ',' . Pickup::where('id', $key + 1)->value('tocountry'), Pickup::where('id', $key + 1)->value('driverId') . '(' . Pickup::where('id', $key + 1)->value('vehicleId') . ')', Pickup::where('id', $key + 1)->value('created_at'), $value];
            }
        }

        $data[] = ['', '', ''];
        $data[] = ['', '', '', '', '', '', '', '', 'Total', array_sum($dropOff) + array_sum($pickUp)];

        return collect($data);
    }
    public function headings(): array
    {
        return [
            'MODE',
            'TRACKING ID',
            'SENDER',
            'CONTACT NO.',
            'BRANCH',
            'ORIGIN ADDRESS',
            'DESTINED ADDRESS',
            'TRANSPORTER',
            'PURCHASED AT',
            'PRICE'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:J1')->applyFromArray([
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
