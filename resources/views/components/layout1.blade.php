<!DOCTYPE html>
<html>
<head>
    <title>Layout 1</title>
    <link href="{{ asset('css/layout1.css') }}" rel="stylesheet">
</head>
<body>

<div class="grid-container">
  <div class="header">
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
    <h2>Header</h2>
  </div>
  
  <div class="left" style="background-color:#aaa;">Column</div>
  <div class="middle" style="background-color:#bbb;">
  
        <h1>London</h1>
        <p>London is the capital city of England. It is the most populous city in the  United Kingdom, with a metropolitan area of over 13 million inhabitants.</p>
        <p>Standing on the River Thames, London has been a major settlement for two millennia, its history going back to its founding by the Romans, who named it Londinium.</p>
    
  </div>  
  <div class="right" style="background-color:#ccc;">Column</div>
  
  <div class="footer">
    <p>Footer</p>
  </div>

</div>
</body>
</html>




