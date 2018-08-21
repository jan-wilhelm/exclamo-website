<?php

namespace App\Http\Controllers\Api;

use App\ReportedCase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateReportedCaseRequest;
use App\Http\Resources\ReportedCaseResource;
use App\Repositories\ReportedCaseRepository;

class ReportedCaseController extends Controller
{

    protected $reportedCases;

    public function __construct(ReportedCaseRepository $reportedCases)
    {
        $this->middleware('auth:api');
        $this->reportedCases = $reportedCases;
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReportedCase  $reportedCase
     * @return \Illuminate\Http\Response
     */
    public function show(ReportedCase $reportedCase)
    {
        $this->authorize('view', $reportedCase);
        return new ReportedCaseResource($reportedCase);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReportedCase  $reportedCase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReportedCaseRequest $request, $id)
    {
        $case = ReportedCase::findOrFail($id);
        $this->authorize('update', $case);
        $case->update($request->validated());

        $case->mentors()->sync(collect($request['mentors'])->pluck("id") ?: $case->mentors);
        return $this->show($case);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReportedCase  $reportedCase
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportedCase $reportedCase)
    {
        //
    }
}
