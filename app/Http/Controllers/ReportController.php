<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

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
        if (Auth::user()->hasRole('employee')) {
            return Inertia::render('Report/Employee/Index', [
                'employer' => $employer,
            ]);
        }
        if (Auth::user()->hasRole('employer')) {
            return Inertia::render('Report/Employer/Index.vue');
        }
        if (Auth::user()->hasRole('manager')) {
            return Inertia::render('Report/Manager/Index.vue');
        }
        return Inertia::render('Report/Index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
