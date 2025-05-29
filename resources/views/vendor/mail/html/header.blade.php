@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            {{-- @if (trim($slot) === 'Laravel') --}}
            <img src="https://firebasestorage.googleapis.com/v0/b/medic-predict.appspot.com/o/sabunpasal%2Fsabun_pasal_linear.png?alt=media&token=617588c7-547f-4d9d-a369-dcec2be09a0a"
                class="logo" alt="saunpasal Logo">
            {{-- @else
                {{ $slot }}
            @endif --}}
        </a>
    </td>
</tr>
