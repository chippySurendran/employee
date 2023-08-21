<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Employee,Company};
use DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::orderBy('name')->get();
        return view('employee.create',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname'   => 'required',
            'lname'   => 'required',
            'company' => 'required',
            'phone'   => 'nullable|numeric|digits:10'

        ]);

        $employee          = new Employee;
        $employee->fname   = $request->fname;
        $employee->lname   = $request->lname;
        $employee->company = $request->company;
        $employee->email   = $request->email;
        $employee->phone   = $request->phone;
        $employee->save();

        return redirect('/employees')->with('success', ' Employee Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee  = Employee::find($id);
        $companies = Company::orderBy('name')->get();
        return view('employee.edit',compact('employee','companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'fname'     => 'required',
            'lname'     => 'required',
            'company'   => 'required',
            'phone'     => 'nullable|numeric|digits:10'
        ]);

        $employee          =  Employee::find($id);
        $employee->fname   = $request->fname;
        $employee->lname   = $request->lname;
        $employee->company = $request->company;
        $employee->email   = $request->email;
        $employee->phone   = $request->phone;
        $employee->save();

        return redirect('/employees')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully!'], 200);
    }

    public function getEmployees(){
        $data = Employee::with('company_details')->select(['id', 'fname', 'lname', 'company', 'email', 'phone']);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('company_name', function ($employee) {
                    return $employee->company_details->name; // Access the related company's name
                })
            ->addColumn('action', function($row){
            $update = "<a href='" . route("employees.edit", $row->id) . "'><button class='btn btn-sm btn-info updateUser' data-id='".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' >Edit</button></a>";
            $delete = "<button class='btn btn-sm btn-danger delete-button' data-id='".$row->id."'>Delete</button>";
             return $update." ".$delete;

        }) ->make(true);

    }
}
