@component('mail::message')
    # New Contact Form Submission

    From: {{ $full_name }}
    Email: ({{ $email }})
    Subject: {{ $subject }}

    Message:
    {{ $message }}

    @component('mail::button', ['url' => 'mailto:' . $email])
        Reply to {{ $full_name }}
    @endcomponent

    Thanks,<br />
    {{ config('app.name') }}
@endcomponent
