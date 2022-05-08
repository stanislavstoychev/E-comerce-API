<?php

namespace App\Http\Controllers;

use App\Substructure;
use Illuminate\Http\Request;

class SubstructureController extends Controller
{
    public function all() {
        $substructures = Substructure::with('structure')->with('structure.project')->with('part')->get();
        return response()->json($substructures);
    }

    public function index($structure)
    {
        $substructures = Substructure::where('structure_id', $structure)->with('part')->get();
        return response()->json($substructures);
    }

    public function partStructure($part, $structure) {
        $substructures = Substructure::
                where('structure_id', $structure)
                ->where('part_id', $part)
                ->get();
        return response()->json($substructures);
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
    public function store(Request $request, $part, $structure)
    {
        $validateData = $request->validate([
            'part_id' => 'required',
            'structure_id' => 'required',
            ]);


        $substructure =  new Substructure;
        $substructure->structure_id = $request->structure_id;
        $substructure->part_id = $request->part_id;
        $substructure->name = $request->substructure;
        $substructure->save();

        return response()->json($substructure);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Substructure  $substructure
     * @return \Illuminate\Http\Response
     */
    public function show(Substructure $substructure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Substructure  $substructure
     * @return \Illuminate\Http\Response
     */
    public function edit(Substructure $substructure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Substructure  $substructure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $substructure = Substructure::find($id);
        $substructure->name = $request->name;
        $substructure->update();
        return response()->json($substructure);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Substructure  $substructure
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Substructure::findOrFail($id)->delete();
    }
}