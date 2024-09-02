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
        <h3>Report ID: </h3>
        <div class="report-details">
            <p><strong>Report Type:</strong> </p>
            <p><strong>Report Data:</strong></p>
            <pre></pre>
        </div>
    </div>
    <img src="{{ $imgData }}" alt="Chart Image" width="700" height="400">
    <div class="footer">
        <p>Generated on {{ date('Y-m-d') }}</p>
    </div>
</body>
</html>
