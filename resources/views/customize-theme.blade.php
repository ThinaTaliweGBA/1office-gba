@extends('layouts.app2')

@push('styles')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f2f2f2;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 20px;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        h1 {
            grid-column: span 2;
            text-align: center;
            padding: 10px;
        }

        .form-grid div {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        label {
            margin-bottom: 5px;
            color: #1e1e2d;
        }

        input[type=color],
        select {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }

        .grid-container {
            display: grid;
            grid-template-columns: 1fr 3fr;
        }

        .asidee,
        .main {
            padding: 20px;
        }

        .button {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            border: 1px solid #ddd;
            background: #eee;
            cursor: pointer;
        }

        button:hover {
            background: #ddd;
        }
    </style>

    <style>
        :root {
            --bs-app-blank-bg: #151521;
            --bs-header-desktop-fixed-bg-color: #1e1e2d;
            --bs-header-desktop-fixed-shadow: none;
            --bs-header-desktop-bottom: #1e1e2d;
            --bs-header-tablet-and-mobile: #1e1e2d;
            --bs-header-tablet-and-mobile-shadow: none;
            --bs-aside-bg-color: #1E1E2D;
            --bs-aside-scrollbar-hover-color: #eaebf0;

            --bs-button-color: {{ $styles->button_color }};
            --text-color: {{ $styles->text_color }};
            --div-border-color: {{ $styles->div_border_color }};
            --paragraph-font-size: {{ $styles->font_size }};
            --paragraph-font-weight: {{ $styles->font_weight }};
            --paragraph-font-family: "{{ $styles->font_family }}";
            --bs-button-border-radius: {{ $styles->border_radius }};
            --paragraph-margin: {{ $styles->paragraph_margin }};
            --div-margin: {{ $styles->div_margin }};
            --div-padding: {{ $styles->div_padding }};
            --bs-body-color-rgb: {{ $styles->body_color_rgb }};
            --bs-body-bg: {{ $styles->body_bg }};
            --bs-body-bg-rgb: {{ $styles->body_bg_rgb }};
            --bs-header-desktop-fixed-bg-color: {{ $styles->header_desktop_fixed_bg_color }};
            --bs-header-desktop-fixed-shadow: {{ $styles->header_desktop_fixed_shadow }};
            --bs-header-tablet-and-mobile: {{ $styles->header_tablet_and_mobile }};
            --bs-header-tablet-and-mobile-shadow: {{ $styles->header_tablet_and_mobile_shadow }};
            --bs-aside-bg-color: {{ $styles->aside_bg_color }};
            --bs-aside-scrollbar-hover-color: {{ $styles->aside_scrollbar_hover_color }};
            --bs-page-bg: {{ $styles->page_bg }};
            --bs-app-blank-bg: {{ $styles->app_blank_bg }};
        }

        body {
            background-color: var(--bsBodyBg);
            font-size: var(--paragraphFontSize);
            font-weight: var(--paragraphFontWeight);
            font-family: var(--paragraphFontFamily);
            color: var(--textColor);
            padding: var(--paragraphMargin);
            height: 100vh;

            margin: 0;
            font-family: var(--bs-body-font-family);
            font-size: var(--bs-body-font-size);
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            color: var(--bs-body-color);
            text-align: var(--bs-body-text-align);
            background-color: var(--bs-body-bg);
        }

        .test {
            background-color: var(--bsBodyBg);
            font-size: var(--paragraphFontSize);
            font-weight: var(--paragraphFontWeight);
            font-family: var(--paragraphFontFamily);
            color: var(--textColor);
            padding: var(--paragraphMargin);
        }

        button {
            background-color: var(--bsButtonColor);
            color: var(--textColor);
            border-radius: var(--bsButtonBorderRadius);
        }

        p {
            font-size: var(--paragraphFontSize);
            font-weight: var(--paragraphFontWeight);
            font-family: var(--paragraphFontFamily);
            color: var(--textColor);
            margin: var(--paragraphMargin);
        }

        div {
            padding: var(--divPadding);
            margin: var(--divMargin);
        }

        .previewer {
            border: 5px solid var(--divBorderColor);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .previewer button {
            border-radius: var(--bsButtonBorderRadius);
        }
    </style>
@endpush

@section('row_content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">



            <!--begin::Alert-->
            <div class="alert alert-dismissible bg-light-danger d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10">
                <!--begin::Close-->
                <button type="button" class="position-absolute top-0 end-0 m-2 btn btn-icon btn-icon-danger"
                    data-bs-dismiss="alert">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </button>
                <!--end::Close-->

                <!--begin::Icon-->
                <i class="ki-duotone ki-information-5 fs-5tx text-danger mb-5"><span class="path1"></span><span
                        class="path2"></span><span class="path3"></span></i>
                <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="text-center">
                    <!--begin::Title-->
                    <h1 class="fw-bold mb-5">Important Note!</h1>
                    <!--end::Title-->

                    <!--begin::Separator-->
                    <div class="separator separator-dashed border-danger opacity-25 mb-5"></div>
                    <!--end::Separator-->

                    <!--begin::Content-->
                    <div class="mb-9 text-dark">
                        Please make sure to save your edits and customizations for them to exist for future use
                        <strong>within this system</strong>.<br/>
                        Navigate to the <a href="/contact" class="fw-bold me-1">contact section</a>, should you want to
                        contact the onwers.
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Alert-->











            <div>
                <h1 style="color: black; border: 3px black solid; background-color: #fff;">Custom Theme Preview</h1>

                <form method="POST" action="{{ url('/save-styles') }}" id="stylesForm" class="form-grid">
                    @csrf
                    <div>
                        <!-- <label for="bodyColor">Choose secondary color:</label> -->
                        <label for="bodyColor">Primary Color:</label>
                        <input type="color" id="bodyColor" name="bodyColor" value="#ff0980"><br>

                        <!-- <label for="bodyBg">Choose tetiary background color:</label> -->
                        <label for="bodyBg">Secondary Color:</label>
                        <input type="color" id="bodyBg" name="bodyBg" value="#ff0630"><br>


                        <label for="bodyBg">Tetiary color:</label>
                        <!-- set to not show by style="display: none;" -->
                        <input type="color" id="bodyBg" name="bodyBg" value="#bd074f"><br>

                    </div>

                    <div>

                        <label for="buttonColor">Button color:</label>
                        <!-- set to not show by style="display: none;" -->
                        <input type="color" id="buttonColor" name="buttonColor" value="#ff0000"><br>

                        <!-- <label for="divBorderColor">Pick a color for the border:</label> -->
                        <label for="divBorderColor">Border color:</label>
                        <!-- set to not show by style="display: none;" -->
                        <input type="color" id="divBorderColor" name="divBorderColor"><br>

                        <label for="textColor">Text color:</label>
                        <!-- set to not show by style="display: none;" -->
                        <input type="color" id="textColor" name="textColor" value="#000540"><br>
                    </div>

                    <div>
                        <label for="fontSize">Font size:</label>
                        <select id="fontSize" name="fontSize">
                            <option value="0.5em">tiny</option>
                            <option value="1em">Small</option>
                            <option value="2em">Medium</option>
                            <option value="3em">Large</option>
                        </select><br>

                        <label for="fontWeight">Font weight:</label>
                        <select id="fontWeight" name="fontWeight">
                            <option value="">None</option>
                            <option value="bold">Bold</option>
                            <option value="bolder">Bolder</option>
                            <option value="lighter">Lighter</option>
                        </select><br>

                        <label for="fontFamily">Font family:</label>
                        <select id="fontFamily" name="fontFamily">
                            <option value="Arial">Arial</option>
                            <option value="Verdana">Verdana</option>
                            <option value="Times New Roman">Times New Roman</option>
                            <option value="Courier New">Courier New</option>
                        </select><br>


                        <label for="buttonBorderRadius">Button style:</label>
                        <select id="buttonBorderRadius" name="buttonBorderRadius">
                            <option value="0px">Square corners</option>
                            <option value="12px">Rounded corners</option>
                        </select><br>
                    </div>

                    <div>
                        <!-- <label for="paragraphMargin">Choose paragraph margin:</label> -->
                        <label for="paragraphMargin">Word Spacing:</label>
                        <select id="paragraphMargin" name="paragraphMargin">
                            <option value="">None</option>
                            <option value="0.5em">Small</option>
                            <option value="1em">Medium</option>
                            <option value="1.5em">Large</option>
                        </select><br>

                        <!-- <label for="divMargin">Choose div margin:</label> -->
                        <label for="divMargin">Outter Spacing:</label>
                        <select id="divMargin" name="divMargin">
                            <option value="">None</option>
                            <option value="10px">Small</option>
                            <option value="15px">Medium</option>
                            <option value="20px">Large</option>
                        </select><br>

                        <!-- <label for="divPadding">Choose div padding:</label> -->
                        <label for="divPadding">Inner Spacing:</label>
                        <select id="divPadding" name="divPadding">
                            <option value="">None</option>
                            <option value="10px">Small</option>
                            <option value="15px">Medium</option>
                            <option value="20px">Large</option>
                        </select><br>

                        <!-- <label for="divPadding">Choose div padding:</label> -->
                        <label for="divPadding">Word Gap:</label>
                        <select id="divPadding" name="divPadding">
                            <option value="">None</option>
                            <option value="10px">Small</option>
                            <option value="15px">Medium</option>
                            <option value="20px">Large</option>
                        </select><br>
                    </div>

                    <!-- <div class="page border border-solid">
                                                    <div class="asidee" style="background-color: ;">
                                                        <p>This is the PRIMARY color</p>
                                                    </div>
                                                    <div class="main">
                                                        <p>This is the SECONDARY color</p>
                                                        <div class="sub-main">
                                                            <p>This is the TETIARY color</p>
                                                            <div class="previewer button test">
                                                                <button onclick="changeStyles()">Change Styles</button>
                                                                <p class="pt-5">This is how your text will show.</p>
                                                                <button onclick="saveStyles()">Save Styles</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->

                    <div class="grid-container" style="grid-column: span 2;">
                        <h1>New Theme Settings</h1>
                        <div class="previewer button test">
                            {{-- <button onclick="changeStyles()">Change Styles</button> --}}
                            <p class="pt-5">This is how your text will show.</p>
                            <button onclick="saveStyles()">Save Styles</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end::Container-->

        <!--end::Content-->
@endsection

    @push('scripts')
        <script>
            function changeStyles() {

                var bodyColor = document.getElementById('bodyBg').value;
                document.documentElement.style.setProperty('--bsBodyBg', bodyColor);

                var buttonColor = document.getElementById('buttonColor').value;
                document.documentElement.style.setProperty('--bsButtonColor', buttonColor);

                var textColor = document.getElementById('textColor').value;
                document.documentElement.style.setProperty('--textColor', textColor);

                var divBorderColor = document.getElementById('divBorderColor').value;
                document.documentElement.style.setProperty('--divBorderColor', divBorderColor);

                var fontSize = document.getElementById('fontSize').value;
                document.documentElement.style.setProperty('--paragraphFontSize', fontSize);

                var fontWeight = document.getElementById('fontWeight').value;
                document.documentElement.style.setProperty('--paragraphFontWeight', fontWeight);

                var fontFamily = document.getElementById('fontFamily').value;
                document.documentElement.style.setProperty('--paragraphFontFamily', fontFamily);

                var borderRadius = document.getElementById('buttonBorderRadius').value;
                document.documentElement.style.setProperty('--bsButtonBorderRadius', borderRadius);

                var paragraphMargin = document.getElementById('paragraphMargin').value;
                document.documentElement.style.setProperty('--paragraphMargin', paragraphMargin);

                var divMargin = document.getElementById('divMargin').value;
                document.documentElement.style.setProperty('--divMargin', divMargin);

                var divPadding = document.getElementById('divPadding').value;
                document.documentElement.style.setProperty('--divPadding', divPadding);

                var bodyColor = document.getElementById('bodyColor').value;
                document.documentElement.style.setProperty('--bs-body-color', bodyColor);

                var bodyBg = document.getElementById('bodyBg').value;
                document.documentElement.style.setProperty('--bs-body-bg', bodyBg);

                var pageBg = document.getElementById('pageBg').value;
                document.documentElement.style.setProperty('--bs-page-bg', pageBg);

            }

            // Listener for changes
            document.getElementById('bodyBg').addEventListener('change', changeStyles);
            document.getElementById('buttonColor').addEventListener('change', changeStyles);
            document.getElementById('textColor').addEventListener('change', changeStyles);
            document.getElementById('divBorderColor').addEventListener('change', changeStyles);
            document.getElementById('fontSize').addEventListener('change', changeStyles);
            document.getElementById('fontWeight').addEventListener('change', changeStyles);
            document.getElementById('fontFamily').addEventListener('change', changeStyles);
            document.getElementById('buttonBorderRadius').addEventListener('change', changeStyles);
            document.getElementById('paragraphMargin').addEventListener('change', changeStyles);
            document.getElementById('divMargin').addEventListener('change', changeStyles);
            document.getElementById('divPadding').addEventListener('change', changeStyles);
            document.getElementById('bodyColor').addEventListener('change', changeStyles);
            document.getElementById('bodyBg').addEventListener('change', changeStyles);


            function saveStyles() {

                var bodyColor = document.getElementById('bodyBg').value;
                document.documentElement.style.setProperty('--bsBodyBg', bodyColor);

                var buttonColor = document.getElementById('buttonColor').value;
                document.documentElement.style.setProperty('--bsButtonColor', buttonColor);

                var textColor = document.getElementById('textColor').value;
                document.documentElement.style.setProperty('--textColor', textColor);

                var divBorderColor = document.getElementById('divBorderColor').value;
                document.documentElement.style.setProperty('--divBorderColor', divBorderColor);

                var fontSize = document.getElementById('fontSize').value;
                document.documentElement.style.setProperty('--paragraphFontSize', fontSize);

                var fontWeight = document.getElementById('fontWeight').value;
                document.documentElement.style.setProperty('--paragraphFontWeight', fontWeight);

                var fontFamily = document.getElementById('fontFamily').value;
                document.documentElement.style.setProperty('--paragraphFontFamily', fontFamily);

                var borderRadius = document.getElementById('buttonBorderRadius').value;
                document.documentElement.style.setProperty('--bsButtonBorderRadius', borderRadius);

                var paragraphMargin = document.getElementById('paragraphMargin').value;
                document.documentElement.style.setProperty('--paragraphMargin', paragraphMargin);

                var divMargin = document.getElementById('divMargin').value;
                document.documentElement.style.setProperty('--divMargin', divMargin);

                var divPadding = document.getElementById('divPadding').value;
                document.documentElement.style.setProperty('--divPadding', divPadding);

                var bodyColor = document.getElementById('bodyColor').value;
                document.documentElement.style.setProperty('--bs-body-color', bodyColor);

                var bodyBg = document.getElementById('bodyBg').value;
                document.documentElement.style.setProperty('--bs-body-bg', bodyBg);



                var bodyColor = document.getElementById('bodyBg').value;
                var buttonColor = document.getElementById('buttonColor').value;
                var textColor = document.getElementById('textColor').value;
                var divBorderColor = document.getElementById('divBorderColor').value;
                var fontSize = document.getElementById('fontSize').value;
                var fontWeight = document.getElementById('fontWeight').value;
                var fontFamily = document.getElementById('fontFamily').value;
                var borderRadius = document.getElementById('buttonBorderRadius').value;
                var paragraphMargin = document.getElementById('paragraphMargin').value;
                var divMargin = document.getElementById('divMargin').value;
                var divPadding = document.getElementById('divPadding').value;
                var bodyColor = document.getElementById('bodyColor').value;
                var bodyBg = document.getElementById('bodyBg').value;

                var data = {
                    bodyColor: bodyColor,
                    buttonColor: buttonColor,
                    textColor: textColor,
                    divBorderColor: divBorderColor,
                    fontSize: fontSize,
                    fontWeight: fontWeight,
                    fontFamily: fontFamily,
                    borderRadius: borderRadius,
                    paragraphMargin: paragraphMargin,
                    divMargin: divMargin,
                    divPadding: divPadding,
                    bodyColor: bodyColor,
                    bodyBg: bodyBg
                };

            }

            function saveStyles() {
                var form = document.getElementById('stylesForm');
                form.submit(); // This line submits the form
            }
        </script>
    @endpush
