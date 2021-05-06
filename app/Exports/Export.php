<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Style\Alignment;

/**
 * 共通Excel Exportクラス
 */
class Export {

    public $sheet;
    public $headings;
    public $content;
    public $defaultDelta = 1.8;
    public $defaultTitleHeight = 25;

    public $elearningFileTitleColor = '9bc2e6';
    public $elearningHeaderColor = 'ddebf7';

    public function __construct($headings, $content, $numberRows = 0){
        $this->headings = $headings;
        $this->content = $content;
        $this->numberRows = $numberRows;
    }

    /**
     * Set sheet property
     */
    public function setSheet($sheet) {
        $this->sheet = $sheet;
    }

    /**
     * Get sheet property
     */
    public function getSheet() {
        return $this->sheet;
    }

    /**
     * Get collection data
     */
    public function collection(){
        return (collect($this->content));
    }

    /**
     * Get headings
     */
    public function headings(): array
    {
        return $this->headings;
    }

    /**
     * Adjust with for columns with default delta
     */
    public function setWidthDefaut($columns) {
        $this->setWidth($columns, $this->defaultDelta);
    }

    /**
     * Adjust with for columns with custom delta
     */
    public function setWidth($columns, $delta) {
        $this->sheet->calculateColumnWidths();

        foreach ($columns as $col) {
            $width = $this->sheet->getColumnDimension($col)->getWidth();
            $this->sheet->getColumnDimension($col)->setAutosize(false);
            $this->sheet->getColumnDimension($col)->setWidth($width * $delta);
        }
    }

    /**
     * Set auto size for list columns
     */
    public function autoSize($columns) {
        foreach ($columns as $col) {
            $this->sheet->getColumnDimension($col)->setAutosize(true);
        }
    }

    /**
     * Set row height for list rows
     */
    public function setHeight($rows, $height) {
        foreach ($rows as $row) {
            $this->sheet->getRowDimension($row)->setRowHeight($height);
        }
    }

    /**
     * Set title row height with custom height
     */
    public function setHeightAllRows($height, $withTitle) {
        $firstRow =  $withTitle ? 2 : 1;
        $lastRow = $this->sheet->getHighestRow();
        
        for ($row = $firstRow; $row < $lastRow; $row++) {
            $this->sheet->getRowDimension($row)->setRowHeight($height);
        }
    }

    /**
     * Adjust title row height with custom height
     */
    public function setTitleHeight($height) {

        $this->sheet->getRowDimension(1)->setRowHeight($height);
    }

    /**
     * Adjust title row height with default height
     */
    public function setTitleHeightDefault() {

        $this->setTitleHeight($this->defaultTitleHeight);
    }


    /**
     * Align left for columns
     */
    public function setAlignLeft($columns) {
        $lastRow = $this->sheet->getHighestRow();

        foreach ($columns as $col) {
            $this->sheet->getStyle($col . '1' . ':' . $col . $lastRow)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_LEFT);
        }
    }

    /**
     * Align right for columns
     */
    public function setAlignRight($columns) {
        $lastRow = $this->sheet->getHighestRow();

        foreach ($columns as $col) {
            $this->sheet->getStyle($col . '1' . ':' . $col . $lastRow)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        }
    }

    /**
     * Align center for columns
     */
    public function setAlignCenter($columns) {
        $lastRow = $this->sheet->getHighestRow();

        foreach ($columns as $col) {
            $this->sheet->getStyle($col . '1' . ':' . $col . $lastRow)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }
    }

    /**
    * Align vertical center for titles
    */
   public function setTitleAlignVerticalCenter() {
       $lastColumn = $this->sheet->getHighestColumn(1);
       $alphabet = range('A', $lastColumn);
        
       $cells = array();
       foreach ($alphabet as $col) {
            $cells[] = $col . '1';
        }
        $this->setAlignVerticalCenter($cells);
   }

    /**
     * Align vertical center for cells
     */
    public function setAlignVerticalCenter($cells) {
        foreach ($cells as $cell) {
            $this->sheet->getStyle($cell)
            ->getAlignment()
            ->setVertical(Alignment::HORIZONTAL_CENTER);
        }
    }
    

}