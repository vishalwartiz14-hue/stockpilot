<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{

    
    function getItemsByCategory($categoryId){
    $items              = DB::table('items')->where('category_id', $categoryId)->where('status', 'Active')->get();
    return response()->json($items);
    }  
    
   function getItemsBySupplier($supplierId)
{

    /*
    |--------------------------------------------------------------------------
    | Get Supplier
    |--------------------------------------------------------------------------
    */

    $supplier = DB::table('suppliers')
        ->where('id', $supplierId)
        ->first();

    /*
    |--------------------------------------------------------------------------
    | Get Items By Supplier Category
    |--------------------------------------------------------------------------
    */

    $items = DB::table('items')

        ->where('category_id', $supplier->category_id)

        ->where('status', 'Active')

        ->get();

    return response()->json($items);
}
}

