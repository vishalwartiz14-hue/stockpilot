<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StorageLocationController extends Controller{

    public function viewData(Request $request){
        /*
        ==============================================
        Delete Storage Location start
        ==============================================
        */
        if ($request->get('delete_storage_location')) {
            $delete_storage_location_id         =   urldecode(base64_decode($request->get('delete_storage_location')));
            DB::table('storage_locations')->where('id', $delete_storage_location_id)->delete();
            return redirect()->route('storage-locations.viewData')->with('success', 'Storage location deleted successfully');
        }        
        /*
        ==============================================
        Delete Storage Location End
        ==============================================
        */

        $data["storage_locations"]      =   DB::table('storage_locations')->orderBy('id','Desc')->get();
        return view('setting.storage_locations.view_data',$data);
    }

    public function addData(Request $request){

        $request->validate([
            'name'          => 'required|string|max:255',
            'status'        => 'required|in:Active,Inactive',
        ]);

        DB::table('storage_locations')->insert([
            'name'          =>  $request->name,
            'status'        =>  $request->status,
            'created_at'    =>  now(),
            'updated_at'    =>  now(),
        ]);
        return redirect()->back()->with('success', 'Storage location added successfully');
    }

    public function editData(Request $request, $id){

        $request->validate([
            'name'   => 'required|string|max:255',
            'status' => 'required|in:Active,Inactive',
        ]);

        DB::table('storage_locations')
            ->where('id', $id)
            ->update([
                'name'          =>  $request->name,
                'status'        =>  $request->status,
                'updated_at'    =>  now(),
            ]);

        return redirect()->back()->with('success', 'Storage location updated successfully');
    }
}

