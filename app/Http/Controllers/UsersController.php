<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller{
    
    public function viewData(Request $request){
        /*
        ==============================================
        Delete User start
        ==============================================
        */
        if ($request->get('delete_user')) {
            $delete_user_id         =   urldecode(base64_decode($request->get('delete_user')));
            DB::table('users')->where('id', $delete_user_id)->delete();
            return redirect()->route('users.viewData')->with('success', 'User deleted successfully');
        }        
        /*
        ==============================================
        Delete User End
        ==============================================
        */
       $data['users'] =  DB::table('users')->orderBy('id','Desc')->get();
 
        return view('users.view_data', $data);
    }

    public function addData(Request $request){
    /*
    ====================================================
    Insertion start
    ====================================================
    */

    if ($request->post('add_user_button')) {

        $request->validate([
            'full_name'      => 'required|max:255',
            'email'          => 'required|email|unique:users,email',
            'type'           => 'required',
            'password'       => 'required|min:6',
            'street_address' => 'required',
            'status'         => 'required',
        ], [], [

            'full_name'      => 'Full Name',
            'email'          => 'Email Address',
            'type'           => 'User Role',
            'password'       => 'Password',
            'street_address' => 'Address',
            'status'         => 'Status',

        ]);

        DB::table('users')->insert([

            'name'           => $request->full_name,
            'email'          => $request->email,
            'phone_number'   => $request->phone_number,
            'type'           => $request->type,
            'password'       => Hash::make($request->password),
            'street_address' => $request->street_address,
            'status'         => $request->status,
            'created_at'     => now(),
            'updated_at'     => now(),

        ]);

        return redirect()->route('users.viewData')->with('success', 'User added successfully');
    }

        /*
        ====================================================
        Insertion End
        ====================================================
        */
        $data['userRoles'] = DB::table('user_roles')->where('status', 'Active')->get();
        return view('users.add_user', $data);
    }

   public function editData(Request $request){
    $encodedId              =   $request->segment(2);
    $user_id                =   base64_decode(urldecode($encodedId));

        if ($request->post('edit_user_button')) {

            $request->validate([
                'full_name'      => 'required|max:255',
                'email'          => 'required|email',
                'type'           => 'required',
                'street_address' => 'required',
                'status'         => 'required',
            ], [], [

                'full_name'      => 'Full Name',
                'email'          => 'Email Address',
                'type'           => 'User Role',
                'street_address' => 'Address',
                'status'         => 'Status',
            ]);

            DB::table('users')->where('id', $user_id)->update([

                    'name'           =>     $request->full_name,
                    'email'          =>     $request->email,
                    'phone_number'   =>     $request->phone_number,
                    'type'           =>     $request->type,
                    'street_address' =>     $request->street_address,
                    'status'         =>     $request->status,
                    'updated_at'     =>     now(),
                ]);
            if ($request->password) {
                DB::table('users')->where('id', $user_id)->update(['password' => Hash::make($request->password),
                ]);
            }
            return redirect()->route('users.viewData')->with('success', 'User updated successfully');
        }

        /*
        ====================================================
        Edit Page Load
        ====================================================
        */
        $data['userRoles']          =   DB::table('user_roles')->where('status', 'Active')->get();
        $data['user']               =   DB::table('users')->where('id', $user_id)->first();
        return view('users.edit_user', $data);
    }
    
}