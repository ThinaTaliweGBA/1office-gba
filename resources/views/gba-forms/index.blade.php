<!-- resources/views/gba-forms/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>GBA Forms</title>
</head>
<body>
    <h1>GBA Forms</h1>
    <ul>
        @foreach ($forms as $form)
            <li>
                <a href="{{ route('gba-forms.show', $form->TranID) }}">
                    {{ $form->LidNo }} - {{ $form->FORMDescr }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html>
