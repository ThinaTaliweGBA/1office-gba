<!DOCTYPE html>
<html>
<head>
    <title>Layout 1</title>
    {{-- <link href="{{ asset('css/layout1.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('css/' . $selectedLayout . '.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset($selectedLayoutFiles) }}" rel="stylesheet">

</head>
<body>

<div class="grid-container">
  <div class="header">
    <!-- dropdown for layout selection that will only appear in development environment -->
    <!-- This form will submit a POST request to the /setlayout route whenever a new layout is selected -->

    
{{--     @if (App::environment('local'))--}}
{{--        <form method="POST" action="/setlayout">--}}
{{--            @csrf--}}
{{--            <select name="layout" onchange="this.form.submit()">--}}
{{--                <option value="layout1" {{ $layout == 'layout1' ? 'selected' : '' }}>Layout 1</option>--}}
{{--                <option value="layout2" {{ $layout == 'layout2' ? 'selected' : '' }}>Layout 2</option>--}}
{{--                <option value="app2" {{ $layout == 'app2' ? 'selected' : '' }}>Main</option>--}}
{{--            </select>--}}
{{--        </form>--}}
{{--    @endif --}}

    <!-- Example of accessing shared variables -->
    <p>Selected Layout Index: {{ $selectedLayoutIndex }}</p>
    <p>Selected Layout: {{ $selectedLayout }}</p>
    <p>Layout Names: {{ implode(', ', $layoutNames) }}</p>
    <p>Layout css files: {{ implode(', ', $layoutNames) }}</p>
    <p>Selected Layout: {{ $selectedLayoutFiles }}</p>

<form action="/set-layout" method="POST">
  @csrf
  <select name="selectedLayoutIndex">
      @foreach ($layouts as $index => $layout)
          <option value="{{ $index }}" {{ $index == $selectedLayoutIndex ? 'selected' : '' }}>{{ $layout->name == 'app2' ? 'GBA' : $layout->name }}</option>
      @endforeach
  </select>
  <input type="submit" value="Set Layout">
</form>


    {{-- @include('layout-selector', ['layout' => $layout]) --}}


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




