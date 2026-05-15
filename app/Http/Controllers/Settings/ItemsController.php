<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller{
    public function viewData(Request $request){

    /*
        ==============================================
        Delete User Role start
        ==============================================
        */
        if ($request->get('delete_item')) {
            $delete_item_id         =   urldecode(base64_decode($request->get('delete_item')));
            DB::table('items')->where('id', $delete_item_id)->delete();
            return redirect()->route('items.viewData')->with('success', 'Item deleted successfully');
        }        
        /*
        ==============================================
        Delete User Role End
        ==============================================
        */

        $data['items'] = DB::table('items')->orderBy('id','Desc')->get();
        $data['categories'] = DB::table('categories')->where('status', 'Active')->get();
        return view('setting.items.view_data', $data);
    }
    /*
    ====================================================
    INSERT START
    ====================================================
    */
    public function addData(Request $request){
        // dd($request->all());
        $request->validate([
            'name'          => 'required|string|max:255',
            'status'        => 'required|in:Active,Inactive',
            'price'         => 'required|numeric|min:0',
            'tax_rate'      => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'category_id'    => 'required',
        ]);

           Items::create([
            'name'              =>  $request->name,
            'status'            =>  $request->status,
            'price'             =>  $request->price,
            'tax_rate'          =>  $request->tax_rate,
            'description'       =>  $request->description,
            'stock_quantity'    =>  $request->stock_quantity,
            'unit'              =>  $request->unit,
            'category_id'       =>  $request->category_id,
            'created_at'        =>  now(),
            'updated_at'        =>  now(),
        ]);

        return redirect()->back()->with('success', 'Item added successfully');
    }

    /*
    ====================================================
    INSERT END

    UPDATE START
    ====================================================
    */

    public function editData(Request $request, $id){
        $request->validate([
            'name'      =>  'required|string|max:255',
            'status'    =>  'required|in:Active,Inactive',
            'category_id' =>  'required',
        ]);

        Items::where('id', $id)->update([
            'name'              =>  $request->name,
            'status'            =>  $request->status,
            'price'             =>  $request->price,
            'tax_rate'          =>  $request->tax_rate,
            'description'     =>  $request->description,
            'stock_quantity'    =>  $request->stock_quantity,
            'unit'              =>  $request->unit,
            'category_id'       =>  $request->category_id,
            'updated_at'        =>  now(),
        ]);

        return redirect()->back()->with('success', 'Item updated successfully');
    }
       
 
}
