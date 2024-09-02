import './bootstrap';
import Swal from 'sweetalert2';
import Alpine from 'alpinejs';
// Import jQuery
import $ from 'jquery';
// Import DataTables
import 'datatables.net';
import 'datatables.net-buttons';
import 'datatables.net-buttons/js/buttons.html5.js'; // For HTML 5 buttons
import 'datatables.net-buttons/js/buttons.print.js'; // For print button
// import 'datatables.net-buttons-dt/css/buttons.dataTables.css';


window.Alpine = Alpine;

Alpine.start();


window.deleteConfirm = function(formId)
{
    Swal.fire({
        icon: 'warning',
        text: 'Do you want to delete this?',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: '#e3342f',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}

// Document Ready
document.addEventListener('DOMContentLoaded', function () {
    // Initialize DataTables
    $(document).ready(function () {
        $('#table').DataTable(
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        );
    });
});


