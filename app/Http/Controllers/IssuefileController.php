<?php

namespace App\Http\Controllers;

use App\Issuefile;
use Illuminate\Http\Request;

class IssuefileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($issue_id)
    {
        $files = Issuefile::where('issue_id', $issue_id)->get();
        return response()->json($files);
    }

    public function file($file_id)
    {
        $file = Issuefile::find($file_id);
        return response()->json($file);
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
    public function store(Request $request, $issue_id)
    {
    $issuefile = new Issuefile;

    if($request->hasFile('img')) {

    $file = $request->file('img');
    $file_name = time().'.'.$file->getClientOriginalExtension();
    $upload_path = 'backend/issue/';
    if(!is_dir($upload_path))
    {
        mkdir('./'.$upload_path);
    }
    $file_url = $upload_path.$file_name;

    $file->move($upload_path, $file_name);

    $issuefile->doc = $file_url;
}

    $issuefile->description = $request->description;
    $issuefile->active = $request->active;
    $issuefile->issue_id = $issue_id;

        $issuefile->save();

        return response()->json($issuefile);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Issuefile  $issuefile
     * @return \Illuminate\Http\Response
     */
    public function show(Issuefile $issuefile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issuefile  $issuefile
     * @return \Illuminate\Http\Response
     */
    public function edit(Issuefile $issuefile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Issuefile  $issuefile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $issuefile = Issuefile::find($id);
        $issuefile->description = $request->description;
        $issuefile->active = $request->active;
        $image = $request->file('doc');

        if($image !== null) {

                $file = $request->file('doc');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $upload_path = 'backend/issue/';
                $file_url = $upload_path.$file_name;

                $success = $file->move($upload_path, $file_name);

            if($success) {
                $issuefile->doc = $file_url;
                $img = Issuefile::find($id);
                $img_path = $img->doc;
                $done = unlink($img_path);
            }

        }
        $issuefile->update();
        return response()->json($issuefile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Issuefile  $issuefile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $issuefile = Issuefile::find($id);
        $doc = $issuefile->doc;
        if($doc) {
            unlink($doc);
        }

        $issuefile->delete();
    }
}