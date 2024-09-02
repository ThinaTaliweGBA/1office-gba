<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Pivot Table</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery.min.js"%3E%3C/script%3E'))
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.4.4/cldr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.4.4/cldr/event.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.4.4/cldr/supplemental.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.4.4/cldr/unresolved.min.js"></script>
    <script src="https://cdn3.devexpress.com/jslib/23.2.3/js/dx.all.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/23.2.3/css/dx.material.blue.light.css" />

    <style>
        .dx-datagrid .dx-data-row>td.bullet {
            padding-top: 0;
            padding-bottom: 0;
        }
    </style>

    <script>
        $(() => {
            $('#gridContainer').dxDataGrid({
                dataSource: {
                    store: {
                        type: 'odata',
                        version: 2,
                        url: 'https://js.devexpress.com/Demos/SalesViewer/odata/DaySaleDtoes',
                        key: 'Id',
                        beforeSend(request) {
                            const year = new Date().getFullYear() - 1;
                            request.params.startDate = `${year}-05-10`;
                            request.params.endDate = `${year}-5-15`;
                        },
                    },
                },
                paging: {
                    pageSize: 10,
                },
                pager: {
                    showPageSizeSelector: true,
                    allowedPageSizes: [10, 25, 50, 100],
                },
                remoteOperations: false,
                searchPanel: {
                    visible: true,
                    highlightCaseSensitive: true,
                },
                groupPanel: {
                    visible: true
                },
                grouping: {
                    autoExpandAll: false,
                },
                allowColumnReordering: true,
                rowAlternationEnabled: true,
                showBorders: true,
                width: '100%',
                columns: [{
                        dataField: 'Product',
                        groupIndex: 0,
                    },
                    {
                        dataField: 'Amount',
                        caption: 'Sale Amount',
                        dataType: 'number',
                        format: 'currency',
                        alignment: 'right',
                    },
                    {
                        dataField: 'Discount',
                        caption: 'Discount %',
                        dataType: 'number',
                        format: 'percent',
                        alignment: 'right',
                        allowGrouping: false,
                        cellTemplate: discountCellTemplate,
                        cssClass: 'bullet',
                    },
                    {
                        dataField: 'SaleDate',
                        dataType: 'date',
                    },
                    {
                        dataField: 'Region',
                        dataType: 'string',
                    },
                    {
                        dataField: 'Sector',
                        dataType: 'string',
                    },
                    {
                        dataField: 'Channel',
                        dataType: 'string',
                    },
                    {
                        dataField: 'Customer',
                        dataType: 'string',
                        width: 150,
                    },
                ],
                onContentReady(e) {
                    if (!collapsed) {
                        collapsed = true;
                        e.component.expandRow(['EnviroCare']);
                    }
                },
            });
        });

        const discountCellTemplate = function(container, options) {
            $('<div/>').dxBullet({
                onIncidentOccurred: null,
                size: {
                    width: 150,
                    height: 35,
                },
                margin: {
                    top: 5,
                    bottom: 0,
                    left: 5,
                },
                showTarget: false,
                showZeroLevel: true,
                value: options.value * 100,
                startScaleValue: 0,
                endScaleValue: 100,
                tooltip: {
                    enabled: true,
                    font: {
                        size: 18,
                    },
                    paddingTopBottom: 2,
                    customizeTooltip() {
                        return {
                            text: options.text
                        };
                    },
                    zIndex: 5,
                },
            }).appendTo(container);
        };

        let collapsed = false;
    </script>
</head>

<body>
    <div class="dx-viewport demo-container">
        <div id="gridContainer"></div>
    </div>
</body>

</html>
