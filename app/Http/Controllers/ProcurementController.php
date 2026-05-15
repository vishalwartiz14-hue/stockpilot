<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProcurementController extends Controller
{

    public function viewData(Request $request){
        /*
        ==============================================
        Delete Procurement Start
        ==============================================
        */
        if ($request->get('delete_procurement')) {
            $delete_procurement_id          =   urldecode(base64_decode($request->get('delete_procurement')));
            /*
            ==============================================
            First Delete Procurement Items
            ==============================================
            */
            DB::table('procurement_items')->where('procurement_id', $delete_procurement_id)->delete();
            /*
            ==============================================
            Then Delete Procurement
            ==============================================
            */
            DB::table('procurements')->where('id', $delete_procurement_id)->delete();
            return redirect()->route('procurements.viewData')->with('success', 'Procurement deleted successfully');
        }
        /*
        ==============================================
        Delete Procurement End
        ==============================================
        */
            $data["procurements"] = DB::table('procurements')->orderby('id','Desc')->get();
            return view('procurement.view_data', $data);
        }

    public function addData(Request $request){
    /*
    =============================================
    Insertion start
    =============================================
    */
    if ($request->post('add_procurement')) {
        $request->validate([
            'po_number'                 => 'required',
            'supplier_id'               => 'required',
            'expected_delivery_date'    => 'required|date',
            'notes'                     => 'nullable',
            'items'                     => 'required|array',
            'items.*.item_id'           => 'required',
            'items.*.unit'              => 'required',
            'items.*.quantity'          => 'required|numeric|min:1',
            'items.*.unit_price'        => 'required|numeric|min:0',
        ]);
        /*
        =============================================
        Calculate totals
        =============================================
        */
        $subtotal           =   0;
        foreach ($request->items as $item) {
            $subtotal += $item['quantity'] * $item['unit_price'];
        }
        $tax                =   $subtotal * 0.10;
        $grandTotal         =   $subtotal + $tax;
        /*
        =============================================
        Insert Procurement
        =============================================
        */

        $procurementId = DB::table('procurements')->insertGetId([
            'po_number'                 => $request->po_number,
            'supplier_id'               => $request->supplier_id,
            'expected_delivery_date'    => $request->expected_delivery_date,
            'notes'                     => $request->notes,
            'subtotal'                  => $subtotal,
            'tax'                       => $tax,
            'grand_total'               => $grandTotal,
            'created_at'                => now(),
            'updated_at'                => now(),
        ]);
        /*
        =============================================
        Insert Procurement Items
        =============================================
        */
        foreach ($request->items as $item) {
            $lineTotal = $item['quantity'] * $item['unit_price'];
            DB::table('procurement_items')->insert([
                'procurement_id'     => $procurementId,
                'item_id'            => $item['item_id'],
                'unit'               => $item['unit'],
                'quantity'           => $item['quantity'],
                'unit_price'         => $item['unit_price'],
                'total'              => $lineTotal,
                'created_at'         => now(),
                'updated_at'         => now(),
            ]);
        }
        return redirect()->route('procurements.viewData')->with('success', 'Purchase Order Created Successfully');
    }
    /*
    =============================================
    Load Data
    =============================================
    */
    $data["suppliers"]      =   DB::table('suppliers')->where('status', 'Active')->get();
    $data["items"]          =   DB::table('items')->where('status', 'Active')->get();

    return view('procurement.add_data', $data);
}
    function singleData(Request $request, $id){
        $data["procurement"]            =   DB::table('procurements')->where('id', $id)->first();
        if (!$data["procurement"]) {
            return redirect()->route('procurements.viewData')->with('error', 'Purchase Order Not Found');
        }
        $data["supplier"]               =   DB::table('suppliers')->where('id', $data["procurement"]->supplier_id)->first();
        $data["items"]                  =   DB::table('procurement_items')->where('procurement_id', $id)->get();
        return view('procurement.single_data', $data);
    } 

    public function editData(Request $request, $id){
        /*
        =============================================
        Update Procurement Start
        =============================================
        */
        if ($request->post('update_procurement')) {

            $request->validate([
                'po_number'                 => 'required',
                'supplier_id'               => 'required',
                'expected_delivery_date'    => 'required|date',
                'notes'                     => 'nullable',
                'items'                     => 'required|array',
                'items.*.item_id'           => 'required',
                'items.*.unit'              => 'required',
                'items.*.quantity'          => 'required|numeric|min:1',
                'items.*.unit_price'        => 'required|numeric|min:0',
            ]);

            /*
            =============================================
            Calculate Totals
            =============================================
            */
            $subtotal = 0;

            foreach ($request->items as $item) {

                $subtotal += $item['quantity'] * $item['unit_price'];
            }

            $tax = $subtotal * 0.10;

            $grandTotal = $subtotal + $tax;

            /*
            =============================================
            Update Procurement
            =============================================
            */
            DB::table('procurements')
                ->where('id', $id)
                ->update([
                    'po_number'                 => $request->po_number,
                    'supplier_id'               => $request->supplier_id,
                    'expected_delivery_date'    => $request->expected_delivery_date,
                    'notes'                     => $request->notes,
                    'subtotal'                  => $subtotal,
                    'tax'                       => $tax,
                    'grand_total'               => $grandTotal,
                    'updated_at'                => now(),
                ]);

            /*
            =============================================
            Delete Old Procurement Items
            =============================================
            */
            DB::table('procurement_items')
                ->where('procurement_id', $id)
                ->delete();

            /*
            =============================================
            Insert New Procurement Items
            =============================================
            */
            foreach ($request->items as $item) {

                $lineTotal              =   $item['quantity'] * $item['unit_price'];

                DB::table('procurement_items')->insert([
                    'procurement_id'    =>  $id,
                    'item_id'           =>  $item['item_id'],
                    'unit'              =>  $item['unit'],
                    'quantity'          =>  $item['quantity'],
                    'unit_price'        =>  $item['unit_price'],
                    'total'             =>  $lineTotal,
                    'created_at'        =>  now(),
                    'updated_at'        =>  now(),
                ]);
            }

            return redirect()->route('procurements.viewData')->with('success', 'Purchase Order Updated Successfully');
        }

        /*
        =============================================
        Load Procurement Data
        =============================================
        */
        $data['procurement']            =   DB::table('procurements')->where('id', $id)->first();

        /*
        =============================================
        Load Procurement Items
        =============================================
        */
        $data['procurement_items']      =   DB::table('procurement_items')->where('procurement_id', $id)->get();

        /*
        =============================================
        Load Suppliers
        =============================================
        */
        $data['suppliers']      =   DB::table('suppliers')->where('status', 'Active')->get();

        /*
        =============================================
        Load Items
        =============================================
        */
        $data['items']          =   DB::table('items')->where('status', 'Active')->get();

        return view('procurement.edit_data', $data);
    }

}