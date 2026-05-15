<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class RecipeMenuCostingController extends Controller
{
        public function viewData(Request $request)
    {
        
        return view('recipe-menucosting.view_data');
    }

    public function addData(Request $request)
    {
        
        return view('recipe-menucosting.add_data');
    }
}