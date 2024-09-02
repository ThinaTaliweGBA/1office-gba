@extends('layouts.app2')

@push('styles')
    {{-- Start Racing Graphs d3.js Libraries --}}
    <script src="https://d3js.org/d3.v5.min.js"></script>
    {{-- End Racing Graphs d3.js Libraries --}}

    {{-- Start New Row Movement And flash, Auto Table --}}
    <style>
        #dataTable tbody tr {
            transition: all 0.9s ease-in;
        }

        .flash {
            animation: flashAnimation 1s 2;
            /* 1s duration, 2 iterations */
        }

        @keyframes flashAnimation {
            0% {
                background-color: transparent;
            }

            50% {
                background-color: #f2f2f2;
            }

            80% {
                background-color: rgb(120, 112, 112);
            }

            100% {
                background-color: transparent;
            }
        }
    </style>
    {{-- End New Row Movement And flash, Auto Table --}}
@endpush

@section('row_content')
    <div style="display: grid; place-items: center; border-radius: 12px;">
        <h1>Real-Time Updates</h1>
        {{-- <button id="toggle-realtime" class="btn btn-primary mb-3">Toggle Real-time</button> --}}
    </div>

    {{-- Start Racing Graph --}}
    <div class="card mt-5 mb-xl-10 border border border-solid bg-secondary" id="feature_three">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5" style="margin-left: auto; margin-right: auto; width: fit-content;">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Racing Bars</span>
            </h3>
        </div>
        <!--end::Header-->
        <svg id="racingBarGraph" width="800" height="600"></svg>
    </div>
    {{-- End Racing Graphs --}}

    {{-- Start Auto Table --}}
    <div class="card mt-5 mb-xl-10 border border border-solid bg-secondary" id="feature_three">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5" style="margin-left: auto; margin-right: auto; width: fit-content;">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Auto Table</span>
            </h3>
        </div>
        <!--end::Header-->

        <!--begin::Body-->
        <div class="card-body py-3" style="margin-left: auto; margin-right: auto; width: fit-content;">
            <!--begin::Table container-->
            <div class="table-responsive" style="margin-left: auto; margin-right: auto; width: fit-content;">
                <!-- Empty HTML table -->
                <table id="dataTable" class="table table-hover table-rounded table-striped border gy-7 gs-7">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200 bg-light">
                            <th>Month</th>
                            <th>Dataset 1</th>
                            <th>Dataset 2</th>
                            <th>Dataset 3</th>
                            <th>Dataset 4</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table rows will be inserted here -->
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->

        </div>
        <!--end::Body-->
    </div>
    {{-- End Auto Table --}}

    {{-- Start Canvas Graph --}}
    <div class="card mt-5 mb-xl-10 border border border-solid bg-secondary pb-10" id="feature_three">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5" style="margin-left: auto; margin-right: auto; width: fit-content;">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Racing Bars</span>
            </h3>
        </div>
        <!--end::Header-->
        <canvas class="border border-solid p-4" id="myChart" width="400" height="200"
            style="display: grid; place-items: center; text-decoration: underline; border-radius: 12px;">
        </canvas>
    </div>
    {{-- End Canvas Graph --}}

    {{-- Start Raw Data Display --}}
    {{-- <ul>
        @foreach ($data['items'] as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul> --}}
    {{-- End Raw Data Display --}}
@endsection

@push('scripts')
    {{-- Start Racing Graph --}}
    <script>
        const svg = d3.select("#racingBarGraph");
        const width = +svg.attr("width");
        const height = +svg.attr("height");
        const barHeight = 40;
        const barGap = 10;
        const margin = {
            top: 20,
            right: 40,
            bottom: 60,
            left: 100
        };

        let dataset = [{
                name: "A",
                value: 10,
                growth: 0
            },
            {
                name: "B",
                value: 20,
                growth: 0
            },
            {
                name: "D",
                value: 40,
                growth: 0
            },
            {
                name: "C",
                value: 25,
                growth: 0
            }
        ];

        const xScale = d3.scaleLinear()
            .domain([0, 100]) // assuming max value to be 100 for simplicity
            .range([(margin.left + 5), width - margin.right]);

        const yScale = d3.scaleBand()
            .domain(dataset.map(d => d.name))
            .range([margin.top, height - margin.bottom])
            .padding(0.1);

        // X Axis
        svg.append("g")
            .attr("transform", `translate(0, ${height - margin.bottom})`)
            .call(d3.axisBottom(xScale));

        // Y Axis
        svg.append("g")
            .attr("transform", `translate(${margin.left}, 0)`)
            .call(d3.axisLeft(yScale));

        function update(data) {
            const bars = svg.selectAll(".bar")
                .data(data, d => d.name);

            bars.enter()
                .append("rect")
                .attr("class", "bar")
                .attr("y", d => yScale(d.name))
                .attr("height", yScale.bandwidth())
                .attr("x", xScale(0))
                .attr("width", d => xScale(d.value) - xScale(0))
                .attr("fill", "steelblue");

            bars.transition().duration(500)
                .attr("width", d => xScale(d.value) - xScale(0));

            // Percentage Growth Labels
            const growthLabels = svg.selectAll(".growthLabel")
                .data(data, d => d.name);

            growthLabels.enter()
                .append("text")
                .attr("class", "growthLabel")
                .attr("y", d => yScale(d.name) + yScale.bandwidth() / 2)
                .attr("x", d => xScale(d.value) + 5) // 5 units padding from the end of the bar
                .attr("dy", ".35em") // to vertically center text
                .text(d => `+${d.growth}%`);

            growthLabels.transition().duration(1000)
                .attr("x", d => xScale(d.value) + 5)
                .text(d => `+${d.growth}%`);
        }

        update(dataset);

        // Simulate the racing by updating data every 2 seconds
        setInterval(() => {
            dataset = dataset.map(d => {
                const growth = Math.floor(Math.random() * 8); // Random growth percentage
                return {
                    name: d.name,
                    value: d.value + growth,
                    growth: growth
                };
            });

            // Sort the data so the bars "race"
            dataset.sort((a, b) => b.value - a.value);

            update(dataset);
        }, 6000);
    </script>
    {{-- End Racing Graphs --}}

    {{-- Start Raw Data Display --}}
    <script>
        let isRealTime = true;

        function fetchReport() {
            $.get('/api/reporting', function(data) {
                let parsedData = JSON.parse(data); // Parse JSON data if needed

                let html = '<ul class="list-group">';

                parsedData.items.forEach(function(item) {
                    html += '<li class="list-group-item">' + item + '</li>';
                });

                html += '</ul>';

                // Update the Blade view with fetched data
                $('#report-container').html(html);
            });
        }

        // Polling logic
        setInterval(function() {
            if (isRealTime) {
                fetchReport();
            }
        }, 6000); // Fetch new data every 1 seconds

        // Toggle real-time updates
        $('#toggle-realtime').click(function() {
            isRealTime = !isRealTime;
            $(this).toggleClass('btn-danger', !isRealTime).toggleClass('btn-primary', isRealTime);
            $(this).text(isRealTime ? 'Disable Real-time' : 'Enable Real-time');
        });

        // Initial fetch
        fetchReport();
    </script>
    {{-- End Raw Data Display --}}

    {{-- Start Canvas Graph --}}
    <script>
        // Generate random data points
        function generateRandomData(size) {
            let arr = [];
            for (let i = 0; i < size; i++) {
                arr.push(Math.floor(Math.random() * 100));
            }
            return arr;
        }

        let ctx = document.getElementById('myChart').getContext('2d');
        let data = @json($data['items']); // Convert the Laravel variable to a JavaScript variable
        let labels = Object.keys(data);

        let myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels, // X-axis labels
                datasets: [{
                        label: 'Dataset 1',
                        data: Object.values(data),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        fill: false,
                    },
                    {
                        label: 'Dataset 2',
                        data: generateRandomData(labels.length),
                        borderColor: 'rgba(255, 99, 132, 1)',
                        fill: false,
                    },
                    {
                        label: 'Dataset 3',
                        data: generateRandomData(labels.length),
                        borderColor: 'rgba(255, 206, 86, 1)',
                        fill: false,
                    },
                    {
                        label: 'Dataset 4',
                        data: generateRandomData(labels.length),
                        borderColor: 'rgba(153, 102, 255, 1)',
                        fill: false,
                    },
                    {
                        label: 'Dataset 5',
                        data: generateRandomData(labels.length),
                        borderColor: 'rgba(255, 159, 64, 1)',
                        fill: false,
                    },
                ],
            },
            options: {
                // Additional configurations can go here
            },
        });

        // Function to append new data points to each dataset
        function appendData() {
            // Append new label
            let newLabel = (myChart.data.labels.length + 1);
            myChart.data.labels.push(newLabel);

            // Append new data point to each dataset
            myChart.data.datasets.forEach((dataset) => {
                dataset.data.push(Math.floor(Math.random() * 100));
            });

            // Update the chart to reflect new data
            myChart.update();
        }

        // Append new data points every 5 minutes (300000 milliseconds)
        setInterval(appendData, 6000);
    </script>
    {{-- End Canvas Graph --}}

    {{-- Start Auto Table --}}
    <Script>
        // Function to generate random data points
        function generateRandomData() {
            return Math.floor(Math.random() * 100);
        }

        // Initial data
        const initialData = [{
                month: 'Month',
                dataset1: 12,
                dataset2: 15,
                dataset3: 7,
                dataset4: 15
            },
            // ... (Add more initial data here)
        ];

        // Insert initial data into the table
        const tableBody = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
        initialData.forEach(row => {
            const newRow = tableBody.insertRow();
            newRow.insertCell(0).innerHTML = row.month;
            newRow.insertCell(1).innerHTML = row.dataset1;
            newRow.insertCell(2).innerHTML = row.dataset2;
            newRow.insertCell(3).innerHTML = row.dataset3;
            newRow.insertCell(4).innerHTML = row.dataset4;
        });

        // Global variable to keep track of the last added row
        let lastAddedRow;

        // Function to append new row to the table
        function appendDataRow() {
            const newRow = tableBody.insertRow();
            newRow.insertCell(0).innerHTML = 'Month';
            newRow.insertCell(1).innerHTML = generateRandomData();
            newRow.insertCell(2).innerHTML = generateRandomData();
            newRow.insertCell(3).innerHTML = generateRandomData();
            newRow.insertCell(4).innerHTML = generateRandomData();

            // Store the last added row
            lastAddedRow = newRow;

            // Sort the table by "Dataset 3"
            sortTableByDataset3();
        }

        // Function to sort table by "Dataset 3" column
        function sortTableByDataset3() {
            const rows = Array.from(tableBody.getElementsByTagName('tr'));
            rows.sort((rowA, rowB) => {
                const cellA = parseInt(rowA.getElementsByTagName('td')[3].innerHTML, 10);
                const cellB = parseInt(rowB.getElementsByTagName('td')[3].innerHTML, 10);
                return cellA - cellB;
            });

            // Remove existing rows but keep a reference
            const oldRows = [];
            while (tableBody.firstChild) {
                oldRows.push(tableBody.removeChild(tableBody.firstChild));
            }

            // Append the sorted rows
            rows.forEach(row => {
                tableBody.appendChild(row);
            });

            // Add the transition class for animation
            if (lastAddedRow) {
                lastAddedRow.style.opacity = '0';
                lastAddedRow.style.transform = 'translateY(-80px)';
            }

            // Allow the browser to catch up, then apply the animation
            setTimeout(() => {
                if (lastAddedRow) {
                    lastAddedRow.style.opacity = '1';
                    lastAddedRow.style.transform = 'translateY(0)';

                    // Add flash effect to the last added row
                    lastAddedRow.classList.add('flash');

                    // Remove the flash class after the animation duration to reset it
                    setTimeout(() => {
                        lastAddedRow.classList.remove('flash');
                    }, 2000); // 1s duration * 2 iterations = 2000ms
                }
            }, 50);
        }


        // Append new row every 3 minutes (180000 milliseconds)
        setInterval(appendDataRow, 6000);
    </Script>
    {{-- End Auto Table --}}
@endpush
