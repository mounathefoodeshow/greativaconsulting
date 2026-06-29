<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\JobPosting;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        JobPosting::create([
            'title' => 'Senior Frontend Developer',
            'department' => 'Engineering',
            'contract_type' => 'Full-time',
            'location' => 'Paris, France (Hybrid)',
            'description' => "We are looking for a Senior Frontend Developer to join our team at Greativa Consulting Group.\n\nYou will be responsible for building high-quality Vue.js applications.",
            'skills' => "- 5+ years of experience with JavaScript/TypeScript\n- Deep knowledge of Vue.js and ecosystem\n- Experience with Tailwind CSS",
            'benefits' => "- Competitive salary\n- Health insurance\n- Remote work flexibility\n- Training budget",
        ]);

        JobPosting::create([
            'title' => 'Marketing Manager',
            'department' => 'Marketing',
            'contract_type' => 'Full-time',
            'location' => 'London, UK',
            'description' => "Join our fast-paced marketing team to lead global campaigns and drive growth.",
            'skills' => "- Proven experience in B2B marketing\n- Excellent communication skills\n- Data-driven mindset",
            'benefits' => "- Performance bonuses\n- Gym membership\n- 30 days PTO",
        ]);

        JobPosting::create([
            'title' => 'HR Business Partner Intern',
            'department' => 'HR',
            'contract_type' => 'Internship',
            'location' => 'New York, USA',
            'description' => "Assist our HR department with recruitment, onboarding, and employee engagement initiatives.",
            'skills' => "- Currently enrolled in a Bachelor's or Master's program in HR or related field\n- Strong organizational skills",
            'benefits' => "- Monthly stipend\n- Mentorship program",
        ]);
    }
}
