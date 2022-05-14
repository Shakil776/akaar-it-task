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
    public function import_csv_data(Customer $customer, Request $request)
    {
        if ($request->isMethod('POST')) 
        {

            $validator = Validator::make($request->all(), [
                'csv' => 'required|mimes:csv,txt'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if( $request->has('csv')) {
                $csv = file($request->csv);
                $chunks = array_chunk($csv, 100);
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


        if($request->ajax())
        {
            $data = $request->all();
            $customers = Customer::query();

            if (isset($data['branch_filter']) && !empty($data['branch_filter'])) {
                if ($data['branch_filter'] == '1') {
                    $customers->where('branch_id', $data['branch_filter']);
                }
                elseif ($data['branch_filter'] == '2') {
                    $customers->where('branch_id', $data['branch_filter']);
                }
            }

            if (isset($data['gender_filter']) && !empty($data['gender_filter'])) {
                if ($data['gender_filter'] == 'M') {
                    $customers->where('gender', $data['gender_filter']);
                }
                elseif ($data['gender_filter'] == 'F') {
                    $customers->where('gender', $data['gender_filter']);
                }
            }
            

            $customers = $customers->paginate(100);

            return view('table', compact('customers'));
        }
        else
        {
            $customers = Customer::orderBy('id', 'DESC')->paginate(100);   
            return view('show', compact('customers'));
        }
    }


    // task 2
    public function task2()
    {
        // Array Which Store Data
        $companies = [];

        // Read CSV file
        if (($open = fopen(public_path('task.csv'), "r")) !== FALSE) {

            // Store File in array 
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                $companies[] = $data;
            }
            
            // close The File
            fclose($open);
        }


        // $f_pointer=fopen(public_path('task.csv'), "r"); // file pointer

        // while(! feof($f_pointer)){
        //     $ar=fgetcsv($f_pointer);
            
        //     echo $ar[0] .'---'. $ar[1];
        //     echo "<br>";
        // }


        // die;

        // Show output in Array

        // return $companies;



        // Access The Array 
        foreach ($companies as $companie ) {
            return $companie;
            // code
            $companieName = $companie[0];
            $companieFile = $companie[1];

            // Remove space from companie name
            $companieName = str_replace(' ', '_', $companieName);

            echo "<pre>";

            print_r($companieName); die();

            $fileExtension = '.pdf';

            $path = public_path().'/File/'.$companieFile.$fileExtension;

            

            // Check Array File Exist in File
            // if (file_exists($path)) {
            //     // Check File Already Moved in the 
            //     if (!file_exists('result/'.$companieName.'/'.$companieFile.$fileExtension)) {

            //         // Code For File Move or Store


            //     }
            // }
        }
    }

}
