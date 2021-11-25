<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use Illuminate\Http\Request;
use Inertia\Inertia;
use DB;

class DownloadController extends Controller
{
    public function downloadMemo($memo)
    {
        $path = public_path('storage/doc/memos/'. $memo);
        return response()->download($path);
    }
    public function downloadDoc($doc)
    {
        $path = public_path('storage/doc/identificación/'. $doc);
        return response()->download($path);
    }
}
