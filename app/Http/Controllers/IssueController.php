<?php

namespace App\Http\Controllers;

use App\Issue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexActive()
    {
        $issues = Issue::with('project')->with('files')->orderBy('priority')->orderBy('project_id')->orWhere('status', 'Open')->orWhere('status', 'On hold')->get();
        return response()->json($issues);
    }

    public function index()
    {
        $issues = Issue::with('project')->with('files')->orderBy('priority')->orderBy('project_id')->get();
        return response()->json($issues);
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
            'title' => 'required',
            'priority' => 'required',
            'status' => 'required',
           ]);

        $issue = new Issue;
        $issue->project_id = $request->project_id;
        $issue->title = $request->title;
        $issue->details = $request->details;
        $issue->priority = $request->priority;
        $issue->identified = $request->identified;
        $issue->completed = $request->completed;
        $issue->status = $request->status;
        $issue->responsible = $request->responsible;

        $issue->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $issue = Issue::findOrFail($id);
        return response()->json($issue);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['project_id'] = $request->project_id;
        $data['title'] = $request->title;
        $data['details'] = $request->details;
        $data['priority'] = $request->priority;
        $data['identified'] = $request->identified;
        $data['completed'] = $request->completed;
        $data['status'] = $request->status;
        $data['responsible'] = $request->responsible;



        Issue::find($id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Issue::find($id)->delete();
    }
}