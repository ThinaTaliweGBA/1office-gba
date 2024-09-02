<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href=""/>


















		<title>GBA System</title>























		<meta charset="utf-8" />
		<meta name="description" content="The most advance
    d Group Burial Association." />
		<meta name="keywords" content="Burial, Associations" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="GBA System - Burial, Associations" />
		<meta property="og:url" content="http://157.245.252.133" />
		<meta property="og:site_name" content="GBA System | Group Burial Association" />


































		<link rel="canonical" href="http://157.245.252.133" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		
      <!-- Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="/css/nucleo-icons.css" rel="stylesheet" />
  <link href="/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="/css/material-dashboard.css?v=3.0.4" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="/css/datatables.min.css" />

  <link rel="stylesheet" href="/node_modules/intro.js/introjs.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/6.0.0/introjs.css" integrity="sha512-4OzqLjfh1aJa7M33b5+h0CSx0Q3i9Qaxlrr1T/Z+Vz+9zs5A7GM3T3MFKXoreghi3iDOSbkPMXiMBhFO7UBW/g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Datatables Buttons Css -->
  <link  rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />

<!--begin::Fonts(mandatory for all pages)-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Vendor Stylesheets(used for this page only)-->
<link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<!--end::Vendor Stylesheets-->
<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
<!--end::Global Stylesheets Bundle-->
<!--begin::Stylesheets for introJS at the start home page-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.0.1/introjs.css">
<link rel="stylesheet" href="/public/vendor/intro.js/introjs.css">
<!-- Add Nazanin template -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.0.1/introjs-nazanin.css" rel="stylesheet">
<link href="/public/vendor/intro.js/themes/introjs-royal.css" rel="stylesheet">
<!--end::Stylesheets for introJS -->





















@stack('styles')

















<script src="/js/plugins/datatables.js"></script>

<!-- Datatables Js -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.all.min.js"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"></script>
<script src="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"></script> --}}




















</head>
<!--end::Head-->










































<!--begin::Body-->
<body id="kt_body">


































  <!--begin::Theme mode setup on page load-->
  @include('layouts.theme-setup')
  <!--end::Theme mode setup on page load-->


























  <!--begin::Main-->
  <!--begin::Root-->
  <div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">






















      @include('layouts.navigation')
      





























      @yield('content')
      {{ $slot }}
































    </div>
    <!--end::Page-->
  </div>
  <!--end::Root-->
  <!--end::Main-->

             



































              @include('layouts.float_neon')
              
              










































