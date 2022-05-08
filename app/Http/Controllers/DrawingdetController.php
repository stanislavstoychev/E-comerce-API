<?php

namespace App\Http\Controllers;

use App\Drawingdet;
use App\Drawingfile;
use App\Drawing;
use Illuminate\Http\Request;

class DrawingdetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     * @param  \App\drawingdet  $drawingdet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $drawingdet = Drawingdet::with('drawingfiles')->with('drawing')->findOrFail($id);

        return response()->json($drawingdet);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\drawingdet  $drawingdet
     * @return \Illuminate\Http\Response
     */
    public function edit(drawingdet $drawingdet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\drawingdet  $drawingdet
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
    

    $drawingfile = new Drawingfile;


     //Drawingdet
    $drawingdet = Drawingdet::findOrFail($id);

          
            $drawingdet->revision = $request->revision;        
            $drawingdet->version = $request->version;        
            $drawingdet->drawing_date = $request->drawing_date;        
            $drawingdet->status = $request->status;        
            $drawingdet->remark = $request->remark;        

            $drawingdet->save();
        
    
    
    //Drawing
        $drawing = Drawing::findOrFail($drawingdet->drawing_id);
        $drawing->project_id=$request->project_id;
        $drawing->part_id=$request->part_id;
        $drawing->structure_id =$request->structure_id ;
        $drawing->drawing_number=$request->drawing_number;
        $drawing->title=$request->title;
        $drawing->save();
     



  
      
    $drawingfile = new Drawingfile;
    if($request->hasFile('img')) {

    $file = $request->file('img');
    $extension = $file->getClientOriginalExtension();
    $file_name =  $drawing->drawing_number.'_r'.$drawingdet->revision.'v'.$drawingdet->version.'_'.time().'.'.$extension;
    $upload_path = 'backend/drawing/';
    
    if(!is_dir($upload_path)) {
        mkdir('./'.$upload_path);
    }

    $file_url = $upload_path.$file_name;

    $file->move($upload_path, $file_name);

    $drawingfile->extension = $extension;
    $drawingfile->file = $file_url;

        if(Drawingfile::where('drawingdet_id', $drawingdet->id)
                        ->where('extension', $extension)->first()) {
             return response()->json(["message" => "This drawing version exists!"], 406);

        } else {
            $drawingfile = $drawingdet->drawingfiles()->save($drawingfile);
        }
    }


        return response()->json($drawingfile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\drawingdet  $drawingdet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //Drawing delete
        $drawingdet = drawingdet::findOrFail($id);

//Transmittal file  
    $drawingtransmittals = $drawingdet->drawingtransmittals;
    if($drawingtransmittals) {
          
         //Drawing file  
        $drawingfiles = $drawingdet->drawingfiles;
        foreach ($drawingfiles as $drawingfile) {
            $file = $drawingfile->file;
            if(file_exists($file)) {
                unlink(trim($file));
            }
            $drawingfile->delete();
        }
        $drawingdet->delete();

    } else {
        return response()->json(['message'=>'This drawing is a part of transmittal!!!'], 406);
    }

    }
}
