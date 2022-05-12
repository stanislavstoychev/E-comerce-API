<?php

namespace App\Http\Controllers;

use App\Drawingfile;
use Illuminate\Http\Request;

class DrawingfileController extends Controller
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
     * @param  \App\drawingfile  $drawingfile
     * @return \Illuminate\Http\Response
     */
    public function show(drawingfile $drawingfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\drawingfile  $drawingfile
     * @return \Illuminate\Http\Response
     */
    public function edit(drawingfile $drawingfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\drawingfile  $drawingfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, drawingfile $drawingfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\drawingfile  $drawingfile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drawingfile = Drawingfile::findOrFail($id);
        $file = $drawingfile->file;
        if(file_exists($file)) {
            unlink($file);
        }

        $drawingfile->delete();
    }
}
