<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

abstract class AbstractController extends Controller
{   

    // File import has header or not
    protected $hasHeader = true;

    // Export file name
    protected $exportFileName = "";

    /**
     * Store temporary upload file
     * @param Illuminate\Http\UploadedFile uploadedFile 
     */
    public function storeTempUploadFile(UploadedFile $uploadedFile) {
        $time = date("d-m-Y")."-".time();
        $file_path = $time.'_'.$uploadedFile->getClientOriginalName();
        Storage::putFileAs(
            'Excel', $uploadedFile, $file_path
        );
        return $file_path;
    }

    /**
     * Check if Excel file exists at local disk
     * @param String fileName File name
     * @return Boolean Excel file exists or not
     */
    public function checkExistExcelFile($fileName) {
        return Storage::disk('local')->exists('Excel/'.$fileName);
    }

    /**
     * Get storage path of a file
     * @param String fileName File name
     * @return String File path
     */
    public function getPathExcelFile($fileName) {
        return Storage::disk('local')->path('Excel/'.$fileName);
    }

    /**
     * Generate exported file name with random str
     */
    public function generateExportFileName(){
        return $this->exportFileName.str_replace(".","",(float)rand()/(float)getrandmax()).'.xlsx';
    }
}
