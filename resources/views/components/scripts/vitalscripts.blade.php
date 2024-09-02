<!--   Core JS Files   -->
<script src="/js/core/popper.min.js"></script>
<script src="/js/core/bootstrap.min.js"></script>
<script src="/js/plugins/perfect-scrollbar.min.js"></script>
<script src="/js/plugins/smooth-scrollbar.min.js"></script>
<script src="/js/plugins/datatables.js"></script>
<script src="/js/plugins/chartjs.min.js"></script>
<script src="/js/plugins/choices.min.js"></script>
<script src="/js/plugins/multistep-form.js"></script>




<script>
  var ctx1 = document.getElementById("chart-line").getContext("2d");
  var ctx2 = document.getElementById("chart-pie").getContext("2d");
  var ctx3 = document.getElementById("chart-bar").getContext("2d");

  // Line chart
  new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{
        label: "Example 1",
        tension: 0,
        pointRadius: 5,
        pointBackgroundColor: "#e91e63",
        pointBorderColor: "transparent",
        borderColor: "#e91e63",
        borderWidth: 4,
        backgroundColor: "transparent",
        fill: true,
        data: [50, 100, 200, 190, 400, 350, 500, 450, 700],
        maxBarThickness: 6
      },
      {
        label: "Example 2",
        tension: 0,
        borderWidth: 0,
        pointRadius: 5,
        pointBackgroundColor: "#3A416F",
        pointBorderColor: "transparent",
        borderColor: "#3A416F",
        borderWidth: 4,
        backgroundColor: "transparent",
        fill: true,
        data: [10, 30, 40, 120, 150, 220, 280, 250, 280],
        maxBarThickness: 6
      }
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5],
            color: '#c1c4ce5c'
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#9ca2b7',
            font: {
              size: 14,
              weight: 300,
              family: "Roboto",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: true,
            borderDash: [5, 5],
            color: '#c1c4ce5c'
          },
          ticks: {
            display: true,
            color: '#9ca2b7',
            padding: 10,
            font: {
              size: 14,
              weight: 300,
              family: "Roboto",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
      },
    },
  });


  // // Pie chart
  new Chart(ctx2, {
    type: "pie",
    data: {
      labels: ['A1', 'B1', 'C1', 'D1'],
      datasets: [{
        label: "Membership Types",
        weight: 9,
        cutout: 0,
        tension: 0.9,
        pointRadius: 2,
        borderWidth: 1,
        backgroundColor: ['#17c1e8', '#e91e63', '#3A416F', '#a8b8d8'],
        data: [15, 20, 5, 60],
        fill: false
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
            color: '#c1c4ce5c'
          },
          ticks: {
            display: false
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
            color: '#c1c4ce5c'
          },
          ticks: {
            display: false,
          }
        },
      },
    },
  });

  // Bar chart
  new Chart(ctx3, {
    type: "bar",
    data: {
      labels: ['1-6', '7-13', '14-18', '19-21'],
      datasets: [{
        label: "Dependants by age",
        weight: 5,
        borderWidth: 0,
        borderRadius: 4,
        backgroundColor: '#3A416F',
        data: [15, 20, 12, 60,],
        fill: false
      }],
    },
    options: {
      indexAxis: 'y',
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        }
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5],
            color: '#c1c4ce5c'
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#9ca2b7',
            font: {
              size: 14,
              weight: 300,
              family: "Roboto",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: true,
            drawTicks: true,
            color: '#9ca2b7'
          },
          ticks: {
            display: true,
            color: '#9ca2b7',
            padding: 10,
            font: {
              size: 14,
              weight: 300,
              family: "Roboto",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
      },
    },
  });
</script>

