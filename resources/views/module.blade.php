<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Module and Component Selector</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <h4>Select Module and Component</h4>
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

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Fetch modules
        $.get('/api/modules', function(data) {
            data.forEach(function(module) {
                $('#module-select').append('<option value="'+module.id+'">'+module.name+'</option>');
            });
        });

        // Fetch components when a module is selected
        $('#module-select').change(function() {
            var moduleId = $(this).val();
            $.get('/api/modules/'+moduleId+'/components', function(data) {
                $('#component-select').empty().append('<option disabled selected>Select a component</option>');
                data.forEach(function(component) {
                    $('#component-select').append('<option value="'+component.id+'">'+component.name+'</option>');
                });
            });
        });
    });
    </script>
</body>
</html>
