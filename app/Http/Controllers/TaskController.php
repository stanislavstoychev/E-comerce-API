<?php

namespace App\Http\Controllers;

use Image;
use App\Task;
use App\Task_pic;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function indexNotDone()
    {
        $tasks = Task::with('project')->with('subcontractor')->with('structure')->with('part')->with('substructure')->with('user')->with('pics')->with('comments')->orderBy('priority')->orderBy('project_id')->orWhere('percent_complete','!=', '100')->get();

        return response()->json($tasks);
    }

    public function index()
    {
        $tasks = Task::with('project')->with('subcontractor')->with('structure')->with('part')->with('substructure')->with('user')->with('pics')->with('comments')->orderBy('priority')->orderBy('project_id')->get();

        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hideTask($id)
    {
        $task = Task::findOrFail($id);
        $task->visible = 0;
        $task->update();
    }
    public function showTask($id)
    {
        $task = Task::findOrFail($id);
        $task->visible = 1;
        $task->update();
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
            'priority' => 'required',
            'project_id' => 'required',
            'subcontractor_id' => 'required',
            'structure_id' => 'required',
            'part_id' => 'required',
            'substructure_id' => 'required',
            'user_id' => 'required' 
           ]);

        $task = new Task;
        $task->subcontractor_id = $request->subcontractor_id;
        $task->project_id = $request->project_id;
        $task->structure_id = $request->structure_id;
        $task->substructure_id = $request->substructure_id;
        $task->part_id = $request->part_id;
        $task->description = $request->description;
        $task->actual_start = $request->actual_start;
        $task->actual_finish = $request->actual_finish;
        $task->planned_start = $request->planned_start;
        $task->planned_finish = $request->planned_finish;
        $task->priority = $request->priority;
        $task->schedule_id = $request->schedule_id;
        $task->percent_complete = $request->percent_complete;
        $task->user_id = $request->user_id;
        $task->visible = 1;

        //New
        if($request->photo) {
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = date('Y-m-d')."_".time().".".$ext;
            $img = Image::make($request->photo)->resize(1920, 1080);
            $upload_path = 'tasks/'.$task->project_id.'-'.$task->schedule_id.'/';
            if(!is_dir($upload_path))
            {
                mkdir('./'.$upload_path);
            }
            $image_url = $upload_path.$name;

            $img->save($image_url);

            $task->cover_pic = $image_url;
            $task->cover_date = date('Y-m-d');
            $task->save();


            $taskpic = new Task_pic;
            $taskpic->file = $image_url;
            $taskpic->created = date('Y-m-d');
            $pic = $task->pics()->save($taskpic);
            return response()->json($task);
        }
        //End New

        //Old
        // if($request->hasFile('img')) {
        //     $file = $request->file('img');
            
        //     //Date time created 
            
        //     $file_created = date('Y-m-d');



        //     //End - Date time created

        //     $name = $request->file('img')->getClientOriginalName();
        //     $name= str_replace(' ', '', $name);
        //     // $name = time().".".$ext;

        //     $file_name = $file_created.'_'.$name;

        //     $upload_path = 'tasks/'.$task->project_id.'-'.$task->schedule_id.'/';
        //     if(!is_dir($upload_path))
        //     {
        //         mkdir('./'.$upload_path);
        //     }
        //     $file_url = $upload_path.$file_name;

        //     $file->move($upload_path, $file_name);



        //     $task->cover_pic = $file_url;
        //     $task->cover_date = $file_created;
        //     $task->save();


        //     $taskpic = new Task_pic;
        //     $taskpic->file = $file_url;
        //     $taskpic->created = $file_created;
        //     $pic = $task->pics()->save($taskpic);
        //     return response()->json($task);
        // }
        //End Old image

            
            $task->save();

        return response()->json($task);       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */

    public function uploadcover(Request $request, $id) {

        $data = array();
        $image = $request->photo;

        if($image) {
            
            $file_created = date('Y-m-d', time());


        $task = Task::findOrFail($id);


            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            // $name = time().".".$ext;

        $name = $file_created.'_'.uniqid().'.'.$ext;

            $img = Image::make($request->photo)->resize(1920, 1080);
            $upload_path = 'tasks/'.$task->project_id.'-'.$task->schedule_id.'/';

            if(!is_dir($upload_path))
            {
                mkdir('./'.$upload_path);
            }

            $image_url = $upload_path.$name;

            $success = $img->save($image_url);



            if($success) {
                $data['cover_pic'] = $image_url;
                $data['cover_date'] = $file_created;
                $task = Task::find($id);
                
                $task->update([
                    'cover_pic' => $image_url,
                    'cover_date' => $file_created,
                ]);

                if($image_url) {
                // $done = unlink($img_path);
                // if there is old cover photo save to TaskPic
                    Task_pic::create([
                'file' =>    $image_url,
                'task_id' => $id,
                'created' => $file_created,
            ]);
            }
            }

        Task::find($id)->update($data);
        }
        return response()->json(['task' => $task]);       

    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'description' => 'required',
            'project_id' => 'required',
            'subcontractor_id' => 'required',
            'structure_id' => 'required',
            'part_id' => 'required',
            'substructure_id' => 'required',
            'user_id' => 'required',
           ]);
        $task = Task::find($id);

        $data = array();
        $data['subcontractor_id'] = $request->subcontractor_id;
        $data['project_id'] = $request->project_id;
        $data['structure_id'] = $request->structure_id;
        $data['part_id'] = $request->part_id;
        $data['description'] = $request->description;
        $data['actual_start'] = $request->actual_start;
        $data['actual_finish'] = $request->actual_finish;
        $data['planned_start'] = $request->planned_start;
        $data['planned_finish'] = $request->planned_finish;
        $data['priority'] = $request->priority;
        $data['schedule_id'] = $request->schedule_id;
        $data['percent_complete'] = $request->percent_complete;
        $data['user_id'] = $request->user_id;



        if($request->hasFile('img')) {
            $file = $request->file('img');
            
            //Date time created 
            
            $file_created = date('Y-m-d');

            //End - Date time created

            $name = $request->file('img')->getClientOriginalName();
            $name= str_replace(' ', '', $name);
            // $name = time().".".$ext;

            $file_name = $task->schedule_id.'_'.$file_created.'_'.$name;

            $upload_path = 'tasks/'.$task->project_id.'-'.$task->schedule_id.'/';
            if(!is_dir($upload_path))
            {
                mkdir('./'.$upload_path);
            }
            $file_url = $upload_path.$file_name;

            $file->move($upload_path, $file_name);

            $data['cover_pic'] = $file_url;
            $data['cover_date'] = $file_created;

            if($file_url) {
                // $done = unlink($img_path);
            Task_pic::create([
                'file' =>    $file_url,
                'task_id' => $id,
                'created' => $file_created,
            ]);
        }
        }
            $task->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        
        $pics = $task->pics;
        foreach($pics as $pic) {
            if(file_exists($pic->file)) {
            unlink($pic->file);
        }
            $pic->delete();
        }
        $task->delete();
    }
}
