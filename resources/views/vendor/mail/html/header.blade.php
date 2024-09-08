@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <!-- Replace this with your custom logo -->
                <img src="{{ asset('images/logo.png') }}" class="logo" alt="{{ config('app.name') }} Logo" style="max-width: 150px;">

            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
