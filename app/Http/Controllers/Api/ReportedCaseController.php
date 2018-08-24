<?php

namespace App\Http\Controllers\Api;

use App\ReportedCase;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateReportedCaseRequest;
use App\Http\Requests\ReportCaseRequest;
use App\Http\Resources\ReportedCaseResource;
use App\Http\Resources\ConfidentialUserResource;

use App\Services\ReportedCaseService;

class ReportedCaseController extends Controller
{

    protected $caseService;

    public function __construct(ReportedCaseService $caseService)
    {
        $this->middleware('auth:api');
        $this->caseService = $caseService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Generate the ReportedCase object matching the data given
     * in the $request and store it in the database.
     *
     * This function also handles all authorization and request
     * validation and is therefore safe to use as the web endpoint.
     * @param  ReportCaseRequest $request The request
     * @return Response                     A redirect to the last page of the user
     */
    public function store(ReportCaseRequest $request)
    {
        //$this->authorize('create');

        // Retrieve all the valid fields or return an error
        $validated = $request->validated();

        // Create a new ReportedCase instance with the given fields
        $case = $this->caseService->createReportedCase($validated, auth()->user(), config("exclamo.categories"));
        return $this->show($case);
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

        $resource = new ReportedCaseResource($reportedCase);

        $caseDetails = $resource->toArray(request());

        if (!$reportedCase->anonymous)
        {
            $caseDetails['user'] = (new ConfidentialUserResource($reportedCase->victim))->toArray(request());
        }

        return $caseDetails;
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

        $case->mentors()->sync($request['mentors'] ?: $case->mentors);
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
