@extends('layouts.app2')

@section('row_content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <h2 style="margin-left: auto; margin-right: auto; width: fit-content;">Data</h2>
        </div>

        <div class="card-body py-4">
           
                    @foreach ($unknownFixes as $unknownFix)
                        {{ $unknownFix->id . ' ' . $unknownFix->source_detail }}
                    @endforeach
                
        </div>
    </div>

    
@endsection
