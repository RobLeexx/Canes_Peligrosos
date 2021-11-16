<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download(){
        $path = public_path('storage/doc/memos/BreadBasket_DMS.csv');
        return response()->download($path);
    }
}
