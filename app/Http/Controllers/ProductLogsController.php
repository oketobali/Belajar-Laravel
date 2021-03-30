<?php

namespace App\Http\Controllers;

use App\Models\ProductLogs;

class ProductLogsController extends Controller
{
    //show all log
    public function showLogs(){
        $productLogs = ProductLogs::paginate(10);
        return view('productLogs', compact('productLogs'));
    }
}
