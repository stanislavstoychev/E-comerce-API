<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Image;
use DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
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
            'name' => 'required|unique:projects',
            ]);

            $project = new Project;

        if($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/project/';
            $image_url = $upload_path.$name;

            $img->save($image_url);
            $project->photo = $image_url;
        }

        $project->name = $request->name;
        $project->abreviation = $request->abreviation;
        $project->address = $request->address;
        $project->cost = $request->cost;
        $project->start_date = $request->start_date;
        $project->name = $request->name;

        $project->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return response()->json($project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            ]);
        $data = array();
        $data['name'] = $request->name;
        $data['address'] = $request->address;
        $data['cost'] = $request->cost;
        $data['start_date'] = $request->start_date;
        $image = $request->newphoto;

        if($image) {
            $position = strpos($request->newphoto, ';');
            $sub = substr($request->newphoto, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($request->newphoto)->resize(240, 200);
            $upload_path = 'backend/project/';
            $image_url = $upload_path.$name;

            $success = $img->save($image_url);

            if($success) {
                $data['photo'] = $image_url;
                $img = Project::find($id);
                $img_path = $img->photo;
                
                if($img_path) {
                $done = unlink($img_path);
                }
            }

        }
        Project::find($id)->update($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $photo = $project->photo;
        if($photo) {
            unlink($photo);
        }

        $project->delete();
    }
}