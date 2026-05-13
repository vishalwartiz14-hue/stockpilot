<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AiDemandsController extends Controller
{

    public function viewData(Request $request)
    {
        return view('ai_demand.view_data');
    }

    public function addData(Request $request)
    {
        return view('ai_demand.add_data');
    }
}