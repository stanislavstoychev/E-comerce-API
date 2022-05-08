<?php

namespace App\Http\Controllers;

use App\Structure;
use Illuminate\Http\Request;

class StructureController extends Controller
{
    public function all()
    {
        $structures = Structure::with('project')->orderBy('name')->get();
        return response()->json($structures);
    }

    public function index($project)
    {
        $structures = Structure::where('project_id', $project)->orderBy('name')->get();
        return response()->json($structures);
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
    public function store($project, Request $request)
    {
        $validateData = $request->validate([
            'project_id' => 'required',
            ]);


        $structure =  new Structure;
        $structure->project_id = $project;
        $structure->name = $request->structure;
        $structure->save();

        return response()->json($structure);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function show(Structure $structure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function edit(Structure $structure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $structure = Structure::find($id);
        $structure->name = $request->name;
        $structure->update();
        return response()->json($structure);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Structure::findOrFail($id)->delete();

    }
}