{{-- @extends('layouts.' . $layouts[$selectedLayoutIndex]->name) --}}
@extends('layouts.' . $selectedLayout)

{{-- @extends('layouts.app2') --}}

@push('styles')
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ auth()->user()->layout->css_file_path }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .container {
            padding: 20px;
        }

        .flatpickr-calendar .flatpickr-monthDropdown-months {
            max-height: 150px;
            /* Adjust height as needed */
            overflow-y: scroll;
        }

        .flatpickr-calendar .flatpickr-yearDropdown-year {
            max-height: 150px;
            /* Adjust height as needed */
            overflow-y: scroll;
        }
    </style>
    {{-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> --}}
@endpush

@section('row_content')
    <!-- begin::Col-->
    <div class="col-12 col-xxl-12 col-md-12 mb-1 rounded">
        <div class="card shadow-lg">
        
            <div class="card-body">
                <!-- Dropdown for selecting chart type -->

                <div style="position: absolute; top: 0; right: 0; z-index: 2;">
                    <div class="d-flex flex-row-reverse">
                        <button type="button" id="btnImage" class="btn btn-success btn-sm m-3 p-2" style="height: 38px;">
                            Export
                        </button>

                        <select id="chartTypeSelector"
                            class="form-select2 form-select2-sm btn btn-secondary m-3 wrap mx-auto my-auto"
                            style="padding: 0; height: 30px; width: 110px; margin: 0; border-radius: 5px;">
                            <option value="bar">BarChart</option>
                            <option value="line">LineChart</option>
                            {{-- <option value="pie">PieChart</option> --}}
                            {{-- <option value="doughnut">DoughnutChart</option> --}}
                            <option value="radar">RadarChart</option>
                            <option value="polarArea">PolarAreaChart</option>
                        </select>


                    </div>
                </div>

                <canvas id="kt_chartjs_1" class="mh-400px"></canvas>
                <div id="summaryTotals" style="margin-top: 20px;"></div>
                <div id="summaryTotals" class="d-flex justify-content-between mt-4"></div>
            </div>
        </div>
    </div>
    <!--end::Col-->



    <!--begin::Col-->
    <div class="col-xxl-8 col-md-8 mb-4">
        <!--begin::Mixed Widget 5-->
        <div class="card shadow-lg" data-intro="The Services Breakdown." data-step="3">
        <div class="card-header align-items-center border-0 mt-4 mx-auto">
                <h2 class="card-title align-items-start flex-column">
                    <span class="fw-bold mb-2 text-gray-900">Memberships grouped by Type</span>
                    {{-- <span class="text-primary fw-semibold fs-7"></span> --}}
                    {{-- <span class="badge badge-danger fs-3"><span id="unreadCountLogs">{{ auth()->user()->unreadNotifications->count() }}</span> :  Unread Notifications.</span> --}}
                </h2>
                <div class="card-toolbar">
                    <!-- Button and menu structure can remain as is for functionality purposes -->
                </div>
            </div>
            <div class="card-body">
                <div id="kt_amcharts_3" style="height: 500px;"></div>
            </div>
        </div>
        <!--end::Mixed Widget 5-->
    </div>
    <!--end::Col-->

    {{-- <div class="col-xxl-4 col-md-4 mb-4"> --}}
        <!--begin::List Widget 5-->
        {{-- <div class="card h-md-100 shadow-lg" data-intro="The Services Schedule." data-step="4"> --}}
            <!--begin::Header-->
            {{-- <div class="card-header align-items-center border-0 mt-4"> --}}
                {{-- <h3 class="card-title align-items-start flex-column"> --}}
                    {{-- <span class="fw-bold mb-2 text-gray-900">Activitiy Logs</span> --}}
                    {{-- <span class="text-primary fw-semibold fs-7">Latest Daily Notifications</span> --}}
                    {{-- <span class="badge badge-danger fs-3"><span id="unreadCountLogs">{{ auth()->user()->unreadNotifications->count() }}</span> :  Unread Notifications.</span> --}}
                {{-- </h3> --}}
                {{-- <div class="card-toolbar"> --}}
                    <!-- Button and menu structure can remain as is for functionality purposes -->
                {{-- </div> --}}
            {{-- </div> --}}
            <!--end::Header-->
            <!--begin::Body-->
            {{-- <div class="card-body pt-5"> --}}

                <!--begin::Timeline-->
                {{-- @dump(auth()->user()->notifications) --}}
                {{-- <div class="timeline-label">
                    @php
                        
                        $colors = ['text-primary', 'text-success', 'text-danger', 'text-warning', 'text-info'];
                    @endphp

                    @foreach ($latestNotifications as $notification)
                        @php
                            $randomColor = $colors[array_rand($colors)];
                        @endphp
                        
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-6">
                                {{ $notification->created_at->format('H:i') }}</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless {{ $randomColor }} fs-1"></i>
                            </div>
                            <div class="timeline-content fw-normal ps-3 text-dark">
                                {{ ucfirst($notification->data['action']) }} - {{ $notification->data['message'] }}
                            </div>
                        </div>
                        
                    @endforeach
                </div> --}}
                <!--begin::Footer-->
                {{-- <div class="card-footer d-flex justify-content-around">
        <span class="badge bg-success m-1">Create <i class="fa fa-genderless text-success"></i></span>
          xvn,.
            <span class="badge bg-success m-1">Create <i class="fa fa-genderless text-success"></i></span>
            <span class="badge bg-danger m-1">Delete <i class="fa fa-genderless text-danger"></i></span>
            <span class="badge bg-info m-1">Meeting <i class="fa fa-genderless text-info"></i></span>
            <span class="badge bg-warning m-1">Update <i class="fa fa-genderless text-warning"></i></span>
            <span class="badge bg-primary m-1">Event <i class="fa fa-genderless text-primary"></i></span>
        </div> --}}
                <!--end::Footer-->
                <!--end::Timeline-->
            {{-- </div> --}}
            <!--end: Card Body-->

        {{-- </div> --}}
        <!--end: List Widget 5-->
    {{-- </div> --}}
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-xxl-4 col-md-4 mb-4">
        <!--begin::List Widget 5-->
        <div class="card h-md-100 shadow-lg" data-intro="The Services Schedule." data-step="4">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0 mt-4">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fw-bold mb-2 text-gray-900">Association Log Activities</span>
                    <span class="text-primary fw-semibold fs-7">User Activities</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
                <!--begin::Timeline-->
                <div class="timeline-label"></div>
                <!--end::Timeline-->
            </div>
            <!--end: Card Body-->
        </div>
        <!--end: List Widget 5-->
    </div>
    <!--end::Col-->




    {{-- <style> 
    body {
        color: {{ $styles->body_color }};
        background-color: {{ $styles->body_bg }};
        font-size: {{ $styles->font_size }};
        font-weight: {{ $styles->font_weight }};
        font-family: {{ $styles->font_family }};
    }

    header {
        background-color: {{ $styles->header_desktop_fixed_bg_color }};
        box-shadow: 0px 1px 5px {{ $styles->header_desktop_fixed_shadow }};
    }

    header.tablet, header.mobile {
        background-color: {{ $styles->header_tablet_and_mobile }};
        box-shadow: 0px 1px 5px {{ $styles->header_tablet_and_mobile_shadow }};
    }

    aside {
        background-color: {{ $styles->aside_bg_color }};
    }

    .page-bg {
        background-color: {{ $styles->page_bg }};
    }

    .app-blank {
        background-color: {{ $styles->app_blank_bg }};
    }

    button {
        background-color: {{ $styles->button_color }};
    }

    .text {
        color: {{ $styles->text_color }};
    }

    div {
        border-color: {{ $styles->div_border_color }};
        border-radius: {{ $styles->border_radius }};
        margin: {{ $styles->div_margin }};
        padding: {{ $styles->div_padding }};
    }

    p {
        margin: {{ $styles->paragraph_margin }};
    }
    </style>  --}}
