<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResponseProgress;
use App\Models\Report;

class ResponseProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengaduan.index');
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
        // Validate the input
        $request->validate([
            'histories' => 'required|string', // Ensure histories is required and a string
            'response_id' => 'required|exists:responses,id', // Ensure responses_id exists
        ]);

        // Insert the data into response_progress
        ResponseProgress::create([
            'histories' => $request->input('histories'),
            'response_id' => $request->input('response_id'),
        ]);

        // Redirect back with success
        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ResponseProgress  $ResponseProgress
     * @return \Illuminate\Http\Response
     */
    public function done($id)
    {
        $report = Report::findOrFail($id);
        $report->responses->update(['responses_status' => 'done']);
        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResponseProgress  $ResponseProgress
     * @return \Illuminate\Http\Response
     */
    public function edit(ResponseProgress $ResponseProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResponseProgress  $ResponseProgress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResponseProgress $ResponseProgress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResponseProgress  $ResponseProgress
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = ResponseProgress::findOrFail($id);
        $report->delete();
        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}