{{--
<script>
  $('input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=number], input[type=search], input[type=date], input[type=time], textarea').each(function (element, i) {
    if ((element.value !== undefined && element.value.length > 0) || $(this).attr('placeholder') !== undefined) {
      $(this).siblings('div').addClass('is-invalid focused is-focused');
    }
    else {
      $(this).siblings('label').removeClass('is-filled');
    }
  });
                //$('input[type=email]').val('test').siblings('label').addClass('is-filled');
</script> --}}
<script src="/js/plugins/dragula/dragula.min.js"></script>
<script src="/js/plugins/jkanban/jkanban.js"></script>
<script>

  $(document).ready(function () {
    $('#datatable-search').DataTable();
  });
</script>
<script>
  $('#datatable-search').DataTable({
    order: [[6, 'desc'], [0, 'desc']],
    dom: 'Bfrtip',
    buttons: [
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdfHtml5'
    ],
    paging: true,
    searching: true,
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search...",
      paginate: {
        previous: '‹',
        next: '›'
      },
      aria: {
        paginate: {
          previous: 'Previous',
          next: 'Next'
        }
      }
    }
  });
</script>


<script>
  $(document).ready(function () {
    $('#datatable-dependant').DataTable();
  });
</script>
<script>
  $('#datatable-dependant').DataTable({
    paging: true,
    searching: true,
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search...",
      paginate: {
        previous: '‹',
        next: '›'
      },
      aria: {
        paginate: {
          previous: 'Previous',
          next: 'Next'
        }
      }
    }
  });
</script>


<script>
  $(document).ready(function () {
    $('#datatable-admin').DataTable();
  });
</script>
<script>
  $('#datatable-admin').DataTable({
    paging: true,
    searching: true,
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search...",
      paginate: {
        previous: '‹',
        next: '›'
      },
      aria: {
        paginate: {
          previous: 'Previous',
          next: 'Next'
        }
      }
    }
  });
</script>


<!-- Google maps auto-complete form -->
<script>
  "use strict";
  Object.defineProperty(exports, "__esModule", { value: true });
  var autocomplete;
  var address1Field;
  var address2Field;
  var postalField;
  function initAutocomplete() {
    address1Field = document.getElementById("Line1");
    address2Field = document.getElementById("Line2");
    postalField = document.getElementById("PostalCode");
    // Create the autocomplete object, restricting the search predictions to
    // addresses in the US and Canada.
    autocomplete = new google.maps.places.Autocomplete(address1Field, {
      componentRestrictions: { country: ["za"] },
      fields: ["address_components", "geometry"],
      types: ["address"],
    });
    address1Field.focus();
    // When the user selects an address from the drop-down, populate the
    // address fields in the form.
    autocomplete.addListener("place_changed", fillInAddress);
  }
  function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    var address1 = "";
    var postcode = "";
    // Get each component of the address from the place details,
    // and then fill-in the corresponding field on the form.
    // place.address_components are google.maps.GeocoderAddressComponent objects
    // which are documented at http://goo.gle/3l5i5Mr
    for (const component of place.address_components) {
      // @ts-ignore remove once typings fixed
      const componentType = component.types[0];

      // alert(componentType);

      switch (componentType) {
        case "street_number": {
          address1 = `${component.long_name} ${address1}`;
          break;
        }

        case "route": {
          address1 += component.short_name;
          break;
        }

        case "postal_code": {
          postcode = component.long_name;

          break;
        }

        case "postal_code_suffix": {
          postcode = component.long_name;
          break;
        }
        case "locality": {
          document.getElementById("City").value = component.long_name;
          break;
        }
        case "sublocality_level_1": {
          document.getElementById("TownSuburb").value = component.long_name;
          break;
        }
        case "administrative_area_level_1": {
          document.getElementById("Province").value = component.long_name;
          break;
        }
        case "administrative_area_level_2": {
          document.getElementById("Line2").value = component.long_name;
          break;
        }
        case "country":
          document.getElementById("Country").value = component.long_name.toUpperCase();
          break;
      }
    }

    address1Field.value = address1;
    document.getElementById("PostalCode").value = postcode;

    // After filling the form with address components from the Autocomplete
    // prediction, set cursor focus on the second address line to encourage
    // entry of subpremise information such as apartment, unit, or floor number.
    address2Field.focus();
  }
  window.initAutocomplete = initAutocomplete;