@endsection

@push('scripts')
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>

    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    {{-- <Script>
        am5.ready(function() {
            var root = am5.Root.new("kt_amcharts_3");

            root.setThemes([
                am5themes_Animated.new(root)
            ]);


            var chart = root.container.children.push(am5percent.PieChart.new(root, {
                layout: root.verticalLayout
            }));


            var series = chart.series.push(am5percent.PieSeries.new(root, {
                alignLabels: true,
                calculateAggregates: true,
                valueField: "value",
                categoryField: "category"
            }));

            series.slices.template.setAll({
                strokeWidth: 3,
                stroke: am5.color(0xffffff)
            });

            series.labelsContainer.set("paddingTop", 30)

            series.slices.template.adapters.add("radius", function(radius, target) {
                var dataItem = target.dataItem;
                var high = series.getPrivate("valueHigh");

                if (dataItem) {
                    var value = target.dataItem.get("valueWorking", 0);
                    return radius * value / high
                }
                return radius;
            });

            series.data.setAll([{
                value: 10,
                category: "One"
            }, {
                value: 9,
                category: "Two"
            }, {
                value: 6,
                category: "Three"
            }, {
                value: 5,
                category: "Four"
            }, {
                value: 4,
                category: "Five"
            }, {
                value: 3,
                category: "Six"
            }]);

            var legend = chart.children.push(am5.Legend.new(root, {
                centerX: am5.p50,
                x: am5.p50,
                marginTop: 15,
                marginBottom: 15
            }));

            legend.data.setAll(series.dataItems);

            series.appear(1000, 100);

        });
    </Script> --}}

    {{-- <Script>
        am5.ready(function() {
            var root = am5.Root.new("kt_amcharts_3");

            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            var chart = root.container.children.push(am5percent.PieChart.new(root, {
                layout: root.verticalLayout
            }));

            var series = chart.series.push(am5percent.PieSeries.new(root, {
                alignLabels: true,
                calculateAggregates: true,
                valueField: "value",
                categoryField: "category"
            }));

            series.slices.template.setAll({
                strokeWidth: 3,
                stroke: am5.color(0xffffff)
            });

            series.labelsContainer.set("paddingTop", 30)

            series.slices.template.adapters.add("radius", function(radius, target) {
                var dataItem = target.dataItem;
                var high = series.getPrivate("valueHigh");

                if (dataItem) {
                    var value = dataItem.get("valueWorking", 0);
                    return radius * value / high
                }
                return radius;
            });

            series.data.setAll([{
                value: 120,
                category: "Funerals"
            }, {
                value: 50,
                category: "Cremations"
            }, {
                value: 30,
                category: "Burials"
            }, {
                value: 15,
                category: "Pre-Planned Arrangements"
            }, {
                value: 80,
                category: "Memorial Services"
            }, {
                value: 20,
                category: "Aftercare Services"
            }]);

            var legend = chart.children.push(am5.Legend.new(root, {
                centerX: am5.p50,
                x: am5.p50,
                marginTop: 15,
                marginBottom: 15
            }));

            legend.data.setAll(series.dataItems);

            series.appear(1000, 100);
        });
    </Script> --}}

