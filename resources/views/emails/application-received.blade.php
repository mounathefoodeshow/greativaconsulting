<x-mail::message>
# Application Received

Dear {{ $application->full_name }},

Thank you for applying for the **{{ $application->jobPosting->title }}** position at Greativa Consulting Group.

We have successfully received your application. Our team will review your profile and get back to you soon.

<x-mail::button :url="url('/jobs')">
View Other Openings
</x-mail::button>

Best regards,<br>
Greativa HR Team
</x-mail::message>
