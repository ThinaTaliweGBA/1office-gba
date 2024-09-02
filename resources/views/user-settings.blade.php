@extends('layouts.app2')

@push('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="assets/plugins/custom/leaflet/leaflet.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

	{{-- Start Overlayed Layout Style --}}
    <style>
        .extended-width {
            margin-left: -100px;
            width: calc(100% + 100px);
			border: 1px whitesmoke solid;
        }
    </style>
	{{-- End Overlayed Layout Style --}}
@endpush

@section('row_content')
    <div>
        <div class="card" style="border: 1px solid gray;">
            <!--begin::Body-->
            <div class="card-body p-lg-17">
                <!--begin::Row-->
                <div class="row mb-3">
                    <!--begin::Col-->
                    <div class="col-md-6 pe-lg-10">
                        <!--begin::Form-->
                        <form action="" class="form mb-15" method="post" id="kt_contact_form">
                            <h1 class="fw-bold text-dark mb-9">Send Us Email</h1>
                            <!--begin::Input group-->
                            <div class="row mb-5">
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--begin::Label-->
                                    <label class="fs-5 fw-semibold mb-2">Name</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder=""
                                        name="name" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6 fv-row">
                                    <!--end::Label-->
                                    <label class="fs-5 fw-semibold mb-2">Email</label>
                                    <!--end::Label-->
                                    <!--end::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder=""
                                        name="email" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-5 fv-row">
                                <!--begin::Label-->
                                <label class="fs-5 fw-semibold mb-2">Subject</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="" name="subject" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-10 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Message</label>
                                <textarea class="form-control form-control-solid" rows="6" name="message" placeholder=""></textarea>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Submit-->
                            <button type="submit" class="btn btn-primary" id="kt_contact_submit_button">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Send Feedback</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                <!--end::Indicator progress-->
                            </button>
                            <!--end::Submit-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-md-6 ps-lg-10">
                        <!--begin::Map-->
                        <!-- <div id="kt_contact_map" class="w-100 rounded mb-2 mb-lg-0 mt-2" style="height: 486px"></div> -->
                        <div class="card card-bordered">
                            <div class="card-body">
                                <div id="kt_amcharts_2" style="height: 460px;"></div>
                            </div>
                        </div>
                        <!--end::Map-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row g-5 mb-5 mb-lg-15">
                    <!--begin::Col-->
                    <div class="col-sm-6 pe-lg-10">
                        <!--begin::Phone-->
                        <div class="bg-light card-rounded d-flex flex-column flex-center flex-center p-10 h-100">
                            <!--begin::Icon-->
                            <i class="ki-duotone ki-briefcase fs-3tx text-primary">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <!--end::Icon-->
                            <!--begin::Subtitle-->
                            <h1 class="text-dark fw-bold my-5">Let’s Speak</h1>
                            <!--end::Subtitle-->
                            <!--begin::Number-->
                            <div class="text-gray-700 fw-semibold fs-2">011 873-8630 (Tel)</div>
                            <div class="text-gray-700 fw-semibold fs-2">011 825 1493 (Office)</div>
                            <div class="text-gray-700 fw-semibold fs-2">072 857 2033 (WhatsApp)</div><br>
                            <div class="text-gray-700 fw-semibold fs-2">info@gba.co.za (Email)</div>
                            <!--end::Number-->
                        </div>
                        <!--end::Phone-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-sm-6 ps-lg-10">
                        <!--begin::Address-->
                        <div class="text-center bg-light card-rounded d-flex flex-column flex-center p-10 h-100">
                            <!--begin::Icon-->
                            <i class="ki-duotone ki-geolocation fs-3tx text-primary">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <!--end::Icon-->
                            <!--begin::Subtitle-->
                            <h1 class="text-dark fw-bold my-5">Our Office</h1>
                            <!--end::Subtitle-->
                            <!--begin::Description-->
                            <div class="text-gray-700 fs-3 fw-semibold"> 49 Joubert St, Germiston, Johannesburg, 1401</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Address-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Body-->
        </div>
        <br><br>
		{{-- Start Overlayed Layout Content--}}
        {{-- <div class="card bg-gradient extended-width" style="border: 1px solid gray;">
            <div class="card-body p-lg-17">
                <div class="row mb-3">
                    <div class="col-md-6 pe-lg-10">
                        <form action="{{ route('login') }}" class="form mb-15" method="post" id="kt_login_form">
                            @csrf
                            <h1 class="fw-bold text-dark mb-9">Login Tester</h1>
                            <div class="row mb-5">
                                <div class="col-md-12 fv-row">
                                    <label class="fs-5 fw-semibold mb-2">Email</label>
                                    <input type="email" class="form-control form-control-solid" name="email" required />
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 fv-row">
                                    <label class="fs-5 fw-semibold mb-2">Password</label>
                                    <input type="password" class="form-control form-control-solid" name="password"
                                        required />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" id="kt_login_submit_button">
                                <span class="indicator-label">Login</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </form>
                        <a href="{{ route('register') }}" class="mt-3">Don't have an account? Register</a>
                    </div>
                    <!-- You can keep the other part of the code as it is, or remove it based on your requirements -->
                </div>
            </div>
        </div> --}}
		{{-- End Overlayed Layout content --}}
    </div>
@endsection

@push('scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="assets/plugins/custom/leaflet/leaflet.bundle.js"></script>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <script>
        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("kt_amcharts_2");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            // Create the map chart
            // https://www.amcharts.com/docs/v5/charts/map-chart/
            var chart = root.container.children.push(am5map.MapChart.new(root, {
                panX: "rotateX",
                panY: "translateY",
                projection: am5map.geoMercator(),
                homeGeoPoint: {
                    latitude: 2,
                    longitude: 2
                }
            }));

            var cont = chart.children.push(am5.Container.new(root, {
                layout: root.horizontalLayout,
                x: 20,
                y: 40
            }));

            // Add labels and controls
            cont.children.push(am5.Label.new(root, {
                centerY: am5.p50,
                text: "Map"
            }));

            var switchButton = cont.children.push(am5.Button.new(root, {
                themeTags: ["switch"],
                centerY: am5.p50,
                icon: am5.Circle.new(root, {
                    themeTags: ["icon"]
                })
            }));

            switchButton.on("active", function() {
                if (!switchButton.get("active")) {
                    chart.set("projection", am5map.geoMercator());
                    chart.set("panY", "translateY");
                    chart.set("rotationY", 0);
                    backgroundSeries.mapPolygons.template.set("fillOpacity", 0);
                } else {
                    chart.set("projection", am5map.geoOrthographic());
                    chart.set("panY", "rotateY")

                    backgroundSeries.mapPolygons.template.set("fillOpacity", 0.1);
                }
            });

            cont.children.push(
                am5.Label.new(root, {
                    centerY: am5.p50,
                    text: "Globe"
                })
            );

            // Create series for background fill
            // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/#Background_polygon
            var backgroundSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {}));
            backgroundSeries.mapPolygons.template.setAll({
                fill: root.interfaceColors.get("alternativeBackground"),
                fillOpacity: 0,
                strokeOpacity: 0
            });

            // Add background polygon
            // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/#Background_polygon
            backgroundSeries.data.push({
                geometry: am5map.getGeoRectangle(90, 180, -90, -180)
            });

            // Create main polygon series for countries
            // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/
            var polygonSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
                geoJSON: am5geodata_worldLow
            }));

            // Create line series for trajectory lines
            // https://www.amcharts.com/docs/v5/charts/map-chart/map-line-series/
            var lineSeries = chart.series.push(am5map.MapLineSeries.new(root, {}));
            lineSeries.mapLines.template.setAll({
                stroke: root.interfaceColors.get("alternativeBackground"),
                strokeOpacity: 0.3
            });

            // Create point series for markers
            // https://www.amcharts.com/docs/v5/charts/map-chart/map-point-series/
            var pointSeries = chart.series.push(am5map.MapPointSeries.new(root, {}));

            pointSeries.bullets.push(function() {
                var circle = am5.Circle.new(root, {
                    radius: 7,
                    tooltipText: "Drag me!",
                    cursorOverStyle: "pointer",
                    tooltipY: 0,
                    fill: am5.color(0xffba00),
                    stroke: root.interfaceColors.get("background"),
                    strokeWidth: 2,
                    draggable: true
                });

                circle.events.on("dragged", function(event) {
                    var dataItem = event.target.dataItem;
                    var projection = chart.get("projection");
                    var geoPoint = chart.invert({
                        x: circle.x(),
                        y: circle.y()
                    });

                    dataItem.setAll({
                        longitude: geoPoint.longitude,
                        latitude: geoPoint.latitude
                    });
                });

                return am5.Bullet.new(root, {
                    sprite: circle
                });
            });

            var paris = addCity({
                latitude: 48.8567,
                longitude: 2.351
            }, "Paris");
            var toronto = addCity({
                latitude: 43.8163,
                longitude: -79.4287
            }, "Toronto");
            var la = addCity({
                latitude: 34.3,
                longitude: -118.15
            }, "Los Angeles");
            var havana = addCity({
                latitude: 23,
                longitude: -82
            }, "Havana");

            var pretoria = addCity({
                latitude: -25.7479,
                longitude: 28.2293
            }, "Pretoria");
            var capeTown = addCity({
                latitude: -33.9249,
                longitude: 18.4241
            }, "Cape Town");
            var durban = addCity({
                latitude: -29.8587,
                longitude: 31.0218
            }, "Durban");
            var kimberley = addCity({
                latitude: -28.7323,
                longitude: 24.7623
            }, "Kimberley");

            var lineDataItem = lineSeries.pushDataItem({
                pointsToConnect: [paris, havana, pretoria, durban, kimberley, capeTown]
            });

            var planeSeries = chart.series.push(am5map.MapPointSeries.new(root, {}));

            var plane = am5.Graphics.new(root, {
                svgPath: "m2,106h28l24,30h72l-44,-133h35l80,132h98c21,0 21,34 0,34l-98,0 -80,134h-35l43,-133h-71l-24,30h-28l15,-47",
                scale: 0.06,
                centerY: am5.p50,
                centerX: am5.p50,
                fill: am5.color(0x000000)
            });

            planeSeries.bullets.push(function() {
                var container = am5.Container.new(root, {});
                container.children.push(plane);
                return am5.Bullet.new(root, {
                    sprite: container
                });
            });

            var planeDataItem = planeSeries.pushDataItem({
                lineDataItem: lineDataItem,
                positionOnLine: 0,
                autoRotate: true
            });

            planeDataItem.animate({
                key: "positionOnLine",
                to: 1,
                duration: 10000,
                loops: Infinity,
                easing: am5.ease.yoyo(am5.ease.linear)
            });

            planeDataItem.on("positionOnLine", function(value) {
                if (value >= 0.99) {
                    plane.set("rotation", 180);
                } else if (value <= 0.01) {
                    plane.set("rotation", 0);
                }
            });

            function addCity(coords, title) {
                return pointSeries.pushDataItem({
                    latitude: coords.latitude,
                    longitude: coords.longitude
                });
            }

            // Make stuff animate on load
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>
@endpush