<!--begin::Modal - Two-factor authentication-->
<div class="modal fade" id="kt_modal_two_factor_authentication" tabindex="-1" aria-hidden="true">
    <!--begin::Modal header-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header flex-stack">
                <!--begin::Title-->
                <h2>Choose An Authentication Method</h2>
                <!--end::Title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y pt-10 pb-15 px-lg-17">
                <!--begin::Options-->
                <div data-kt-element="options">
                    <!--begin::Notice-->
                    <p class="text-muted fs-5 fw-semibold mb-10">In addition to your username and password, you’ll have to enter a code (delivered via app or SMS) to log into your account.</p>
                    <!--end::Notice-->
                    <!--begin::Wrapper-->
                    <div class="pb-10">
                        <!--begin::Option-->
                        <input type="radio" class="btn-check" name="auth_option" value="apps" checked="checked" id="kt_modal_two_factor_authentication_option_1" />
                        <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-5" for="kt_modal_two_factor_authentication_option_1">
                            <i class="ki-duotone ki-setting-2 fs-4x me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <span class="d-block fw-semibold text-start">
                                <span class="text-dark fw-bold d-block fs-3">Authenticator Apps</span>
                                <span class="text-muted fw-semibold fs-6">Get codes from an app like Google Authenticator, Microsoft Authenticator, Authy or 1Password.</span>
                            </span>
                        </label>
                        <!--end::Option-->
                        <!--begin::Option-->
                        <input type="radio" class="btn-check" name="auth_option" value="sms" id="kt_modal_two_factor_authentication_option_2" />
                        <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center" for="kt_modal_two_factor_authentication_option_2">
                            <i class="ki-duotone ki-message-text-2 fs-4x me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            <span class="d-block fw-semibold text-start">
                                <span class="text-dark fw-bold d-block fs-3">SMS</span>
                                <span class="text-muted fw-semibold fs-6">We will send a code via SMS if you need to use your backup login method.</span>
                            </span>
                        </label>
                        <!--end::Option-->
                    </div>
                    <!--end::Options-->
                    <!--begin::Action-->
                    <button class="btn btn-primary w-100" data-kt-element="options-select">Continue</button>
                    <!--end::Action-->
                </div>
                <!--end::Options-->
                <!--begin::Apps-->
                <div class="d-none" data-kt-element="apps">
                    <!--begin::Heading-->
                    <h3 class="text-dark fw-bold mb-7">Authenticator Apps</h3>
                    <!--end::Heading-->
                    <!--begin::Description-->
                    <div class="text-gray-500 fw-semibold fs-6 mb-10">Using an authenticator app like
                    <a href="https://support.google.com/accounts/answer/1066447?hl=en" target="_blank">Google Authenticator</a>,
                    <a href="https://www.microsoft.com/en-us/account/authenticator" target="_blank">Microsoft Authenticator</a>,
                    <a href="https://authy.com/download/" target="_blank">Authy</a>, or
                    <a href="https://support.1password.com/one-time-passwords/" target="_blank">1Password</a>, scan the QR code. It will generate a 6 digit code for you to enter below.
                    <!--begin::QR code image-->
                    <div class="pt-5 text-center">
                        <img src="assets/media/misc/qr.png" alt="" class="mw-150px" />
                    </div>
                    <!--end::QR code image--></div>
                    <!--end::Description-->
                    <!--begin::Notice-->
                    <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-10 p-6">
                        <!--begin::Icon-->
                        <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        <!--end::Icon-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1">
                            <!--begin::Content-->
                            <div class="fw-semibold">
                                <div class="fs-6 text-gray-700">If you having trouble using the QR code, select manual entry on your app, and enter your username and the code:
                                <div class="fw-bold text-dark pt-2">KBSS3QDAAFUMCBY63YCKI5WSSVACUMPN</div></div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Notice-->
                    <!--begin::Form-->
                    <form data-kt-element="apps-form" class="form" action="#">
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            <input type="text" class="form-control form-control-lg form-control-solid" placeholder="Enter authentication code" name="code" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex flex-center">
                            <button type="reset" data-kt-element="apps-cancel" class="btn btn-light me-3">Cancel</button>
                            <button type="submit" data-kt-element="apps-submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Options-->
                <!--begin::SMS-->
                <div class="d-none" data-kt-element="sms">
                    <!--begin::Heading-->
                    <h3 class="text-dark fw-bold fs-3 mb-5">SMS: Verify Your Mobile Number</h3>
                    <!--end::Heading-->
                    <!--begin::Notice-->
                    <div class="text-muted fw-semibold mb-10">Enter your mobile phone number with country code and we will send you a verification code upon request.</div>
                    <!--end::Notice-->
                    <!--begin::Form-->
                    <form data-kt-element="sms-form" class="form" action="#">
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            <input type="text" class="form-control form-control-lg form-control-solid" placeholder="Mobile number with country code..." name="mobile" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex flex-center">
                            <button type="reset" data-kt-element="sms-cancel" class="btn btn-light me-3">Cancel</button>
                            <button type="submit" data-kt-element="sms-submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::SMS-->
            </div>
            <!--begin::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal header-->
