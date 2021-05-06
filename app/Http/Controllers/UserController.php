<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;

use App\Models\User;

class UserController extends BaseController
{
    public function listUsers(Request $request) {
        dd(Auth::user()->name);
    }

    protected $exportFileName = "users";

    /**
     * Export result data to file
     *
     * @param $request Request
     * @param $filters Filter
     * @return File Exported file download
     */
    public function export(Request $request)
    {
        $results = User::all();


        // Create header in excel file
        $headings = array(
            'ID',
            'Name',
            'Email',
        );
        // Content
        $contents = [];
        foreach ($results as $row) {
            $contents[] = array(
                '0' => $row->id,
                '1' => $row->name,
                '3' => $row->email,
            );
        }
        
        return Excel::download(new UserExport($headings, $contents, $results->count()), $this->generateExportFileName());
    }
}
