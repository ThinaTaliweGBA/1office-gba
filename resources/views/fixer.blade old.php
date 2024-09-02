<!DOCTYPE html>
<html>
<head>
    <title>Transfer Logs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Unmatched Values</div>
                    <div class="card-body">
                        @php
                            $unmatched_logs = $logs->filter(function ($log) {
                                return trim($log->source_value) !== '';
                            });
                        @endphp
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Source Table</th>
                                    <th>Target Table</th>
                                    <th>Missing Field</th>
                                    <th>Source Column</th>
                                    <th>Source Value</th>
                                    
                                    <th>Related Record</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($unmatched_logs as $log)
                                @php
                                    $targetModelName = 'App\\Models\\' . ucfirst($log->oo_model->model_name);
                                    if (class_exists($targetModelName)) {
                                        $targetRecord = $targetModelName::find($log->target_id);
                                    }
                                @endphp

                                <tr>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->source_table }}</td>
                                    <td>{{ $log->target_table }}</td>
                                    <td>{{ $log->missing_field }}</td>
                                    <td>{{ $log->source_column }}</td>
                                    <td>{{ $log->source_value }}</td>
                            
                                    <td>
                                        @if(isset($targetRecord))

                                            @foreach ($targetRecord->toArray() as $key => $value)
                                                <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}<br>
                                            @endforeach
                    
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form method="POST" action="/fixer/fix_unmatched">
                            @csrf
                            <button type="submit" class="btn btn-primary mt-3">Fix Unmatched Values</button>
                        </form>
                    </div>
                </div>




                <div class="card mt-5">
                    <div class="card-header">Missing Values</div>
                    <div class="card-body">
                        @php
                            $missing_logs = $logs->filter(function ($log) {
                                return trim($log->source_value) === '';
                            });
                        @endphp
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Source Table</th>
                                    <th>Target Table</th>
                                    <th>Missing Field</th>
                                    <th>Source Column</th>
                                    <th>Source Value</th>

                                    <th>Related Record</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($missing_logs as $log)
                                @php
                                    $targetModelName = 'App\\Models\\' . ucfirst($log->oo_model->model_name);
                                    if (class_exists($targetModelName)) {
                                        $targetRecord = $targetModelName::find($log->target_id);
                                    }
                                @endphp

                                <tr>
                                    <td>{{ $log->id }}</td>
                                    <td>{{ $log->source_table }}</td>
                                    <td>{{ $log->target_table }}</td>
                                    <td>{{ $log->missing_field }}</td>
                                    <td>{{ $log->source_column }}</td>
                                    <td>{{ $log->source_value }}</td>
                                    
                                    <td>
                                        @if(isset($targetRecord))

                                            @foreach ($targetRecord->toArray() as $key => $value)
                                                <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}<br>
                                            @endforeach

                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <form method="POST" action="/fixer/fix_missing">
                            @csrf
                            <button type="submit" class="btn btn-primary mt-3">Fix Missing Values</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
