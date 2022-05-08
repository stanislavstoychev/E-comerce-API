<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use App\Inspection;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\InspectionResource;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use DB;
class InspectionController extends Controller
{
// security token
    public function __construct()
    {
        $this->middleware('JWT',
        // ['except' => ['login', 'signup']]
    );
    }
// end security token

public function all()
    {
        $rfis = InspectionResource::collection( Inspection::get()->sortByDesc('date'));

        return response()->json($rfis);
    }


public function index()
    {
        $rfis = InspectionResource::collection( Inspection::orderByDesc('date')->orderBy('project_id')->get());

        return response()->json($rfis);
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
        $validateData = $request->validate([
            'project_id' => 'required',
            'structure_id' => 'required',
            'part_id' => 'required',
            'substructure_id' => 'required',
            'step_id' => 'required',
            'date' => 'required',
            'time' => 'required',
            'inspectors_id' => 'required',
           ]);

        $inspection = new Inspection;
        $inspection->project_id = $request->project_id;
        $inspection->structure_id = $request->structure_id;
        $inspection->substructure_id = $request->substructure_id;
        $inspection->part_id = $request->part_id;
        $inspection->step_id = $request->step_id;
        $inspection->date = $request->date;
        $inspection->time = $request->time;
        $inspection->status = $request->status;
        $inspection->user_name = Auth::guard('api')->user()->name;

        $inspection->save();

        foreach($request->inspectors_id as $user_id) {
            $inspection->users()->attach([$user_id =>  ['status' => 'Open', 'remark' => '---']]);
            //attach - attach many users vs sync
        }


        return response()->json($inspection);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rfi = Inspection::findOrFail($id);
        return new InspectionResource($rfi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function edit(Inspection $inspection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['date'] = $request->date;
        $data['time'] = $request->time;
        $data['status'] = $request->status;
        $data['remark'] = $request->remark;
        $date = new DateTime("now", new DateTimeZone('Europe/Sofia') );
        $datedm = $date->format('d-m-Y');
        $dateh = $date->format('H:i:s');

        Inspection::where('id',$id)->update($data);
        $inspection  = Inspection::findOrFail($id);
        if($data['status'] = 'Cancel' || $data['status'] = 'Open') {
            $ids = $inspection->users()->allRelatedIds();
            foreach ($ids as $idd){
            $inspection->users()->updateExistingPivot($idd,  ['status' => $request->status,
            'date' => $datedm,
            'time' => $dateh
        ]);
        }
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inspection  $inspection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

          DB::table('inspections')->where('id',$id)->delete();
}

public function inspection_user(Request $request, $inspection_id, $user_id) {
    $data = array();
    $data['date'] = $request->date;
    $data['time'] = $request->time;
    $data['status'] = $request->status;
    $data['remark'] = $request->remark;
    $date = new DateTime("now", new DateTimeZone('Europe/Sofia') );
    $datedm = $date->format('d-m-Y');
    $dateh = $date->format('H:i:s');

    $inspection  = DB::table('inspections')->where('id',$inspection_id)->update($data);
    $user = User::findOrFail($user_id);
    if ($request->status == 'Cancel' || $request->status == 'Open' ) {
    $user->inspections()->attach($inspection_id, [
        'status' => $request->status,
        'date' => $datedm,
        'time' => $dateh
    ]);}

    return response()->json($user);
}

public function rfiInspector($id) {
    $rfi = Inspection::findOrFail($id);
    $users = $rfi->users;

    return response()->json($users);
}

public function destroyInspector($rfi_id, $inspector_id) {
    $inspection = Inspection::findOrFail($rfi_id);
    $inspection->users()->detach(User::findOrFail($inspector_id));
}

public function saveRfi($id, Request $request) {
    $user = User::findOrFail(Auth::guard('api')->user()->id);
    $date = new DateTime("now", new DateTimeZone('Europe/Sofia') );
    $datedm = $date->format('d-m-Y');
    $dateh = $date->format('H:i:s');

    // many to many
    $user->inspections()->updateExistingPivot(
        $id, [
            'remark' => $request->remark,
            'status' => $request->status,
            'date' => $datedm,
            'time' => $dateh
        ]
    );

}
}