</div>
<!--end::Modal - Two-factor authentication-->














































                <!--   Core JS Files   -->
                  <script src="/js/core/popper.min.js"></script>
                  <script src="/js/core/bootstrap.min.js"></script>
                  <script src="/js/plugins/perfect-scrollbar.min.js"></script>
                  <script src="/js/plugins/smooth-scrollbar.min.js"></script>
                  <script src="/js/plugins/datatables.js"></script>
                  <script  src="/js/plugins/chartjs.min.js"></script>
                  <script src="/js/plugins/choices.min.js"></script>
                  <script src="/js/plugins/multistep-form.js"></script>

                   <!--  No longer functional scripts   -->
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

                  <!--  Not sure   -->
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
                  </script> 
                  <script src="/js/plugins/dragula/dragula.min.js"></script>
  <script src="/js/plugins/jkanban/jkanban.js"></script>
  

  <!-- ID: #datatable-search -->
  <script>

      $(document).ready(function () {
    $('#datatable-search').DataTable();
});
    </script>    
    <script>
     $('#datatable-search').DataTable( {
    order: [[6, 'desc'],[0, 'desc']],
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
            next:     '›'
        },
        aria: {
            paginate: {
                previous: 'Previous',
                next:     'Next'
            }
        }
    }
} );
    </script>

    <!-- ID: #datatable in dependant-->
<script>
    $(document).ready(function () {
  $('#datatable-dependant').DataTable();
});
  </script>
  <script>
   $('#datatable-dependant').DataTable( {
  paging: true,
  searching: true,
  language: {
      search: "_INPUT_",
      searchPlaceholder: "Search...",
      paginate: {
          previous: '‹',
          next:     '›'
      },
      aria: {
          paginate: {
              previous: 'Previous',
              next:     'Next'
          }
      }
  }
} );
  </script>

  <!-- ID: #datatable in admin-->
<script>
  $(document).ready(function () {
$('#datatable-admin').DataTable();
});
</script>
<script>
 $('#datatable-admin').DataTable( {
paging: true,
searching: true,
language: {
    search: "_INPUT_",
    searchPlaceholder: "Search...",
    paginate: {
        previous: '‹',
        next:     '›'
    },
    aria: {
        paginate: {
            previous: 'Previous',
            next:     'Next'
        }
    }
}
} );
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

                    </script>


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
                        error.append('<p>SA ID number does not appear to be authentic - input not a valid number</p>');
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
                        document.getElementById("inputMonth").value += (id_month+1);
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
                             error.append('<p>SA ID number does not appear to be authentic - input not a valid number</p>');
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
                             document.getElementById("inputMonthDep").value += (id_month+1);
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
                    function isNumberKey(evt)
                    {
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



                 <script>
                    // autologout.js

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

                 </script>

<!-- <script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
  </script> -->















<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/widgets.bundle.js"></script>
<script src="assets/js/custom/widgets.js"></script>
<script src="assets/js/custom/apps/chat/chat.js"></script>
<script src="assets/js/custom/utilities/modals/users-search.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.0.1/intro.min.js"></script>
<script src="/public/vendor/intro.js/intro.module.js"></script>
<!-- <script>introJs().start();</script> -->
<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Vendors Javascript(used for this page only)-->
		<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
		<!--end::Vendors Javascript-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script src="assets/js/custom/account/settings/signin-methods.js"></script>
		<script src="assets/js/custom/account/settings/profile-details.js"></script>
		<script src="assets/js/custom/account/settings/deactivate-account.js"></script>
		<script src="assets/js/custom/pages/user-profile/general.js"></script>
		<script src="assets/js/widgets.bundle.js"></script>
		<script src="assets/js/custom/widgets.js"></script>
		<script src="assets/js/custom/apps/chat/chat.js"></script>
		<script src="assets/js/custom/utilities/modals/offer-a-deal/type.js"></script>
		<script src="assets/js/custom/utilities/modals/offer-a-deal/details.js"></script>
		<script src="assets/js/custom/utilities/modals/offer-a-deal/finance.js"></script>
		<script src="assets/js/custom/utilities/modals/offer-a-deal/complete.js"></script>
		<script src="assets/js/custom/utilities/modals/offer-a-deal/main.js"></script>
		<script src="assets/js/custom/utilities/modals/two-factor-authentication.js"></script>
		<script src="assets/js/custom/utilities/modals/users-search.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
    @stack('scripts')
</body>
<!--end::Body-->
</html>