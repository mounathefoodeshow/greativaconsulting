<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    /** @use HasFactory<\Database\Factories\JobPostingFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'department',
        'contract_type',
        'location',
        'description',
        'skills',
        'benefits',
        'is_active'
    ];

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
