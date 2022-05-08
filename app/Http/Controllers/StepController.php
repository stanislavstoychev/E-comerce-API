<?php

namespace App\Http\Controllers;

use App\Step;
use Illuminate\Http\Request;
use App\Http\Resources\StepResource;
class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *$part
     * @return \Illuminate\Http\Response
     */
    public function stepsbypart($part)
    {
        $steps = Step::where('part_id', $part)->get();
        return response()->json($steps);
    }

    public function index() {
        $steps = Step::orderBy('part_id')->orderBy('number')->get();
        $steps = StepResource::collection($steps);

        return response()->json($steps);
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
    public function store(Request $request) {

    }



    public function storeFile(Request $request)
    {
        $step = new Step;

    if($request->hasFile('img')) {

    $file = $request->file('img');
    $file_name = time().'.'.$file->getClientOriginalExtension();
    $upload_path = 'backend/rfi/';
    $file_url = $upload_path.$file_name;

    $file->move($upload_path, $file_name);

    $step->doc = $file_url;
}

    $step->number = $request->number;
    $step->name = $request->name;
    $step->part_id = $request->part_id;

        $step->save();

        return response()->json($step);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $step =Step::findOrFail($id);
        return response()->json($step);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function edit(Step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $step = Step::find($id);
        $step->number = $request->number;
        $step->name = $request->name;
        $step->part_id = $request->part_id;
        $image = $request->file('doc');

        if($image !== null) {

                $file = $request->file('doc');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $upload_path = 'backend/rfi/';
                $file_url = $upload_path.$file_name;

                $success = $file->move($upload_path, $file_name);

            if($success) {
                $step->doc = $file_url;
                $img = Step::find($id);
                $img_path = $img->doc;
                $done = unlink($img_path);
            }

        }
        $step->update();
        return response()->json($step);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $step = Step::find($id);
        $doc = $step->doc;
        if($doc) {
            unlink($doc);
        }

        $step->delete();
    }
}