<?php

namespace App\Http\Controllers;

use App\DrawingdetDrawingtrnsmittal;
use App\Drawingtransmittal;
use App\Drawingdet;
use App\Drawingfile;
use App\Drawing;
use Illuminate\Http\Request;

class DrawingtransmittalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function drawingadd($id, Request $request)
    {   
        $validateData = $request->validate([
            'drawing_id' => 'required',
            'drawingdet_id' => 'required',
           ]);

        $drawingdet_id = $request->drawingdet_id;

        $drawingtransmittal = Drawingtransmittal::find($id);
        $drawingtransmittal->drawingsdet()->attach($drawingdet_id);

        return response()->json();
    }

    public function index()
    {
        $transmittals = Drawingtransmittal::get();

        return response()->json($transmittals);
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
            'no' => 'required',
            'project_id' => 'required',
           ]);

        $transmittal = new Drawingtransmittal;
        $transmittal->no = $request->no;
        $transmittal->project_id = $request->project_id;
        $transmittal->in_out = $request->in_out;
        $transmittal->subject = $request->subject;
        $transmittal->sender = $request->sender;
        $transmittal->recepient = $request->recepient;
        $transmittal->came_by = $request->came_by;
        $transmittal->date = $request->date;
        $transmittal->use_for = $request->use_for;
        $transmittal->box = $request->box;
        $transmittal->folder = $request->folder;
        $transmittal->save();

        return response()->json($transmittal);
    }

    /**drawingsdet
     * Display the specified resource.
     *
     * @param  \App\drawingtransmittal  $drawingtransmittal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transmittal = Drawingtransmittal::with('drawingsdet')->with('project')->with('drawingsdet.drawing')->with('drawingsdet.drawingfiles')->with('drawingsdet.drawing.part')->with('drawingsdet.drawing.structure')->with('drawingsdet.drawing.project')->findOrFail($id);
        return response()->json($transmittal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\drawingtransmittal  $drawingtransmittal
     * @return \Illuminate\Http\Response
     */
    public function edit(drawingtransmittal $drawingtransmittal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\drawingtransmittal  $drawingtransmittal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transmittal = Drawingtransmittal::findOrFail($id);

        $data = array();
        $data['no'] = $request->no;
        $data['project_id'] = $request->project_id;
        $data['in_out'] = $request->in_out;
        $data['sender'] = $request->sender;
        $data['recepient'] = $request->recepient;
        $data['subject'] = $request->subject;
        $data['came_by'] = $request->came_by;
        $data['date'] = $request->date;
        $data['use_for'] = $request->use_for;
        $data['box'] = $request->box;
        $data['folder'] = $request->folder;

        $transmittal->update($data);

        return response()->json($transmittal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\drawingtransmittal  $drawingtransmittal
     * @return \Illuminate\Http\Response
     */
    public function destroydrawing($transmittal_id, $drawingdet_id)
    {
        $transmittal = Drawingtransmittal::find($transmittal_id);

        //remove record from pivot table
        $transmittal->drawingsdet()->detach($drawingdet_id);

        return response()->json(['success' => 'deleted'], 200);
    }
    public function destroy($id)
    {
        $transmittal = Drawingtransmittal::find($id);
        
        //remove records form pivot table for relevant transmittal
        $drawingdet = $transmittal->drawingsdet()->get();
        $transmittal->drawingsdet()->detach($drawingdet);
        
        //delete transmittal record
        $transmittal->delete();

        return response()->json(['success' => 'deleted'], 200);
    }
}
