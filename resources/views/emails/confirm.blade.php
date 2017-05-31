Hello {{$user->name}}.
You change your email. so you need to verify this email. Please use the link below: 
{{route('verify', $user->verification_token)}}
