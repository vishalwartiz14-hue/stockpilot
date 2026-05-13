<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    public function viewData(Request $request)
    {

    /*
        ==============================================
        Delete Inventory Item start
        ==============================================
        */
        if ($request->get('delete_inventory')) {
            $delete_inventory_id         =   urldecode(base64_decode($request->get('delete_inventory')));
            DB::table('inventory')->where('id', $delete_inventory_id)->delete();
            return redirect()->route('inventory.viewData')->with('success', 'Inventory item deleted successfully');
        }        
        /*
        ==============================================
        Delete Inventory Item End
        ==============================================
        */

        $data['inventory_items']  =    DB::table('inventory')->orderBy('id','Desc')->get();
        $data['total_items'] = $data['inventory_items']->count();
        // $data['low_stock_items'] = $data['inventory_items']->where('stock', '<', 'reorder_level')->count();
        $data['total_value'] = $data['inventory_items']->sum(function ($item) {
            return $item->opening_stock * $item->price;
        });
        return view('inventory.view_data', $data);
    }

    public function addData(Request $request)
    {
        if($request->post('add_inventory_button')){
            $request->validate([
            'item_name'             => 'required|max:255',
            'category_id'           => 'required|exists:categories,id',
            'unit'                  => 'required|string|max:50',
            'opening_stock'         => 'required|numeric|min:0',
            'reorder_level'         => 'required|numeric|min:0',
            'price'                 => 'required|numeric|min:0',
            'storage_location_id'   => 'required|exists:storage_locations,id',
        ], [], [

            'item_name'             => 'Item Name',
            'category_id'           => 'Category',
            'unit'                  => 'Unit',
            'opening_stock'         => 'Opening Stock',
            'reorder_level'         => 'Reorder Level',
            'price'                 => 'Price',
            'storage_location_id'   => 'Storage Location',

        ]);

        DB::table('inventory')->insert([

            'item_name'      => $request->item_name,
            'category_id'    => $request->category_id,
            'unit'           => $request->unit,
            'opening_stock' => $request->opening_stock,
            'reorder_level' => $request->reorder_level,
            'price'          => $request->price,
            'storage_location_id' => $request->storage_location_id,
            'created_at'     => now(),
            'updated_at'     => now(),

        ]);
        return redirect()->route('inventory.viewData')->with('success', 'Inventory item added successfully');
        }
        $data['storage_locations']   =  DB::table('storage_locations')->where('status','Active')->get();
        $data['categories']          =  DB::table('categories')->where('status','Active')->get();
        return view('inventory.add_data', $data);
    }

    function editData(Request $request)
    {
       $encodedId = $request->segment(2);

    // Decode the ID
    $id = base64_decode(urldecode($encodedId));   
        $inventory_item = DB::table('inventory')->where('id', $id)->first();
        if (!$inventory_item) {
            return redirect()->route('inventory.viewData')->with('error', 'Inventory item not found');
        }

        if($request->post('edit_inventory_button')){
            $request->validate([
                'item_name'             => 'required|max:255',
                'category_id'           => 'required|exists:categories,id',
                'unit'                  => 'required|string|max:50',
                'opening_stock'         => 'required|numeric|min:0',
                'reorder_level'         => 'required|numeric|min:0',
                'price'                 => 'required|numeric|min:0',
                'storage_location_id'   => 'required|exists:storage_locations,id',
            ], [], [
    
                'item_name'             => 'Item Name',
                'category_id'           => 'Category',
                'unit'                  => 'Unit',
                'opening_stock'         => 'Opening Stock',
                'reorder_level'         => 'Reorder Level',
                'price'                 => 'Price',
                'storage_location_id'   => 'Storage Location',
            ]); 

            DB::table('inventory')->where('id', $id)->update([
                'item_name'      => $request->item_name,
                'category_id'    => $request->category_id,
                'unit'           => $request->unit,
                'opening_stock' => $request->opening_stock,
                'reorder_level' => $request->reorder_level,
                'price'          => $request->price,
                'storage_location_id' => $request->storage_location_id,
                'updated_at'     => now(),
            ]);
            return redirect()->route('inventory.viewData')->with('success', 'Inventory item updated successfully');
        }
        
        $data['storage_locations']   =  DB::table('storage_locations')->where('status','Active')->get();
        $data['categories']          =  DB::table('categories')->where('status','Active')->get();
        $data['inventory_item']      =  $inventory_item;
        return view('inventory.edit_data', $data);
    }

}