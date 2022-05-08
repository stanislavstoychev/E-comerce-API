<?php

namespace App\Http\Controllers;

use App\Task;
use App\Task_pic;
use App\TemproraryFile;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class TaskPicController extends Controller
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
public function storefp(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task_no = $task->schedule_id;

        $file = $request->file('file');
        // temproary folder for chunks files - \storage\app\chunks
        $path = Storage::disk('public')->path(`chunks/{$file->getClientOriginalName()}`);

        File::append($path, $file->get());

        if ($request->has('is_last') && $request->boolean('is_last')) {

            //Date time created ['DateTimeOriginal']
            
            $file_data = exif_read_data($file);
            $file_created = date('Y-m-d', $file_data['FileDateTime']);

            //End - Date time created
            
            $name = $task_no.'_'.$file_created.'-'.basename($path, '.part');
            //moving file to -  \storage\app\tasks
            // storage_path('app/'.$file_url)
            $upload_path = "tasks/".$task->project_id.'-'.$task->schedule_id.'/';
            $file_url = $upload_path.$name;

            if(!is_dir($upload_path))
            {
                mkdir('./'.$upload_path);
            }
            // $name1 = Storage::disk('public')->path($file_url);
            // File::move($path, $name1);
            File::move($path, public_path($file_url));

            
            
            $task_pic = Task_pic::create([
                'file' => $file_url,
                'task_id' => $id,
                'created' => date('Y-m-d'),
            ]);

            return response()->json(['uploaded' => true, 'file' => $task_pic]);
        }

        return response()->json(['uploaded' => true, 'file' => '']);
    }


    public function store(Request $request)
    {
                //use the request to do what we want
        
        // Check if the request has files
        if($request->file('file')){
            //get name of file
            // $file = $request->file('file');
            // $filename = $file->getClientOriginalName();
            // //strip out all spaces
            // $filename = str_replace(' ', '', $filename);

            // $path = $file->storeAs('uploads', $filename);
            // // $path = $request->file('file')->store('uploads');
            // if($path){
            //     return response()->json(['message'=>'file uploaded'], 200);
            // }


            /* Multiple file upload */
            $files = $request->file('file');
            if(!is_array($files)){
                $files = [$files];
            }

            //loop throu the array 
            for($i=0; $i<count($files); $i++){
                $file = $files[$i];
                $filename = $file->getClientOriginalName();
                $filename= str_replace(' ', '', $filename);
                $file->storeAs('uploads', $filename);

            }
            return response()->json(['message'=>'file uploaded', 'data'=>$request->email], 200);
        }
        else{
            return response()->json(['message'=>'error uploading file'], 503);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task_pic  $task_pic
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::with('pics')->with('project')->with('subcontractor')->with('structure')->with('part')->with('substructure')->findOrFail($id);

        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task_pic  $task_pic
     * @return \Illuminate\Http\Response
     */
    public function edit(Task_pic $task_pic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task_pic  $task_pic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task_pic $task_pic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task_pic  $task_pic
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pic = Task_pic::findOrFail($id);
        $photo = $pic->photo;
        if($photo) {
            unlink($photo);
        }

        $pic->delete();
    }
}
