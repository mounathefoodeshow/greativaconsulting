<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobPosting::withTrashed()->latest()->paginate(10);
        return Inertia::render('Admin/Jobs/Index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Jobs/Form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'contract_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'skills' => 'required|string',
            'benefits' => 'nullable|string',
            'application_deadline' => 'nullable|date',
            'is_active' => 'boolean'
        ]);

        JobPosting::create($validated);

        return redirect()->route('admin.jobs.index')->with('success', 'Job created successfully.');
    }

    public function edit($id)
    {
        $job = JobPosting::withTrashed()->findOrFail($id);
        return Inertia::render('Admin/Jobs/Form', [
            'job' => $job
        ]);
    }

    public function update(Request $request, $id)
    {
        $job = JobPosting::withTrashed()->findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'contract_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'skills' => 'required|string',
            'benefits' => 'nullable|string',
            'application_deadline' => 'nullable|date',
            'is_active' => 'boolean'
        ]);

        $job->update($validated);

        return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy($id)
    {
        $job = JobPosting::findOrFail($id);
        $job->delete(); // Soft delete (Archive)
        
        return redirect()->route('admin.jobs.index')->with('success', 'Job archived successfully.');
    }

    public function forceDelete($id)
    {
        $job = JobPosting::withTrashed()->findOrFail($id);
        $job->forceDelete(); // Permanent delete

        return redirect()->route('admin.jobs.index')->with('success', 'Job permanently deleted.');
    }

    public function togglePublish($id)
    {
        $job = JobPosting::withTrashed()->findOrFail($id);
        $job->is_active = !$job->is_active;
        $job->save();

        return back()->with('success', 'Job status updated.');
    }
}
