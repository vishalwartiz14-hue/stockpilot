<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRolesController extends Controller{
    public function viewData(Request $request){

    /*
        ==============================================
        Delete User Role start
        ==============================================
        */
        if ($request->get('delete_userRole')) {
            $delete_userRole_id         =   urldecode(base64_decode($request->get('delete_userRole')));
            DB::table('user_roles')->where('id', $delete_userRole_id)->delete();
            return redirect()->route('user-roles.viewData')->with('success', 'User Role deleted successfully');
        }        
        /*
        ==============================================
        Delete User Role End
        ==============================================
        */

        $data['userRoles'] = DB::table('user_roles')->orderBy('id','Desc')->get();

        return view('setting.user_roles.view_data', $data);
    }
    /*
    ====================================================
    INSERT START
    ====================================================
    */
    public function addData(Request $request){
        $request->validate([
            'name'          => 'required|string|max:255',
            'status'        => 'required|in:Active,Inactive',
        ]);

        DB::table('user_roles')->insert([
            'name'          =>  $request->name,
            'status'        =>  $request->status,
            'created_at'    =>  now(),
            'updated_at'    =>  now(),
        ]);

        return redirect()->back()->with('success', 'User Role added successfully');
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
        ]);

        DB::table('user_roles')->where('id', $id)->update([
                'name'              =>  $request->name,
                'status'            =>  $request->status,
                'updated_at'        =>  now(),
            ]);

        return redirect()->back()->with('success', 'User Role updated successfully');
    }
       
 
}
