<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JobPostingController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPosting::where('is_active', true);
        
        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('contract_type')) {
            $query->where('contract_type', $request->contract_type);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $jobs = $query->latest()->paginate(10)->withQueryString();

        return Inertia::render('Jobs/Index', [
            'jobs' => $jobs,
            'filters' => $request->only(['department', 'contract_type', 'search'])
        ]);
    }

    public function show(JobPosting $jobPosting)
    {
        if (!$jobPosting->is_active) {
            abort(404);
        }

        return Inertia::render('Jobs/Show', [
            'job' => $jobPosting
        ]);
    }
}
