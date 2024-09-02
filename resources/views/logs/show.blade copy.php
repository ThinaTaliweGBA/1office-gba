<!-- resources/views/logs/show.blade.php -->

@extends('layouts.app2') <!-- Assuming you have a main layout -->

@section('content')
    <div class="container">
        <div class="bg-secondary m-4 px-4 pb-2 rounded-2">
            <h1 class="mt-9 pt-2" style="margin-left: auto; margin-right: auto; width: fit-content;">Data Logs</h1>
            @if (!empty($logs))
                {{-- <pre>{{ extractLogMessages($logs) }}</pre> --}}
                {!! extractLogMessages($logs) !!}
            @else
                <p>No logs found.</p>
            @endif
        </div>

        <div class="container bg-secondary">
            <h1>Drag & Drop</h1>
            <p>Trying out <code>dragula.js</code>. Source <a href="https://github.com/bevacqua/dragula">here</a>.</p>
            <div class="left">
                <div id="drag-elements">
                    <div>Element 1</div>
                    <div>Element 2</div>
                    <div>Element 3</div>
                </div>

                <div id="drop-target">
                </div>
            </div>
            <div class="right">
                <div id="display">Display</div>
            </div>
        </div>
    </div>
@endsection

@php
    function extractLogMessages($logs)
    {
        // Split logs into lines
        $lines = explode("\n", $logs);

        // Collect the first line of each log entry
        $logMessages = [];

        foreach ($lines as $line) {
            // Check if the line starts with "[DATE]" which indicates a new log entry
            if (preg_match('/^\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}\]/', $line)) {
                $logMessages[] .= '<div class="card my-2 p-3">';
                $logMessages[] .= $line . ' by: ' . auth()->user()->name;
                $logMessages[] .= '</div>';
            }
        }

        return implode("\n", $logMessages);
    }
@endphp
