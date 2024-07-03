<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Company::orderBy('id', 'DESC');
            $companyTypes = config('constants.company_types');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('company_type', function ($data) use ($companyTypes) {
                    return $companyTypes[$data->company_type] ?? $data->company_type;
                })
                ->addColumn('company_logo', function ($row) {
                    $url = asset('storage/images/' . $row->company_logo); 
                    return '<img src="' . $url . '" alt="Company Logo" width="50" height="50">';
                })
                ->addColumn('action', function ($data) {
                    $btn = '<div class="d-flex">
                            <button type="button" class="btn btn-sm btn-light border" onclick="editCompany(' . $data->id . ')">
                            <i class="fa fa-solid fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-light border ml-2" data-bs-toggle="modal" data-bs-target="#deleteCompanyData" onclick="deleteCompany(' . $data->id . ')"><i class="fa fa-trash"></i></button>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['company_logo', 'action'])
                ->make(true);
        }
        $pageTitle = "Company Details";
        return view('superadmin.company.index', compact('pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'                => 'required|string|max:255',
            'company_type'        => 'required|string',
            'price'               => 'required|numeric',
            'description'         => 'required|string',
            'company_logo'        => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ensure file is an image
        ]);
    
        $filename = "";
    
        if ($request->hasFile('company_logo')) {
            $filename = time() . '.' . $request->file('company_logo')->getClientOriginalExtension();
            $request->file('company_logo')->storeAs('images', $filename, 'public');
        }
    
        $company = Company::create([
            'company_name'         => $request->name,
            'company_type'         => $request->company_type,
            'price'                => $request->price,
            'company_description'  => $request->description,
            'company_logo'         => $filename
        ]);
    
        return response()->json([
            'success' => true,
            'response' => $company,
            'message' => 'Company added successfully.'
        ], 200);
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Company::whereId($id)->first();
        return response()->json([
            'success' => true,
            'response' => $data,
            'message' =>  'Company details.'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id'                  => 'required|exists:companies,id',
            'company_name'        => 'sometimes|string|max:255',
            'price'               => 'sometimes|numeric',
            'company_type'        => 'sometimes|string',
            'description'         => 'sometimes|string',
            'company_logo'        => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $company = Company::find($request->id);

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found.'
            ], 404);
        }

        // Delete the old image if a new one is uploaded
        if ($request->hasFile('company_logo')) {
            if ($company->company_logo) {
                File::delete(public_path('images/' . $company->company_logo));
            }
            $image = $request->file('company_logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $imageName, 'public');
            $company->company_logo = $imageName;
        }

        $company->company_name = $request->company_name ? $request->company_name : $company->company_name;
        $company->price = $request->price ? $request->price : $company->price;
        $company->company_type = $request->company_type ? $request->company_type : $company->company_type;
        $company->company_description = $request->description ? $request->description : $company->company_description;

        $company->save();

        return response()->json([
            'success' => true,
            'response' => $company,
            'message' => 'Company updated successfully.'
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company =  Company::where('id', $request->id)->delete();
        return response()->json([
            'success' => true,
            'response' => $company,
            'message' =>  'Company deleted successfully.'
        ], 200);
    }
}
