<?php

namespace App\Http\Controllers;

use App\Drawing;
use App\Drawingdet;
use App\Drawingfile;
use Illuminate\Http\Request;

class DrawingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function drawingversion($drawing_id)
    {
         $drawingdet = Drawingdet::where('drawing_id', $drawing_id)->get();
        return response()->json($drawingdet);
    }

    public function fileupload(Request $request)
    {
        $validateData = $request->validate([
            'drawing_number' => 'required',
           ]);
    
    $drawingdet = new Drawingdet;

    $drawingfile = new Drawingfile;

    $drawing = new Drawing;

     
    
    //Drawing
    if(Drawing::where('drawing_number', $request->drawing_number)->first()) {
        $drawing = Drawing::where('drawing_number', $request->drawing_number)->first();
    } else
    {
        $drawing->project_id=$request->project_id;
        $drawing->part_id=$request->part_id;
        $drawing->structure_id =$request->structure_id ;
        $drawing->drawing_number=$request->drawing_number;
        $drawing->title=$request->title;
        $drawing->save();
    }


    //Drawingdet
    $drawingdet = Drawingdet::where('drawing_id', $drawing->id)
                    ->where('revision', $request->revision)
                    ->where('version', $request->version)
                    ->first();

      if($drawingdet) {    

        } else {
            $drawingdet = new Drawingdet;
            $drawingdet->revision = $request->revision;        
            $drawingdet->version = $request->version;        
            $drawingdet->drawing_date = $request->drawing_date;        
            $drawingdet->status = $request->status;        
            $drawingdet->remark = $request->remark;        

            $drawingdet = $drawing->drawingsdet()->save($drawingdet);
        }

     
    


      
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
             return response()->json(['message' => 'This drawing version exists!'], 406);

        } else {
            $drawingfile = $drawingdet->drawingfiles()->save($drawingfile);
        }
    }


        return response()->json($drawingfile);
    }


    public function index()
    {
         $drawings = Drawing::with('drawingsdet')->with('drawingsdet.drawingfiles')->with('project')->with('part')->get();
        return response()->json($drawings);
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
            'part_id' => 'required',
            'title' => 'required',
            'drawing_number' => 'required',
           ]);

        $drawing = new Drawing;
        $drawing->project_id = $request->project_id;
        $drawing->part_id = $request->part_id;
        $drawing->title = $request->title;
        $drawing->drawing_number = $request->drawing_number;
        $drawing->save();

        $drawingdet = new Drawingdet;
        $drawingdet->drawing_id = $drawing->id;
        $drawingdet->revision = $request->revision;
        $drawingdet->version = $request->version;
        $drawingdet->drawing_date = $request->drawing_date;
        $drawingdet->status = $request->status;
        $drawingdet->remark = $request->remark;
        $drawingdet->save();

        $drawingfile = new Drawingfile;

            $drawingfile->
            $drawingfile->no = $request->description;
            $drawingfile->active = $request->active;
            $drawingfile->issue_id = $issue_id;

            if($request->hasFile('img')) {

                $file = $request->file('img');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $upload_path = 'backend/drawing/';
                if(!is_dir($upload_path))
                {
                    mkdir('./'.$upload_path);
                }
                $file_url = $upload_path.$file_name;

                $file->move($upload_path, $file_name);

                $issuefile->doc = $file_url;
            }


                $issuefile->save();

                return response()->json($issuefile);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\drawing  $drawing
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $drawing = Drawing::with('project')->with('part')->with('structure')->with('drawingsdet')->with('drawingsdet.drawingfiles')->with('drawingsdet.drawingtransmittals')->findOrFail($id);
        return response()->json($drawing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\drawing  $drawing
     * @return \Illuminate\Http\Response
     */
    public function edit(drawing $drawing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\drawing  $drawing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, drawing $drawing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\drawing  $drawing
     * @return \Illuminate\Http\Response
     */
    public function destroy(drawing $drawing)
    {
        //
    }
}
