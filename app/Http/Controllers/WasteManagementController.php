<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WasteManagementController extends Controller
{
    
    public function viewData(Request $request)
    {
        return view('waste-management.view_data');
    }

    public function addData(Request $request)
    {
        return view('waste-management.add_data');
    }
}