<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;

    protected $fillable = [
        'job_posting_id',
        'full_name',
        'email',
        'phone',
        'cv_path',
        'linkedin_url',
        'portfolio_url',
        'cover_letter'
    ];

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class);
    }
}
