<?php
 
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = Customer::all();
            return datatables()->of($customers)
                ->addColumn('action', function ($row) {
                  
                    $html = '<button data-rowid="' . $row->id . '" class="btn btn-xs btn-danger btn-delete">Delete</button>';
                    return $html;
                })->toJson();
 
        }

        return view('customers');
    }

    public function store(Request $request)
    {         
        Customer::create($request->all());
        return ['success' => true, 'message' => 'Inserted Successfully'];
    }

    public function show($id)
    {
        return;
    }

     

    public function destroy($id)
    {
        Customer::find($id)->delete();
        return ['success' => true, 'message' => 'Deleted Successfully'];
    }
}