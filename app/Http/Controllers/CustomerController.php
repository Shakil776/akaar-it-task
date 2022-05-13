<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use App\Models\Customer;
use App\Jobs\CustomerCsvData;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    // csv records import
    public function import_csv_data(Request $request)
    {
        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'csv' => 'required|mimes:csv,txt'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if( $request->has('csv')) {
                $csv = file($request->csv);
                $chunks = array_chunk($csv, 500);
                $header = [];
                $batch  = Bus::batch([])->dispatch();

                foreach ($chunks as $key => $chunk) {
                    $data = array_map('str_getcsv', $chunk);
                    if($key == 0){
                        $header = $data[0];
                        unset($data[0]);
                    }
                    $batch->add(new CustomerCsvData($data, $header));
                }
                return back();
            }
            return back()->with('message', 'Please Upload CSV file.');
        }

        $customers = DB::table('customers')->paginate(50);
        return view('show', compact('customers'));
    }
}
