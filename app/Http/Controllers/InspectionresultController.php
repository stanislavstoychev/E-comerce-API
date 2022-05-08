<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Http\Resources\UserInspectionResource;
use App\Inspectionresult;
use App\Inspection;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InspectionresultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function userallrfi()
    {
        $user = User::where('id', Auth::guard('api')->user()->id)
                //relation name 'inspections'
        ->with('allinspections.project')
        ->with('allinspections.structure')
        ->with('allinspections.part')
        ->with('allinspections.step')
        ->with('allinspections.substructure')
        ->get();
          //relation name 'inspection'->get();
           // $user->inspections()
           //->attach([1 =>  ['status' => 'approved']]);
           // - save in pivot table for user 1,2,3 insection
            // $user->inspections()->detach([1,2,3]); - remove in pivot
            // table for user 1,2,3 insection
            // $user->inspections->pivot->status
        return response()->json($user);
          // $role->pivot->created_at;
    }

    public function index()
    {
        $user = User::where('id', Auth::guard('api')->user()->id)
                //relation name 'inspections'
        ->with('activeinspections')
        ->with('activeinspections.project')
        ->with('activeinspections.structure')
        ->with('activeinspections.part')
        ->with('activeinspections.step')
        ->with('activeinspections.substructure')
        ->get();
          //relation name 'inspection'->get();
           // $user->inspections()
           //->attach([1 =>  ['status' => 'approved']]);
           // - save in pivot table for user 1,2,3 insection
            // $user->inspections()->detach([1,2,3]); - remove in pivot
            // table for user 1,2,3 insection
            // $user->inspections->pivot->status
        return response()->json($user);
          // $role->pivot->created_at;
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
     * @param  \App\inspectionresult  $inspectionresult
     * @return \Illuminate\Http\Response
     */
    public function show(inspectionresult $inspectionresult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\inspectionresult  $inspectionresult
     * @return \Illuminate\Http\Response
     */
    public function edit(inspectionresult $inspectionresult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\inspectionresult  $inspectionresult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inspectionresult $inspectionresult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\inspectionresult  $inspectionresult
     * @return \Illuminate\Http\Response
     */
    public function destroy(inspectionresult $inspectionresult)
    {
        //
    }

}