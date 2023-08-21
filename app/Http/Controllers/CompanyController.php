<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Storage;
use File;
use DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $company          = new Company;
        $company->name    = $request->name;
        $company->email   = $request->email;
        $company->website = $request->website;
        if($file = $request->file('logo')) {
            $stoage_path = storage_path('app/public/images/');
            if(!is_dir($stoage_path)){
                mkdir($stoage_path, 0777, true);
            }
            $Image          = $request->file('logo');
            $newImageName   = uniqid() . '.' . $Image->getClientOriginalExtension();
            $stoage_path    = $Image->storeAs('public/images', $newImageName);
            $company->logo  = $newImageName;
        }
        $company->save();
        return redirect('/companies')->with('success','Company added successfully!');
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
       $company = Company::find($id);
       return view('company.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $company            = Company::find($id);
        $company->name      = $request->name;
        $company->email     = $request->email;
        $company->website   = $request->website;
        if($file = $request->file('logo')) {
            $Image          = $request->file('logo');
            $newImageName   = uniqid() . '.' . $Image->getClientOriginalExtension();
            $stoage_path    = $Image->storeAs('public/images', $newImageName);
            $company->logo  = $newImageName;
        }
        $company->save();
        return redirect('/companies')->with('success', 'Company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }
        $company->delete();

        return response()->json(['message' => 'Company deleted successfully!'], 200);
    }

    public function getCompany()
    {
        $data = Company::select(['id', 'name', 'logo', 'email', 'website']);

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
             $update_Button = "<a href='" . route("companies.edit", $row->id) . "'><button class='btn btn-sm btn-info updateUser' data-id='".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' >Edit</button></a>";
             $delete_Button = "<button class='btn btn-sm btn-danger delete-button' data-id='".$row->id."'>Delete</button>";
             return $update_Button." ".$delete_Button;
        }) ->make(true);
    }
}
