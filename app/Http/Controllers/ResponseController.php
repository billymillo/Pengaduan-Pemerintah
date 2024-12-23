<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\Report;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responses = Report::orderBy('upvotes', request('order', 'asc'))->get();
        return view('staff.index', compact('responses'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        'responses_status' => 'nullable|min:3', // Make it nullable since you're setting the default value
        'report_id' => 'required|exists:reports,id', // Ensure the report ID exists
    ]);

    // Set default value for 'responses_status' if not provided
    $responsesStatus = $request->input('responses_status', 'on_process'); // Default is 'on_process' if not provided

    // Ensure the report_id is passed correctly
    $reportId = $request->input('report_id'); // Change to report_id

    // Create the response entry
    $response = Response::create([
        'responses_status' => $responsesStatus,
        'report_id' => $reportId, // Ensure you use the correct column name here
    ]);
    // Redirect with the correct response ID
    $report = Report::findOrFail($reportId);
    return redirect()->route('response.show', $report->id)->with('success', 'Status updated successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Response::with('report', 'progress')->findOrFail($id);
        return view('staff.create', compact('response'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }
}

