<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPosting extends Model
{
    /** @use HasFactory<\Database\Factories\JobPostingFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'department',
        'contract_type',
        'location',
        'description',
        'skills',
        'benefits',
        'is_active',
        'application_deadline'
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
