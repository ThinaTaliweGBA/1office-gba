@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div style="font-weight:650; color:red;">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="mt-3 list-disc list-inside" style="font-weight:650; color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
