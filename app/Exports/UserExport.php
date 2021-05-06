<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


/**
 * Export
 */
class UserExport extends Export implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents {

    /**
     * Set style export file
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;

                $this->setSheet($sheet);

                $this->setAlignLeft(['A', 'B', 'C']);

                $this->setWidthDefaut(['B', 'C']);

                $this->setTitleHeightDefault();

                $this->setTitleAlignVerticalCenter();

                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $event->sheet->getStyle('A1:C'.($this->numberRows+1).'')->applyFromArray($styleArray);
            },
        ];
       
    }

}