<script>
    am5.ready(function() {
        var root = am5.Root.new("kt_amcharts_3");
        root.setThemes([am5themes_Animated.new(root)]);
        
        var chart = root.container.children.push(am5percent.PieChart.new(root, {
            layout: root.verticalLayout
        }));

        var series = chart.series.push(am5percent.PieSeries.new(root, {
            valueField: "count",
            categoryField: "typeName"  // Use 'typeDescription' directly from Laravel data
        }));

        series.slices.template.setAll({
            strokeWidth: 3,
            stroke: am5.color(0xffffff)
        });

        series.labelsContainer.set("paddingTop", 10);

        // Load data dynamically from Laravel backend
        fetch('/chart-data2')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data); // Check what data is received
                if (data.length === 0) {
                    console.log('No data available to display.');
                } else {
                    series.data.setAll(data);
                }

                // Adjust legend settings here
                var legend = chart.children.push(am5.Legend.new(root, {
                    width: am5.percent(10), // Set width of the legend to 20% of chart container
                    y: am5.p50, // Center vertically
                    centerY: am5.p50,
                    layout: root.verticalLayout, // Vertical layout for legend items
                    marginRight: 15, // Margin to separate from the chart
                    verticalScrollbar: am5.Scrollbar.new(root, {
                        orientation: "vertical" // Enable vertical scrolling
                    })
                }));

                legend.data.setAll(series.dataItems);
                series.appear(1000, 100);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });

            root._logo.dispose();
    });
