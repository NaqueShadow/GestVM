<tr>
<td class="header">
<a href="#" style="display: inline-block;">
@if (true)
    <img style="width: 180px; height: 7%; border-radius: 49%;" src="{{ asset('img/logoSofitex.jpg') }}" alt="SOFITEX Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
