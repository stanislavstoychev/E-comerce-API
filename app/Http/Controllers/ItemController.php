<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use Image;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = ItemResource::collection(Item::all());
        // $item = Item::all();
        return response()->json($item);
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
            'name' => 'required',
        ]);

        $item = new Item;

        if($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($request->image)->resize(240, 200);
            $upload_path = 'backend/item/';
            $image_url = $upload_path.$name;

            $img->save($image_url);
            $item->image = $image_url;
        }

        $item->part_id = $request->part_id;
        $item->name = $request->name;
        $item->code = $request->code;
        $item->buying_price = $request->buying_price;
        $item->selling_price = $request->selling_price;
        $item->subcontractor_id = $request->subcontractor_id;
        $item->quantity = $request->quantity;
        $item->root = $request->root;
        $item->buying_date = $request->buying_date;


        $item->save();

    }


    public function show($id)
    {
        $item = Item::find($id);

        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] = $request->name;
        $data['part_id'] = $request->part_id;
        $data['code'] = $request->code;
        $data['buying_price'] = $request->buying_price;
        $data['selling_price'] = $request->selling_price;
        $data['subcontractor_id'] = $request->subcontractor_id;
        $data['image'] = $request->image;
        $data['quantity'] = $request->quantity;
        $data['root'] = $request->root;
        $data['buying_date'] = $request->buying_date;
        $image = $request->newimage;

        if($image) {
            $position = strpos($request->newimage, ';');
            $sub = substr($request->newimage, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().".".$ext;
            $img = Image::make($request->newimage)->resize(240, 200);
            $upload_path = 'backend/item/';
            $image_url = $upload_path.$name;

            $success = $img->save($image_url);

            if($success) {
                $data['image'] = $image_url;
                $img = Item::find($id);
                $img_path = $img->image;
                if($img_path) {
                    $done = unlink($img_path);
                }
            }

        }
        Item::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $item =  Item::find($id);

       if($item->image) {
           unlink($item->image);
       }

       $item->delete();
    }
}