</script>

<!-- Google maps auto-complete form -->
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF1KOXQsWQgBsFdgoKlPAa38CS0nTzAmM&libraries=places&callback=initAutocomplete">
  </script>
{{--
//This is for the member form - original
<script>
  function getDOB(IDNumber) {
    var Year = IDNumber.substring(0, 2);
    var Month = IDNumber.substring(2, 4);
    var Day = IDNumber.substring(4, 6);

    var cutoff = (new Date()).getFullYear() - 2000;

    var Y = (Year > cutoff ? '19' : '20') + Year;


    document.getElementById("inputYear").value += Y;
    document.getElementById("inputMonth").value += Month;
    document.getElementById("inputDay").value += Day;

  }

</script> --}}


{{-- This is for the member form - Test --}}
<script>
  function getDOB(IDNumber) {

    // first clear any left over error messages
    $('#error span').remove();
    //This clears the red x mark
    document.getElementById("IDNumber").classList.remove('is-invalid');
    document.getElementById("inputYearDiv").classList.remove('is-invalid');
    document.getElementById("inputMonthDiv").classList.remove('is-invalid');
    document.getElementById("inputDayDiv").classList.remove('is-invalid');

    //This clears the green checkmark
    document.getElementById("IDNumber").classList.remove('is-valid');
    document.getElementById("inputYearDiv").classList.remove('is-valid');
    document.getElementById("inputMonthDiv").classList.remove('is-valid');
    document.getElementById("inputDayDiv").classList.remove('is-valid');



    // store the error div, to save typing
    var error = $('#error');

    // assume everything is correct and if it later turns out not to be, just set this to false
    var correct = true;

    // SA ID Number have to be 13 digits, so check the length
    if (IDNumber.length != 13 || !isNumber(IDNumber)) {
      error.append('<p>SA ID number not a valid number</p>');
      correct = false;
    }
    // get first 6 digits as a valid date
    var tempDate = new Date(IDNumber.substring(0, 2), IDNumber.substring(2, 4) - 1, IDNumber.substring(4, 6));



    var id_date = tempDate.getDate();
    var id_month = tempDate.getMonth();
    var id_year = tempDate.getFullYear();

    var Year = IDNumber.substring(0, 2);

    var cutoff = (new Date()).getFullYear() - 2000;

    var Y = (Year > cutoff ? '19' : '20') + Year;



    var fullDate = id_date + "-" + (id_month + 1) + "-" + id_year;

    if (!((tempDate.getYear() == IDNumber.substring(0, 2)) && (id_month == IDNumber.substring(2, 4) - 1) && (id_date == IDNumber.substring(4, 6)))) {
      error.append('<p>SA ID number not valid</p>');
      correct = false;
    }



    // if no error found, hide the error message
    if (correct) {
      error.css('display', 'none');




      //This adds the green checkmark
      document.getElementById("IDNumber").classList.add('is-valid');
      document.getElementById("inputYearDiv").classList.add('is-valid');
      document.getElementById("inputMonthDiv").classList.add('is-valid');
      document.getElementById("inputDayDiv").classList.add('is-valid');

      // and put together a result message
      document.getElementById("inputYear").value += Y;
      document.getElementById("inputMonth").value += (id_month + 1);
      document.getElementById("inputDay").value += id_date;
    }
    // otherwise, show the error
    else {
      error.css('display', 'block');

      //This adds the green checkmark
      document.getElementById("IDNumber").classList.add('is-invalid');
      document.getElementById("inputYearDiv").classList.add('is-invalid');
      document.getElementById("inputMonthDiv").classList.add('is-invalid');
      document.getElementById("inputDayDiv").classList.add('is-invalid');
    }

    return false;


  }

  function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
  }
