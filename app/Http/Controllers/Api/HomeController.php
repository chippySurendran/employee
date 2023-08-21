<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Employee,Company};
use Log;


class HomeController extends Controller
{
    public function home(){

        $data =[];
        $status = 'failed';
        $message = 'something went wrong. try again later';
        $error = null;
        $code = 500;

        try{

            $employees=Employee::orderBy('firstname')->with('company_details')->get();

            $status = 'success';
            $message = 'Employees details obtained';
            $data  = $employees->toArray();
            $code = 200;
        }
        catch(\Exception $e)
        {   
            Log::error('Something went wrong '.$e);
            $error = $e->getMessage();
        }

        return response()->json([
            'status'  => $status,
            'message' => $message,
            'data'    => $data,
            'error'   => $error
        ], $code);
    }
}
