<?php

namespace App\Http\Controllers;

use App\Subcontractor;
use Illuminate\Http\Request;
use Image;

class SubcontractorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcontractor = Subcontractor::all();
        return response()->json($subcontractor);

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
            'name' => 'required|unique:subcontractors',
            ]);

            $subcontractor = new Subcontractor;

        if($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/subcontractor/';
            $image_url = $upload_path.$name;

            $img->save($image_url);
            $subcontractor->photo = $image_url;
        }

        $subcontractor->name = $request->name;
        $subcontractor->abbreviation = $request->abbreviation;
        $subcontractor->part_id = $request->part_id;
        $subcontractor->foreman = $request->foreman;
        $subcontractor->phone = $request->phone;
        $subcontractor->email = $request->email;

        $subcontractor->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcontractor  $subcontractor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subcontractor = Subcontractor::find($id);

        return response()->json($subcontractor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcontractor  $subcontractor
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcontractor $subcontractor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcontractor  $subcontractor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['part_id'] = $request->part_id;
        $data['abbreviation'] = $request->abbreviation;
        $data['foreman'] = $request->foreman;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $image = $request->newphoto;

        if($image) {
            $position = strpos($request->newphoto, ';');
            $sub = substr($request->newphoto, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($request->newphoto)->resize(240, 200);
            $upload_path = 'backend/subcontractor/';
            $image_url = $upload_path.$name;

            $success = $img->save($image_url);

            if($success) {
                $data['photo'] = $image_url;
                $img = Subcontractor::find($id);
                $img_path = $img->photo;
                if($img_path) {
                $done = unlink($img_path);
            }
            }

        }
        Subcontractor::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcontractor  $subcontractor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcontractor = Subcontractor::find($id);
        $photo = $subcontractor->photo;
        if($photo) {
            unlink($photo);
        }

        $subcontractor->delete();
    }
}