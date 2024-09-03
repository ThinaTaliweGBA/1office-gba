@extends('layouts.app2')

@push('styles')
    {{-- External Libraries and Stylesheets --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery.min.js"%3E%3C/script%3E'))
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/23.2.3/css/dx.material.blue.light.css" />
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/23.2.3/css/dx.light.css">
    <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/23.2.3/js/dx.all.js"></script>
    <style>
        #pivotgrid,
        #pivotgrid-chart {
            margin-top: 20px;
            padding: 20px;
        }

        .currency {
            text-align: center;
        }

        .dx-pivotgrid-container {
            background-color: lightgray;
        }
    </style>
@endpush

@section('row_content')
<div class="dx-viewport p-16">
        <div class="demo-container">
            <h1 class='text-center'>Debit Order</h1>
            <div id="pivotgrid">
                <div id="pivotgrid-chart"></div>
                <div id="pivotgrid"></div>
            </div>
        </div>
    </div>

    <script>
        function formatCurrency(value) {
            return new Intl.NumberFormat('en-ZA', {
                style: 'currency',
                currency: 'ZAR'
            }).format(value);
        }
         //var dependantsDataUrl = "<?php echo env('DEPENDANTS_DATA_URL'); ?>";
        $.ajax({
            url: '/dependantsData',
            method: 'GET',
            success: function(data) {
                initializeComponents(data);
            }
        });
        

        function initializeComponents(data) {
            const pivotGrid = $('#pivotgrid').dxPivotGrid({
                dataSource: {
                    fields: [{
                            caption: 'Receipt Number',
                            dataField: 'receipt_number',
                            area: 'row'
                        },
                        {
                            caption: 'Transaction Date',
                            dataField: 'transaction_date',
                            dataType: 'date',
                            area: 'column'
                        },
                        {
                            caption: 'Receipt Value',
                            dataField: 'receipt_value',
                            dataType: 'number',
                            format: 'currency',
                            area: 'data'
                        },
                        {
                            caption: 'Membership ID',
                            dataField: 'membership_id',
                            area: 'row'
                        },
                        {
                            caption: 'Transaction Description',
                            dataField: 'transaction_description',
                            area: 'row'
                        },
                        {
                            caption: 'Transaction Type ID',
                            dataField: 'transaction_type_id',
                            area: 'filter'
                        }
                    ],
                    store: data
                },
                allowSortingBySummary: true,
                allowFiltering: true,
                showBorders: true,
                fieldChooser: {
                    enabled: true,
                    height: 400
                },
                export: {
                    enabled: true
                }
            });

            const pivotGridChart = $('#pivotgrid-chart').dxChart({
                commonSeriesSettings: {
                    type: 'bar'
                },
                tooltip: {
                    enabled: true,
                    format: 'currency',
                    customizeTooltip(args) {
                        return {
                            html: `${args.seriesName} | ${args.valueText}`
                        };
                    }
                },
                size: {
                    height: 350
                },
                adaptiveLayout: {
                    width: 450
                },
                export: {
                    enabled: true
                }
            });

            pivotGrid.bindChart(pivotGridChart, {
                dataFieldsDisplayMode: 'splitPanes',
                alternateDataFields: false
            });
        }
    </script>
@endsection
