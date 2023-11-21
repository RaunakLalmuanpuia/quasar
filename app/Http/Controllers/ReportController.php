<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Report;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('employee')) {
            $employer = Role::where('name', 'employer')->first()->users;
            return Inertia::render('Report/Employee/Index', [
                'employer' => $employer,
            ]);
        }
        if (Auth::user()->hasRole('employer')) {
            $manager = Role::where('name', 'manager')->first()->users;

            $employerId = auth()->user()->id; //  get the ID of the currently authenticated user
            $employerPendingFiles =  Report::leftJoin('users as employers', 'employers.id', '=', 'reports.employer_id')
                ->leftJoin('users as employees', 'employees.id', '=', 'reports.employee_id')
                ->select('reports.*', 'employers.name as employer_name', 'employees.name as employee_name')
                ->whereIn('employer_status', ['pending', ''])
                ->where('employer_id', $employerId)->get(); //filters the Report records based on the condition that the employer_id column should match the ID of the authenticated user.
            // dd($employerPendingFiles);
            return Inertia::render(
                'Report/Employer/Index',
                [
                    'employerPendingFiles' => $employerPendingFiles,
                    'manager' => $manager
                ]
            );
        }
        if (Auth::user()->hasRole('manager')) {
            return Inertia::render('Report/Manager/Index');
        }
        return abort(401, 'Unauthorized');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // $employerPendingFiles = Report::join('users', 'users.id', '=', 'reports.employer_id')
        //     ->select('reports.*', 'users.name as employer_name')
        //     ->get();

        // dd($employerPendingFiles);
        if (Auth::user()->hasRole('employee')) {
            $employer = Role::where('name', 'employer')->first()->users;
            return Inertia::render('Report/Employee/Index', [
                'employer' => $employer,
            ]);
        }
        if (Auth::user()->hasRole('employer')) {
            $employerId = auth()->user()->id; //  get the ID of the currently authenticated user
            $employerPendingFiles =  Report::leftJoin('users as employers', 'employers.id', '=', 'reports.employer_id')
                ->leftJoin('users as employees', 'employees.id', '=', 'reports.employee_id')
                ->select('reports.*', 'employers.name as employer_name', 'employees.name as employee_name')
                ->whereIn('employer_status', ['pending', ''])
                ->where('employer_id', $employerId)->get(); //filters the Report records based on the condition that the employer_id column should match the ID of the authenticated user.
            // dd($employerPendingFiles);
            return Inertia::render('Report/Employer/Index', [
                'employerPendingFiles' => $employerPendingFiles,
            ]);
        }
        if (Auth::user()->hasRole('manager')) {
            return Inertia::render('Report/Manager/Index');
        }
        return abort(401, 'Unauthorized');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->hasRole('employee')) {
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
        if (Auth::user()->hasRole('employer')) {
            $request->validate([
                'status' => 'required',
                'filepath' => 'required|file',
                'manager' => 'required'
            ]);
            $file = $request->file('filepath');
            $filepath = $file->store('public/reports');
            Report::where('id', $request->selectedReport)
            ->update([
                'employer_status' => $request->status,
                'employer_file' => $filepath,
                'employer_feedback' => $request->feedback,
                'manager_id' => $request->manager['value'],
            ]);
            return redirect()->route('dashboard')->with('message', 'Report Submitted Successfully!');
        } 
        if (Auth::user()->hasRole('manager')) {
            
        }
        return abort(401, 'Unauthorized');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        // dd($report);
        $filepath = $report->employee_file;
        $fileExtension = pathinfo($filepath, PATHINFO_EXTENSION);
        if (in_array($fileExtension, ['pdf', 'jpg', 'jpeg', 'png', 'gif'])) {
            // View the file
            return response()->file(storage_path('app/' . $filepath));
        } else {
            // Download the file with the extension name
            return Storage::download($filepath, $report->name . '.' . $fileExtension);
        }
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
