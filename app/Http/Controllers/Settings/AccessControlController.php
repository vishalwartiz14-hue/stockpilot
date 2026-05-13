<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccessControlController extends Controller{
    public function viewData(Request $request){

        $data['access_list'] = DB::table('access')->orderBy('id','Desc')->get();
        return view('setting.access_list', $data);
    }

    public function save(Request $request)
{
    $permissions = $request->permissions;

    if (!empty($permissions)) {

        foreach ($permissions as $id => $perm) {

            DB::table('access')
                ->where('id', $id)
                ->update([

                    'view'   => $perm['view'] ?? 0,
                    'add'    => $perm['add'] ?? 0,
                    'edit'   => $perm['edit'] ?? 0,
                    'delete' => $perm['delete'] ?? 0,

                    'updated_at' => now(),
                ]);
        }
    }

    return redirect()
            ->back()
            ->with('success', 'Permissions updated successfully');
}
}
?> 