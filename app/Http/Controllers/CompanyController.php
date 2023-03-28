<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companies;

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
}
