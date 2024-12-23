<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Http\Requests\ReportRequest;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Report
     */
    public function index(Request $request)
    {
        $reports = Report::where('province', 'LIKE', '%' . $request->search_province . '%')
        ->simplepaginate(5)
        ->appends($request->all());
        return view('report.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Report
     */
    public function create()
    {
        return view('report.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Report
     */
    public function store(ReportRequest $request)
    {
        // Validasi data
        $validated = $request->validated();
        $validated = $request->all();
        // Simpan data ke database
        $report = new Report();
        $report->user_id = auth()->user()->id;
        $report->description = $validated['description'];
        $report->type = $validated['type'];
        $report->province = $validated['province'];
        $report->regency = $validated['regency'];
        $report->subdistrict = $validated['subdistrict'];
        $report->village = $validated['village'];
        $report->upvotes = 0; // Default kosong
        $report->viewers = 0; // Default 0 viewers
        $report->statement = $request->has('statement') ? 1 : 0; // Konversi ke boolean
        $report->image = $this->getImage($request);
        $report->save();

        // Redirect dengan pesan sukses
        return redirect()->route('report.data')->with('success', 'Report submitted successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $response
     * @return \Illuminate\Http\Report
     */
    public function show($id)
    {
        $report = Report::with('comments')->findOrFail($id);
        $report->viewers += 1;
        $report->save();
        return view('report.show', compact('report'));
    }

    public function like($id)
    {
        $report = Report::findOrFail($id);
        $report->upvotes += 1;
        $report->save();
        return redirect()->back();
    }

    public function monitor()
    {
        $reports = Report::where('user_id', auth()->user()->id)->get();
        return view('report.monitoring', compact('reports'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $response
     * @return \Illuminate\Http\Report
     */
    public function edit(Report $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $response
     * @return \Illuminate\Http\Report
     */
    public function update(Request $request, Report $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $response
     * @return \Illuminate\Http\Report
     */
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return redirect()->route('report.monitor')->with('success', 'Report deleted successfully!');
    }

    private function getImage($request)
    {
        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $filename);
            $image = $filename;
        }
        return $image;
    }
}