</script>

    {{-- <script>
        // Function to generate random data points
        function generateRandomData() {
            return Math.floor(Math.random() * 100);
        }

        var ctx = document.getElementById('kt_chartjs_1');

        // Define colors
        var primaryColor = '#FFC107 '; //0d6efd Bootstrap primary color
        var dangerColor = '#1976D2 '; //dc3545 Bootstrap danger color
        var successColor = '#80C342  '; //28a745 Bootstrap success color
        var infoColor = '#8E24AA '; //9784b8 Bootstrap info color

        // Define fonts
        var fontFamily = 'sans-serif'; // Basic sans-serif font

        // Chart labels
        const labels = ["{{ __('months.january') }}", "{{ __('months.february') }}", "{{ __('months.march') }}",
            "{{ __('months.april') }}", "{{ __('months.may') }}", "{{ __('months.june') }}",
            "{{ __('months.july') }}", "{{ __('months.august') }}", "{{ __('months.september') }}",
            "{{ __('months.october') }}", "{{ __('months.november') }}", "{{ __('months.december') }}"
        ];

        // Chart data
        const data = {
            labels: labels,
            datasets: [{
                    label: "[Age < 35]",
                    data: [21, 79, 73, 95, 42, 83, 67, 82, 95, 67, 28, 25],
                    backgroundColor: primaryColor,
                },
                {
                    label: "[35 < Age < 45]",
                    data: [51, 51, 48, 47, 82, 57, 49, 58, 55, 69, 15, 62],
                    backgroundColor: dangerColor,
                },
                {
                    label: "[45 < Age < 65]",
                    data: [77, 11, 85, 98, 43, 57, 10, 15, 20, 15, 10, 65],
                    backgroundColor: successColor,
                },
                {
                    label: "[Age > 65]",
                    data: [51, 20, 43, 61, 51, 78, 81, 68, 46, 62, 74, 58],
                    backgroundColor: infoColor,
                }
            ]
        };

        // Chart config
        const config = {
            type: 'bar',
            data: data,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: '<h2 class="text-light">Joined Members Per Month</h2>' // Add your chart title here
                    }
                },
                responsive: true,
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        grouped: true,
                        title: {
                            display: true,
                            text: 'Months' // Add your x-axis label here
                        }
                    },
                    y: {
                        grouped: true,
                        title: {
                            display: true,
                            text: 'Number of members' // Add your y-axis label here
                        }
                    }
                }
            },
            defaults: {
                global: {
                    defaultFontFamily: 'Arial' // Assuming 'fontFamily' variable was intended to be a string. Adjust as necessary.
                }
            }
        };

        // Init ChartJS
        var myChart = new Chart(ctx, config);

        // Function to append new data points and labels
        function appendData() {
            // Generate a new label. You can change this according to your requirements
            const newLabel = 'New Month';

            // Append new label
            myChart.data.labels.push(newLabel);

            // Append new data to each dataset
            myChart.data.datasets.forEach((dataset) => {
                dataset.data.push(generateRandomData());
            });

            // Update the chart
            myChart.update();
        }
        /////////////////////////////////////// The export to img functionality within the auto update script /////////////////////////
        function exportAsImage() {
            var link = document.createElement('a');
            link.download = 'chart.png';
            link.href = document.getElementById('kt_chartjs_1').toDataURL();
            link.click();
        }

        // Get the button element by its ID and attach the export function to its click event
        var buttonImage = document.getElementById("btnImage");
        buttonImage.addEventListener("click", exportAsImage);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // Append new data every 3 minutes (180000 milliseconds)
        setInterval(appendData, 180000);
    </script> --}}
    <script>
        // Function to fetch data from the API
        async function fetchData() {
            const response = await fetch('/chart-data');
            const data = await response.json();

            return data;
        }

        // Function to initialize the chart
        async function initChart(chartType) {
            const {
                monthlyData,
                summaryTotals
            } = await fetchData();

            const labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
                "October", "November", "December"
            ];
            const ageGroups = {
                '<18': Array(12).fill(0),
                '18-34': Array(12).fill(0),
                '35-49': Array(12).fill(0),
                '50-64': Array(12).fill(0),
                '65+': Array(12).fill(0)
            };
            //console.log(ageGroups);

            monthlyData.forEach(item => {
                const monthIndex = item.month - 1;
                ageGroups['<18'][monthIndex] = item['<18'];
                ageGroups['18-34'][monthIndex] = item['18-34'];
                ageGroups['35-49'][monthIndex] = item['35-49'];
                ageGroups['50-64'][monthIndex] = item['50-64'];
                ageGroups['65+'][monthIndex] = item['65+'];
            });

            var ctx = document.getElementById('kt_chartjs_1');

            var colors = {
                '<18': '#FFC107',
                '18-34': '#1976D2',
                '35-49': '#80C342',
                '50-64': '#8E24AA',
                '65+': '#FF5733'
            };

            const data = {
                labels: labels,
                datasets: [{
                        label: "[Age < 18]",
                        data: ageGroups['<18'],
                        backgroundColor: colors['<18'],
                        borderColor: colors['<18'],
                        fill: false,
                    },
                    {
                        label: "[18 < Age < 34]",
                        data: ageGroups['18-34'],
                        backgroundColor: colors['18-34'],
                        borderColor: colors['18-34'],
                        fill: false,
                    },
                    {
                        label: "[35 < Age < 49]",
                        data: ageGroups['35-49'],
                        backgroundColor: colors['35-49'],
                        borderColor: colors['35-49'],
                        fill: false,
                    },
                    {
                        label: "[50 < Age < 64]",
                        data: ageGroups['50-64'],
                        backgroundColor: colors['50-64'],
                        borderColor: colors['50-64'],
                        fill: false,
                    },
                    {
                        label: "[Age > 65]",
                        data: ageGroups['65+'],
                        backgroundColor: colors['65+'],
                        borderColor: colors['65+'],
                        fill: false,
                    }
                ]
            };

            const config = {
                type: chartType,
                data: data,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Joined Persons Per Month'
                        }
                    },
                    responsive: true,
                    interaction: {
                        intersect: false,
                    },
                    scales: {
                        x: {
                            grouped: true,
                            title: {
                                display: true,
                                text: 'Months(2024)'
                            }
                        },
                        y: {
                            grouped: true,
                            title: {
                                display: true,
                                text: 'Number of Persons'
                            }
                        }
                    }
                }
            };

            if (chartType === 'pie' || chartType === 'doughnut' || chartType === 'polarArea' || chartType === 'radar') {
                delete config.options.scales;
            }

            if (window.myChart) {
                window.myChart.destroy();
            }

            window.myChart = new Chart(ctx, config);

            // Update summary totals
            /** document.getElementById('summaryTotals').innerHTML = `
            <p><strong>Summary Totals:</strong></p>
            <p>Main Members: ${summaryTotals.main_member}</p>
            <p>Dependants: ${summaryTotals.dependant}</p>
            <p>Spouses: ${summaryTotals.spouse}</p>
            <p>Children: ${summaryTotals.child}</p>
            <p>Male: ${summaryTotals.male}</p>
            <p>Female: ${summaryTotals.female}</p>
        `; */

            // Update summary totals
            document.getElementById('summaryTotals').innerHTML = `
             <div class="d-flex flex-column align-items-center">
             <div class="btn-group">
                 <button class="btn"><span data-bs-toggle="tooltip" title="Total Main Members: ${summaryTotals.main_member}">Main: ${summaryTotals.main_member}</span></button>
                 <button class="btn"><span data-bs-toggle="tooltip" title="Total Dependants: ${summaryTotals.dependant}">Dependants: ${summaryTotals.dependant}</span></button>
                 <button class="btn"><span data-bs-toggle="tooltip" title="Total Spouses: ${summaryTotals.spouse}">Spouses: ${summaryTotals.spouse}</span></button>
                 <button class="btn"><span data-bs-toggle="tooltip" title="Total Children: ${summaryTotals.child}">Children: ${summaryTotals.child}</span></button>
                 <button class="btn"><span data-bs-toggle="tooltip" title="Total Male(s): ${summaryTotals.male}">Male: ${summaryTotals.male}</span></button>
                 <button class="btn"><span data-bs-toggle="tooltip" title="Total Female(s): ${summaryTotals.female}">Female: ${summaryTotals.female}</span></button>
                 </div>
             </div>
         `;


            // Initialize Bootstrap tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        // Initialize the chart with default type
        initChart('bar');

        // Add event listener to the dropdown
        document.getElementById('chartTypeSelector').addEventListener('change', function() {
            const selectedChartType = this.value;
            initChart(selectedChartType);
        });

        // Function to export the chart as an image
        function exportAsImage() {
            var link = document.createElement('a');
            link.download = 'chart.png';
            link.href = document.getElementById('kt_chartjs_1').toDataURL();
            link.click();
        }

        // Get the button element by its ID and attach the export function to its click event
        var buttonImage = document.getElementById("btnImage");
        buttonImage.addEventListener("click", exportAsImage);
    </script>

    <script type="text/javascript">
        function startIntro() {
            var intro = introJs();
            intro.setOptions({
                steps: [{
                        intro: "Welcome to our site!"
                    },
                    {
                        element: document.querySelector('#step1'),
                        intro: "This is the first step."
                    },
                    {
                        element: document.querySelector('#step2'),
                        intro: "This is the second step."
                    },
                    // Add more steps as needed
                ]
            });
            intro.start();
        }
    </script>

    {{-- <script>
    fetch('https://bootswatch.com/api/5.json')
  .then(response => response.json())
  .then(data => load(data));


    function load(data) {
    const themes = data.themes;
    const select = document.querySelector('select');
    
    themes.forEach((value, index) => {
        const option = document.createElement('option');
        option.value = index;
        option.textContent = value.name;
        
        select.append(option);
    });
    
    select.addEventListener('change', (e) => {
        const theme = themes[e.target.value];
        document.querySelector('#theme').setAttribute('href', theme.css);
        document.querySelector('.alert h1').textContent = theme.name;
    });
    
    const changeEvent = new Event('change');
    select.dispatchEvent(changeEvent);
    }
</script> --}}

    {{-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
  duration: 1200,
})
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/activity-logs')
            .then(response => response.json())
            .then(data => {
                const timelineContainer = document.querySelector('.timeline-label');
                timelineContainer.innerHTML = ''; // Clear existing content
                
                data.forEach(activity => {
                    const timelineItem = document.createElement('div');
                    timelineItem.classList.add('timeline-item');

                    const timeLabel = document.createElement('div');
                    timeLabel.classList.add('timeline-label', 'fw-bold', 'text-gray-800', 'fs-6');
                    timeLabel.textContent = new Date(activity.created_at).toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});

                    const timelineBadge = document.createElement('div');
                    timelineBadge.classList.add('timeline-badge');
                    timelineBadge.innerHTML = `<i class="fa fa-genderless ${getTimelineBadgeClass(activity.methodType)} fs-1"></i>`;

                    const timelineContent = document.createElement('div');
                    timelineContent.classList.add('timeline-content', 'fw-mormal', 'ps-3');
                    timelineContent.innerHTML = `${activity.description}<br><small>IP Address: ${activity.ipAddress}</small>`;

                    timelineItem.appendChild(timeLabel);
                    timelineItem.appendChild(timelineBadge);
                    timelineItem.appendChild(timelineContent);

                    timelineContainer.appendChild(timelineItem);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    });

    function getTimelineBadgeClass(methodType) {
        switch(methodType) {
            case 'GET':
                return 'text-info';
            case 'POST':
                return 'text-success';
            case 'PUT':
                return 'text-warning';
            case 'DELETE':
                return 'text-danger';
            default:
                return 'text-primary';
        }
    }
</script>

@endpush
