<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function viewData(Request $request)
    {

     /*
        ==============================================
        Delete Category start
        ==============================================
        */
        if ($request->get('delete_category')) {
            $delete_category_id         =   urldecode(base64_decode($request->get('delete_category')));
            DB::table('categories')->where('id', $delete_category_id)->delete();
            return redirect()->route('categories.viewData')->with('success', 'Category deleted successfully');
        }        
        /*
        ==============================================
        Delete Category End
        ==============================================
        */

        $data["categories"] = DB::table('categories')->orderBy('id','Desc')->get();
        return view('setting.categories.view_data',$data);
    }

    public function addData(Request $request){
        $request->validate([
            'name'          => 'required|string|max:255',
            'status'        => 'required|in:Active,Inactive',
        ]);

        DB::table('categories')->insert([
            'name'          =>  $request->name,
            'status'        =>  $request->status,
            'created_at'    =>  now(),
            'updated_at'    =>  now(),
        ]);

        return redirect()->back()->with('success', 'Category added successfully');
    }

    public function editData(Request $request, $id)
{
    $request->validate([
        'name'   => 'required|string|max:255',
        'status' => 'required|in:Active,Inactive',
    ]);

    DB::table('categories')->where('id', $id)->update([
            'name'          => $request->name,
            'status'        => $request->status,
            'updated_at'    => now(),
        ]);

    return redirect()->back()->with('success', 'Category updated successfully');
}
}

