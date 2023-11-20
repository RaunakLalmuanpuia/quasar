<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employer = Role::where('name', 'employer')->first()->users;

        $employerPendingFiles =  Report::leftJoin('users as employers', 'employers.id', '=', 'reports.employer_id')
        ->leftJoin('users as employees', 'employees.id', '=', 'reports.employee_id')
        ->select('reports.*', 'employers.name as employer_name', 'employees.name as employee_name')
        ->whereIn('employer_status', ['pending', ''])->get();

        if (Auth::user()->hasRole('employee')) {
            return Inertia::render('Report/Employee/Index', [
                'employer' => $employer,
            ]);
        }
        if (Auth::user()->hasRole('employer')) {
            return Inertia::render('Report/Employer/Index', [
                'employerPendingFiles' => $employerPendingFiles,
            ]);
        }
        if (Auth::user()->hasRole('manager')) {
            return Inertia::render('Report/Manager/Index');
        }
        return Inertia::render('Report/Index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->hasRole('employee')){
            $request->validate([
                'filename' => 'required|string',
                'filepath' => 'required|file',
                'employer' => 'required'

            ]);
            $file = $request->file('filepath');
            $filepath = $file->store('public/reports');
            // dd($request->employer["value"]);
            $fileRecord = new Report([
                'employee_id' => auth()->user()->id,
                'name' => $request->filename,
                'employee_file' => $filepath,
                'employer_id' => $request->employer['value'],
                'movement' => Carbon::now()->setTimezone('Asia/Kolkata')->format('y-m-d')
            ]);
            $fileRecord->save();
            return redirect()->route('dashboard')->with('message', 'Report Submitted Successfully!');
        }
        else{
            abort(401, 'Unauthorized');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
