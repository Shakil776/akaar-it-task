<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use App\Models\Customer;
use App\Jobs\CustomerCsvData;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use File;

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

    // call procedure
    public function call_procedure()
    {

        //$getCount = DB::select('CALL sp_GetMovies()');
        $getCount = DB::select('CALL GetCounts()');
        return $getCount;
        //$getCount = DB::select("CALL sp_GetMoviesByRating('F')");
        //$query = DB::select("CALL sp_CountMoviesByRating_Inout(@T, 'M');");


        //passing dynamic data in the procedure
        $query = "CALL sp_CountMoviesByRating_Inout(@T, 'F');";

        $bind = [
            'F' => 'F'
        ];

        DB::statement($query, $bind);

        //getting the data from the variable in the procedure
        $return_query = "SELECT @T AS total";

        $result = DB::select($return_query);
        DB::statement($return_query);

        return $result;
    }


    // task 2
    public function task2()
    {
        $file = public_path('task.csv');

        $data = $this->csvToArray($file);

        foreach ($data as $key => $info) {

            $company_name = $info['Name'];
            $company_number = $info['Number'];

            $fileExtension = '.pdf';

            $path = public_path().'/File/'.$company_number.$fileExtension;     
 
            // Check Array File Exist in File
            if (File::exists($path)) {
                // Check File Already Moved in the 
                if (!File::exists(public_path($company_name).'/'.$company_number.$fileExtension)) {
                    File::makeDirectory(public_path($company_name), 0777, true, true);
                    File::move($path, public_path($company_name.'/'.$company_number.$fileExtension));
                }

            }
        }

        return 'Success';  

    }

    // helper function for convert csv to array
    public function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

}
