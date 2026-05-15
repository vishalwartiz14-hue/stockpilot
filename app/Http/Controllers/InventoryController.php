<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InventoryController extends Controller
{

    // public function viewData(Request $request)
    // {

    // /*
    //     ==============================================
    //     Delete Inventory Item start
    //     ==============================================
    //     */
    //     if ($request->get('delete_inventory')) {
    //         $delete_inventory_id         =   urldecode(base64_decode($request->get('delete_inventory')));
    //         DB::table('inventory')->where('id', $delete_inventory_id)->delete();
    //         return redirect()->route('inventory.viewData')->with('success', 'Inventory item deleted successfully');
    //     }        
    //     /*
    //     ==============================================
    //     Delete Inventory Item End
    //     ==============================================
    //     */

    //     $data['inventory_items']  =    DB::table('inventory')->orderBy('id','Desc')->get();
    //     $data['total_items'] = $data['inventory_items']->count();
    //     // $data['low_stock_items'] = $data['inventory_items']->where('stock', '<', 'reorder_level')->count();
    //     $data['total_value'] = $data['inventory_items']->sum(function ($item) {
    //         return $item->opening_stock * $item->price;
    //     });
    //     return view('inventory.view_data', $data);
    // }

    public function viewData(Request $request){
    /*
    ==============================================
    Delete Inventory
    ==============================================
    */
    if ($request->get('delete_inventory')) {

        $id         =       urldecode(base64_decode($request->get('delete_inventory')));
        DB::table('inventory')->where('id', $id)->delete();
        return redirect()->route('inventory.viewData')->with('success', 'Inventory item deleted successfully');
    }

    /*
    ==============================================
    Inventory Data
    ==============================================
    */

    $inventory_items        =   DB::table('inventory')->orderBy('id', 'DESC')->get();

    foreach ($inventory_items as $inventory) {
        $item           =   DB::table('items')->where('id', $inventory->item_id)->first();

        $inventory->item_name   =   $item->name ?? '-';
        $inventory->price       =   $item->price ?? 0;
        $inventory->unit        =   $item->unit ?? '-';

        $inventory->tax_rate    =   $item->tax_rate ?? 0;

        $category               =   DB::table('categories')->where('id', $item->category_id ?? 0)->first();

        $inventory->category_name   =   $category->name ?? '-';

        $location                   =   DB::table('storage_locations')->where('id', $inventory->storage_location_id)->first();

        $inventory->storage_location = $location->name ?? '-';
    }

    /*
    ==============================================
    Dashboard Data
    ==============================================
    */
    $data['inventory_items']        =   $inventory_items;
    $data['total_items']            =   $inventory_items->count();
    $data['low_stock_items']        =   $inventory_items->where('opening_stock','<=','reorder_level')->count();

    $data['total_value']            =   $inventory_items->sum(function ($item) {
            return $item->opening_stock * $item->price;
        });

    return view('inventory.view_data', $data);
}

    public function addData(Request $request)
    {
        if($request->post('add_inventory_button')){            
            $request->validate([
            'item_id'             => 'required|max:255',
            'category_id'           => 'required|exists:categories,id',
            'opening_stock'         => 'required|numeric|min:0',
            'reorder_level'         => 'required|numeric|min:0',
            'storage_location_id'   => 'required|exists:storage_locations,id',
        ], [], [
            'item_id'             => 'Item ',
            'category_id'           => 'Category',
            'opening_stock'         => 'Opening Stock',
            'reorder_level'         => 'Reorder Level',
            'storage_location_id'   => 'Storage Location',

        ]);

        DB::table('inventory')->insert([
            'item_id'             => $request->item_id,
            'category_id'           => $request->category_id,
            'opening_stock'         => $request->opening_stock,
            'reorder_level'         => $request->reorder_level,
            'storage_location_id'   => $request->storage_location_id,
            'created_at'            => now(),
            'updated_at'            => now(),

        ]);
        return redirect()->route('inventory.viewData')->with('success', 'Inventory item added successfully');
        }
        $data['storage_locations']   =  DB::table('storage_locations')->where('status','Active')->get();
        $data['categories']          =  DB::table('categories')->where('status','Active')->get();
        $data['items']               =  DB::table('items')->where('status','Active')->get();
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
                'item_id'             => 'required|max:255',
                'category_id'           => 'required|exists:categories,id',
                'opening_stock'         => 'required|numeric|min:0',
                'reorder_level'         => 'required|numeric|min:0',
                'storage_location_id'   => 'required|exists:storage_locations,id',
            ], [], [
    
                'item_id'             => 'Item ',
                'category_id'           => 'Category',
                'opening_stock'         => 'Opening Stock',
                'reorder_level'         => 'Reorder Level',
                'storage_location_id'   => 'Storage Location',
            ]); 

            DB::table('inventory')->where('id', $id)->update([
                'item_id'      => $request->item_id,
                'category_id'    => $request->category_id,
                'opening_stock' => $request->opening_stock,
                'reorder_level' => $request->reorder_level,
                'storage_location_id' => $request->storage_location_id,
                'updated_at'     => now(),
            ]);
            return redirect()->route('inventory.viewData')->with('success', 'Inventory item updated successfully');
        }
        $data['items']               =  DB::table('items')->where('status','Active')->get();
        $data['storage_locations']   =  DB::table('storage_locations')->where('status','Active')->get();
        $data['categories']          =  DB::table('categories')->where('status','Active')->get();
        $data['inventory_item']      =  $inventory_item;
        return view('inventory.edit_data', $data);
    }

}