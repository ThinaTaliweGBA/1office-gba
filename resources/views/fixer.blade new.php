<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fixer</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <h2>Error Fixer</h2>
                <h4 class="mt-4">Select Module and Component</h4>
                <select id="module-select" class="form-control my-3">
                    <option disabled selected>Select a module</option>
                    <!-- Modules will be populated here -->
                </select>

                <select id="component-select" class="form-control my-3">
                    <option disabled selected>Select a component</option>
                    <!-- Components will be populated here -->
                </select>
            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap 5 Bundle -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Fetch modules
        $.get('/modules', function(data) {
            data.forEach(function(module) {
                $('#module-select').append('<option value="'+module.id+'">'+module.module_name+'</option>');
            });
        });

        // Fetch components when a module is selected
        $('#module-select').change(function() {
            var moduleId = $(this).val();
            $.get('/modules/'+moduleId+'/components', function(data) {
                $('#component-select').empty().append('<option disabled selected>Select a component</option>');
                data.forEach(function(component) {
                    $('#component-select').append('<option value="'+component.id+'">'+component.component_name+'</option>');
                });
            });
        });
    });
    </script>
</body>
</html>
