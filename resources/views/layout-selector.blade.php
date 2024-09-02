@if (App::environment('local'))
    <form method="POST" action="/setlayout">
        @csrf
        <select name="layout" onchange="this.form.submit()">
            <option value="layout1" {{ $layout == 'layout1' ? 'selected' : '' }}>Layout 1</option>
            <option value="layout2" {{ $layout == 'layout2' ? 'selected' : '' }}>Layout 2</option>
            <option value="app2" {{ $layout == 'app2' ? 'selected' : '' }}>Main</option>
        </select>
    </form>
@endif
