@props(['url'])
<tr>
<td class="header">
<a href="{{ route('login') }}" style="display: inline-block; font-size: 18px; font-weight: bold;">
    {{ config('app.name') }} 
</a>

{{-- <a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a> --}}
</td>
</tr>
