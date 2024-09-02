@extends('layouts.app2')

@section('row_content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <h2 style="margin-left: auto; margin-right: auto; width: fit-content;">Data</h2>
        </div>

        <div class="card-body py-4">

                    @foreach ($failedInserts as $failedInsert)
                        {{-- {{ $failedInsert->id . ' ' . $failedInsert->source_record_identifiers_hash . ' ' . $failedInsert->source_db_name_hash . ' ' . $failedInsert->source_table_name_hash . ' ' . $failedInsert->target_db_hash . ' ' . $failedInsert->target_table_name_hash . ' ' . $failedInsert->null_required_fields_hash . ' ' . $failedInsert->source_record_identifiers . ' ' . $failedInsert->source_db_name . ' ' . $failedInsert->source_table_name . ' ' . $failedInsert->target_db . ' ' . $failedInsert->target_table_name . ' ' . $failedInsert->null_required_fields . ' ' . $failedInsert->source_details . ' ' . $failedInsert->fixed . ' ' . $failedInsert->created_at }} --}}
                        {{ $failedInsert->id . ' ' . $failedInsert->source_record_identifiers_hash }}
                    @endforeach

        </div>
    </div>
@endsection
