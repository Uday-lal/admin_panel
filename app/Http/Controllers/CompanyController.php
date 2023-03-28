<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companies;
use DB;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $companies = Companies::all();
        return view('index', array(
            'companies' => $companies
        ));
    }

    public function create(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'website' => ['required'],
            'logo' => 'mimes:ico,svg,jpg,png,jpeg|max:2045'
        ]);
        $name = $request->name;
        $email = $request->email;
        $website = $request->website;
        $discription = $request->discription;
        $logo = $request->file('logo');
        if ($logo) {
            $fileName = time() . "_" . $logo->getClientOriginalName();
            $filePath = $logo->storeAs('uploads', $fileName, 'public');
        } else {
            $filePath = null;
        }
        $companies = new Companies();
        $companies->name = $name;
        $companies->email = $email;
        $companies->logo = $filePath;
        $companies->website = $website;
        $companies->discription = $discription;
        $companies->save();
        return redirect("/");
    }

    private function validateCompanyId($companyId)
    {
        $companyData = DB::table('companies')
            ->where('id', $companyId)
            ->first();
        if (!$companyData)
            return abort(404, "Not found");
    }

    public function edit(Request $request, $companyId)
    {
        $this->validateCompanyId($companyId);
        $name = $request->name;
        $email = $request->email;
        $website = $request->website;
        $discription = $request->discription;
        $logo = $request->file('logo');
        $companies = Companies::find($companyId);
        if ($logo) {
            $fileName = time() . "_" . $logo->getClientOriginalName();
            $filePath = $logo->storeAs('uploads', $fileName, 'public');
        } else {
            $filePath = $companies->logo;
        }
        $companies->name = $name;
        $companies->email = $email;
        $companies->logo = $filePath;
        $companies->website = $website;
        $companies->discription = $discription;
        $companies->save();
        return redirect("/");
    }

    public function delete(Request $request, $companyId)
    {
        $this->validateCompanyId($companyId);
        // DB::select('DELETE FROM companies WHERE constraint');
        DB::select("DELETE FROM companies WHERE id = $companyId");
        return response(
            json_encode(
                array('message' => 'Company Deleted')
            ),
            200
        );
    }
}
