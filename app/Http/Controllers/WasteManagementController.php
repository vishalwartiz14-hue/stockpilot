<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class WasteManagementController extends Controller{  
    public function viewData(Request $request){
        $currentMonth                =  date('m');
        $currentYear                 =  date('Y');
        $totalWasteThisMonth         =  DB::table('waste_records')->whereMonth('waste_date', $currentMonth)
            ->whereYear('waste_date', $currentYear)->sum(DB::raw('quantity * cost'));
        $data['totalWasteThisMonth'] =  $totalWasteThisMonth;
        $data['total_waste_cost']    =  DB::table('waste_records')->sum(DB::raw('quantity * cost'));
        $data['wasteReduction']      =  $totalWasteThisMonth > 0 ? round((($totalWasteThisMonth - $data['total_waste_cost']) / $totalWasteThisMonth) * 100, 2) : 0;
        $data['sustainabilityScore'] =  100 - $data['wasteReduction'];
        $data['wastes']              =   DB::table('waste_records')->orderBy('id', 'desc')->get();
        return view('waste-management.view_data', $data);
    }

    public function addData(Request $request){

        if($request->post('add_waste_record')) {
            $request->validate([
                'item_id'               => 'required',
                'category_id'           => 'required',
                'waste_type'            => 'required',
                'quantity'              => 'required',
                'unit'                  => 'required',
                'cost'                  => 'required',
                'waste_date'            => 'required',
            ]);
            // Insert waste record into database
            DB::table('waste_records')->insert([
                'item_id'           => $request->input('item_id'),
                'category_id'       => $request->input('category_id'),
                'waste_type'        => $request->input('waste_type'),
                'quantity'          => $request->input('quantity'),
                'unit'              => $request->input('unit'),
                'item_price'        => $request->input('item_price'),
                'cost'              => $request->input('cost'),
                'waste_date'        => $request->input('waste_date'),
                'notes'             => $request->input('notes'),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
            return redirect()->route('waste-management.viewData')->with('success', 'Waste record added successfully');
        }

        $data["items"]              = DB::table('items')->where('status', 'Active')->get();
        $data["categories"]         = DB::table('categories')->where('status', 'Active')->get();

        return view('waste-management.add_data',$data);
    }

    public function editData(Request $request, $id){
        if($request->post('edit_waste_record')) {
            $request->validate([
                'item_id'               => 'required',
                'category_id'           => 'required',
                'waste_type'            => 'required',
                'quantity'              => 'required',
                'unit'                  => 'required',
                'cost'                  => 'required',
                'waste_date'            => 'required',
            ]);
            // Update waste record in database
            DB::table('waste_records')->where('id', $id)->update([
                'item_id'           => $request->input('item_id'),
                'category_id'       => $request->input('category_id'),
                'waste_type'        => $request->input('waste_type'),
                'quantity'          => $request->input('quantity'),
                'unit'              => $request->input('unit'),
                'item_price'        => $request->input('item_price'),
                'cost'              => $request->input('cost'),
                'waste_date'        => $request->input('waste_date'),
                'notes'             => $request->input('notes'),
                'updated_at'        => now(),
            ]);
            return redirect()->route('waste-management.viewData')->with('success', 'Waste record updated successfully');
        }

        $data["waste"]              = DB::table('waste_records')->where('id', $id)->first();
        $data["items"]              = DB::table('items')->where('status', 'Active')->get();
        $data["categories"]         = DB::table('categories')->where('status', 'Active')->get();

        return view('waste-management.edit_data',$data);
    }
}