</script>










{{-- This is for the dependent form --}}
<script>
  function getDOBDep(IDNumber) {

    // first clear any left over error messages
    $('#error span').remove();
    //This clears the red x mark
    document.getElementById("IDNumberDepDiv").classList.remove('is-invalid');
    document.getElementById("inputYearDepDiv").classList.remove('is-invalid');
    document.getElementById("inputMonthDepDiv").classList.remove('is-invalid');
    document.getElementById("inputDayDepDiv").classList.remove('is-invalid');

    //This clears the green checkmark
    document.getElementById("IDNumberDepDiv").classList.remove('is-valid');
    document.getElementById("inputYearDepDiv").classList.remove('is-valid');
    document.getElementById("inputMonthDepDiv").classList.remove('is-valid');
    document.getElementById("inputDayDepDiv").classList.remove('is-valid');



    // store the error div, to save typing
    var error = $('#error');

    // assume everything is correct and if it later turns out not to be, just set this to false
    var correct = true;

    // SA ID Number have to be 13 digits, so check the length
    if (IDNumber.length != 13 || !isNumber(IDNumber)) {
      error.append('<p>SA ID number not a valid number</p>');
      correct = false;
    }
    // get first 6 digits as a valid date
    var tempDate = new Date(IDNumber.substring(0, 2), IDNumber.substring(2, 4) - 1, IDNumber.substring(4, 6));

    var id_date = tempDate.getDate();
    var id_month = tempDate.getMonth();
    var id_year = tempDate.getFullYear();


    var Year = IDNumber.substring(0, 2);

    var cutoff = (new Date()).getFullYear() - 2000;

    var Y = (Year > cutoff ? '19' : '20') + Year;



    var fullDate = id_date + "-" + (id_month + 1) + "-" + id_year;

    if (!((tempDate.getYear() == IDNumber.substring(0, 2)) && (id_month == IDNumber.substring(2, 4) - 1) && (id_date == IDNumber.substring(4, 6)))) {
      error.append('<p>SA ID number does not appear to be authentic - date part not valid</p>');
      correct = false;
    }



    // if no error found, hide the error message
    if (correct) {
      error.css('display', 'none');




      //This adds the green checkmark
      document.getElementById("IDNumberDepDiv").classList.add('is-valid');
      document.getElementById("inputYearDepDiv").classList.add('is-valid');
      document.getElementById("inputMonthDepDiv").classList.add('is-valid');
      document.getElementById("inputDayDepDiv").classList.add('is-valid');

      // and put together a result message
      document.getElementById("inputYearDep").value += Y;
      document.getElementById("inputMonthDep").value += (id_month + 1);
      document.getElementById("inputDayDep").value += id_date;
    }
    // otherwise, show the error
    else {
      error.css('display', 'block');

      //This adds the green checkmark
      document.getElementById("IDNumberDepDiv").classList.add('is-invalid');
      document.getElementById("inputYearDepDiv").classList.add('is-invalid');
      document.getElementById("inputMonthDepDiv").classList.add('is-invalid');
      document.getElementById("inputDayDepDiv").classList.add('is-invalid');
    }

    return false;


  }

  function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
  }
</script>




<script>
  function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
      return false;

    return true;
  }
</script>

<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/js/material-dashboard.min.js?v=3.0.4"></script>
@include('sweetalert::alert')



{{-- <script>

  $(document).ready(function () {
    const timeout = 900000;  // 300000 ms = 5 minutes
    var idleTimer = null;
    $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function () {
      clearTimeout(idleTimer);

      idleTimer = setTimeout(function () {
        document.getElementById('logout-form').submit();
      }, timeout);
    });
    $("body").trigger("mousemove");
  });

</script> --}}
 {{-- autologout.js --}}

<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
</script>



