<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use DB;

class EmployeeController extends Controller
{
    public function index(Request $request, $companyId)
    {
        $this->validateCompanyId($companyId);
        $employeeData = DB::table('employee')
            ->where('company', $companyId)
            ->join('companies', 'employee.company', '=', 'companies.id')
            ->select('companies.name as company_name', "companies.*", 'employee.*')
            ->get();
        $companyData = DB::table('companies')
            ->where('id', $companyId)
            ->first();
        return view(
            'employee',
            array(
                'companyData' => $companyData,
                'employees' => $employeeData
            )
        );
    }

    public function create(Request $request, $companyId)
    {
        $this->validateCompanyId($companyId);
        $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required']
        ]);
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $phone = $request->phone_number;
        $employee = new Employee();
        $employee->first_name = $first_name;
        $employee->last_name = $last_name;
        $employee->email = $email;
        $employee->phone = $phone;
        $employee->company = $companyId;
        $employee->save();
        return redirect("/company/$companyId");
    }

    private function validateCompanyId($companyId)
    {
        $companyData = DB::table('companies')
            ->where('id', $companyId)
            ->first();
        if (!$companyData)
            return abort(404, "Not found");
    }

    private function validateEmployeeId($employeeId)
    {
        $employeeData = DB::table('employee')
            ->where('id', $employeeId)
            ->first();
        if (!$employeeData)
            return abort(404, "Not found");
    }

    public function edit(Request $request, $employeeId)
    {
        $this->validateEmployeeId($employeeId);
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $phone = $request->phone_number;

        $employee = Employee::find($employeeId);
        $employee->first_name = $first_name;
        $employee->last_name = $last_name;
        $employee->email = $email;
        $employee->phone = $phone;
        $employee->save();
        return redirect()->back();
    }

    public function delete(Request $request, $employeeId)
    {
        $this->validateEmployeeId($employeeId);
        DB::table('employee')
            ->where('id', $employeeId)
            ->delete();
        return response(
            json_encode(
                array('message' => 'Employee Deleted')
            ),
            200
        );
    }
}
