<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header, .footer {
            text-align: center;
            padding: 1em;
            background-color: #f2f2f2;
        }
        .content {
            padding: 2em;
        }
        .report-details {
            border: 1px solid #e4e4e4;
            border-radius: 5px;
            padding: 1em;
            margin-top: 2em;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Report Details</h2>
    </div>
    <div class="content">
        <h3>Report ID: {{ $report->id }}</h3>
        <div class="report-details">
            <p><strong>Report Type:</strong> {{ $report->report_type }}</p>
            <p><strong>Report Data:</strong></p>
            <pre>{{ $report->report_data }}</pre>
        </div>
    </div>
    {{-- <img src="{{ $imgData }}" alt="Chart Image"> --}}
    <div class="footer">
        <p>Generated on {{ date('Y-m-d') }}</p>
    </div>

    <script>
        html2canvas(document.querySelector("#myChart")).then(canvas => {
        let img = canvas.toDataURL("image/png");
        // send `img` to server and save or use it for PDF generation
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
</body>
</html>
