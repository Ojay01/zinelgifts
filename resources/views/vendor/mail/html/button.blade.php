@props([
    'url',
    'color' => 'yellow', 
    'align' => 'center',
])

<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<a href="{{ $url }}" class="button-{{ $color }}" target="_blank" rel="noopener" 
   style="background-color: #F59E0B; color: #fff; padding: 10px 18px; border-radius: 6px; font-size: 16px; text-align: center; text-decoration: none; display: inline-block;">
    {{ $slot }}
</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
