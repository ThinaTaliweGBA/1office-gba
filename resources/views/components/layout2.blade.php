<!DOCTYPE html>
<html>
<head>
    <title>Layout 2</title>
    <link href="{{ asset('css/layout2.css') }}" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

    <header>
    <!-- dropdown for layout selection that will only appear in development environment -->
    <!-- This form will submit a POST request to the /setlayout route whenever a new layout is selected -->
    @if (App::environment('local'))
        <form method="POST" action="/setlayout">
            @csrf
            <select name="layout" onchange="this.form.submit()">
                <option value="layout1" {{ $layout == 'layout1' ? 'selected' : '' }}>Layout 1</option>
                <option value="layout2" {{ $layout == 'layout2' ? 'selected' : '' }}>Layout 2</option>
            </select>
        </form>
    @endif

    @yield('content')
    <h2>Cities</h2>
    </header>

    <section>
    <nav>
        <ul>
        <li><a href="#">London</a></li>
        <li><a href="#">Paris</a></li>
        <li><a href="#">Tokyo</a></li>
        </ul>
    </nav>
    
    <article>
        <h1>London</h1>
        <p>London is the capital city of England. It is the most populous city in the  United Kingdom, with a metropolitan area of over 13 million inhabitants.</p>
        <p>Standing on the River Thames, London has been a major settlement for two millennia, its history going back to its founding by the Romans, who named it Londinium.</p>
    </article>
    </section>

    <footer>
    <p>Footer</p>
    </footer>

</body>
</html>


