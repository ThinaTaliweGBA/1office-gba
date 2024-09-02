<!-- resources/views/gba-forms/show.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>View Form</title>
</head>
<body>
    <h1>{{ $form->FileName }}</h1>

    @if ($src)
        <!-- Debug: Display the src content -->
        <pre>{{ $src }}</pre>
        <img src="{{ $src }}" alt="Document Image">
    @else
        <p>Unable to display the document image.</p>
    @endif

    <p><a href="{{ route('gba-forms.index') }}">Back to List</a></p>
</body>
</html>
