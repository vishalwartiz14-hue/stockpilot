<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcurementController extends Controller
{

    public function viewData(Request $request)
    {
        return view('procurement.view_data');
    }

    public function addData(Request $request)
    {
        return view('procurement.add_data');
    }
}