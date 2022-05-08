<?php

namespace App\Http\Controllers;

use App\Salary;
use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paid(Request $request, $id) {
        $validateData = $request->validate([
            'salary-month' => 'requred',

        ]);
        $month = $request->salary_month;
        $check = DB::table('salaries')->where('employee_id', $id)->where('salary_month', $month)->first();

        if($check) {
            return response()->json('Salary already paid');
        } else {


            $data = array();
            $data['employee_id'] = $id;
            $data['amount'] = $request->sallery;
            $data['salary_date'] = date('d/m/y');
            $data['salary_month'] = $month;
            $data['salary_year'] = date('Y');

            DB::table('salaries')->insert($data);
        }
        }

        public function allSalary() {
            $salary = DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();
            return response()->json($salary);

        }

        public function viewSalary($id) {
            $month = $id;
            $view = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name', 'salaries.*')
            ->where('salaries.salary_month', $month)
            ->get();

            return response()->json($view);
        }

        public function editSalary($id) {
            $view = DB::table('salaries')
            ->join('employees', 'salaries.employee_id', 'employees.id')
            ->select('employees.name','employees.email', 'salaries.*')
            ->where('salaries.id', $id)
            ->first();

            return response()->json($view);
        }

    public function updateSalary(Request $request, $id) {
        $data = array();
        $data['employee_id'] = $request->employee_id;
        $data['amount'] = $request->amount;
        $data['salary_month'] = $request->salary_month;

        DB::table('salaries')->where('id', $id)->update($data);


    }

    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        //
    }
}