<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SuppliersController extends Controller{
    public function viewData(Request $request){
        /*
        ==============================================
        Delete Supplier start
        ==============================================
        */
        if ($request->get('delete_supplier')) {
            $delete_supplier_id     =   urldecode(base64_decode($request->get('delete_supplier')));
            DB::table('suppliers')->where('id', $delete_supplier_id)->delete();
            return redirect()->route('suppliers.viewData')->with('success', 'Supplier deleted successfully');
        }        
        /*
        ==============================================
        Delete Supplier End
        ==============================================
        */
        $data['active_suppliers_count']     =   DB::table('suppliers')->where('status', 'Active')->count();
        $data['suppliers']                  =   DB::table('suppliers')->get();
        return view('suppliers.view_data', $data);
    }

    public function addData(Request $request){
        /*
        =================================================
        Insertion Start
        =================================================
        */
        if($request->post('add_supplier_btn')){
           $request->validate([            
            'supplier_name'             => 'required',
            'company_name'              => 'required',
            'email'                     => 'required|email',
            'phone'                     => 'required',
            'street_address'            => 'required',
            'city'                      => 'required',
            'state'                     => 'required',
            'supplier_category_id'      => 'required|exists:categories,id',
            'delivery_schedule'         => 'required',
            'contract_start_date'       => 'required|date',
            'contract_end_date'         => 'required',
            'sla_level'                 => 'required',
            'payment_terms'             => 'required',
            'status'                    => 'required'
        ], [], [

            'supplier_name'             => 'Supplier Name',
            'company_name'              => 'Company Name',
            'email'                     => 'Email',
            'phone'                     => 'Phone',
            'street_address'            => 'Street Address',
            'city'                      => 'City',
            'state'                     => 'State',
            'supplier_category_id'      => 'Supplier Category',  
            'delivery_schedule'         => 'Delivery Schedule',
            'contract_start_date'       => 'Contract Start Date',
            'contract_end_date'         => 'Contract End Date',
            'sla_level'                 => 'SLA Level',
            'payment_terms'             => 'Payment Terms',
            'status'                    => 'Status'
        ]);

        DB::table('suppliers')->insert([
            'name'                      => $request->supplier_name,
            'company_name'              => $request->company_name,
            'email'                     => $request->email,
            'phone_number'              => $request->phone,
            'street_address'            => $request->street_address,
            'city'                      => $request->city,
            'state'                     => $request->state,
            'category_id'               => $request->supplier_category_id,
            'delivery_schedule'         => $request->delivery_schedule,
            'contract_start_date'       => $request->contract_start_date,
            'contract_end_date'         => $request->contract_end_date,
            'sla_level'                 => $request->sla_level,
            'payment_terms'             => $request->payment_terms,
            'status'                    => $request->status,
            'created_at'                => now(),
            'updated_at'                => now(),

        ]);

        return redirect()->route('suppliers.viewData')->with('success', 'Supplier added successfully');
    }   

        $data['supplier_categories'] = DB::table('categories')->orderBy('id','Desc')->get();
        return view('suppliers.add_data', $data);
    }
    /*
    =================================================
    Inserion End
    =================================================
    */
    public function editData(Request $request, $id){
     
        $id =               urldecode(base64_decode($id));
        // dd($id);
        $supplier      =   DB::table('suppliers')->where('id', $id)->first();
        if(!$supplier){
            return redirect()->route('suppliers.viewData')->with('error', 'Supplier not found');
        }
        /*
        =================================================
        Update Start
        =================================================
        */
        if($request->post('edit_supplier_btn')){
            $request->validate([            
                'supplier_name'             => 'required',
                'company_name'              => 'required',
                'email'                     => 'required|email',
                'phone'                     => 'required',
                'street_address'            => 'required',
                'city'                      => 'required',
                'state'                     => 'required',
                'supplier_category_id'      => 'required|exists:categories,id',
                'delivery_schedule'         => 'required',
                'contract_start_date'       => 'required',
                'contract_end_date'         => 'required',
                'sla_level'                 => 'required',
                'payment_terms'             => 'required',
                'status'                    => 'required'
            ], [], [
    
                'supplier_name'             => 'Supplier Name',
                'company_name'              => 'Company Name',
                'email'                     => 'Email',
                'phone'                     => 'Phone',
                'street_address'            => 'Street Address',
                'city'                      => 'City',
                'state'                     => 'State',
                'supplier_category_id'      => 'Supplier Category',  
                'delivery_schedule'         => 'Delivery Schedule',
                'contract_start_date'       => 'Contract Start Date',
                'contract_end_date'         => 'Contract End Date',
                'sla_level'                 => 'SLA Level',
                'payment_terms'             => 'Payment Terms',
                'status'                    => 'Status'
            ]);
        
            DB::table('suppliers')->where('id', $id)->update([
                'name'                      => $request->supplier_name,
                'company_name'              => $request->company_name,
                'email'                     => $request->email,
                'phone_number'              => $request->phone,
                'street_address'            => $request->street_address,
                'city'                      => $request->city,
                'state'                     => $request->state, 
                'category_id'               => $request->supplier_category_id,
                'delivery_schedule'         => $request->delivery_schedule,
                'contract_start_date'       => $request->contract_start_date,
                'contract_end_date'         => $request->contract_end_date,
                'sla_level'                 => $request->sla_level,
                'payment_terms'             => $request->payment_terms,
                'status'                    => $request->status,
                'updated_at'                => now(),
            ]);
               
            return redirect()->route('suppliers.viewData')->with('success', 'Supplier updated successfully');
        }
        $data['supplier']            =   $supplier;
        $data['supplier_categories'] = DB::table('categories')->orderBy('id','Desc')->get();
        return view('suppliers.edit_data', $data);
    }
}