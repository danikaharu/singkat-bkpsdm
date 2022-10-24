<?php

namespace App\Exports;

use App\Models\Promotion;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PromotionExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    use Exportable;

    protected $month;
    protected $year;
    private $row = 0;

    function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
        $this->totalValue = 1;
    }

    public function model(array $row)
    {
        ++$this->row;
    }

    public function collection()
    {
        $data = Promotion::with('employee', 'cancel_promotion')
            ->whereMonth('created_at', Carbon::parse($this->month)->month)
            ->whereYear('created_at',   Carbon::parse($this->year)->year)
            ->get();

        return $data;
    }

    /**
     * @var Promotion $promotion
     */
    public function map($promotion): array
    {
        return [
            ++$this->row,
            $promotion->employee->nama,
            $promotion->employee->nip_baru,
            $promotion->employee->agency->n_dinas,
            $promotion->promotion_type(),
            $promotion->status(),
            $promotion->cancel_promotion->reason,
            $promotion->cancel_promotion->additional_information,
        ];
    }

    public function headings(): array
    {
        return [
            'NO.',
            'NAMA',
            'NIP',
            'INSTANSI',
            'JENIS KP',
            'STATUS USULAN',
            'ALASAN TOLAK',
            'KET',
        ];
    }

    public function startCell(): string
    {
        return 'A2';
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => 'D9D9D9']
                    ]
                ];


                $event->sheet->getStyle('A2:H2')->applyFromArray($styleArray);

                // $event->sheet->setTop()->getStyle('A2:M500')->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
            },
        ];
    }
}
