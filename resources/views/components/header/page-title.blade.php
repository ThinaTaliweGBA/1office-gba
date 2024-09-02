{{-- <div {{ $attributes->merge(['class' => 'page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-2 pb-5 pb-lg-0 pt-7 pt-lg-0']) }} data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
    <h2 class="d-flex flex-column text-dark fw-bold my-0 fs-1">{!! Breadcrumbs::render() !!}
         <small class="text-muted fs-6 fw-semibold ms-1 pt-1">{!! Breadcrumbs::render() !!}</small> 
    </h2>
</div> --}}


{{-- <div {{ $attributes->merge(['class' => 'page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-2 pb-5 pb-lg-0 pt-7 pt-lg-0']) }} data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
    @if(Breadcrumbs::exists())
        <h2 class="d-flex flex-column text-dark fw-bold my-0 fs-1">
            {!! Breadcrumbs::render() !!}
            <small class="text-muted fs-6 fw-semibold ms-1 pt-1">
                {!! Breadcrumbs::render() !!}
            </small>
        </h2>    
    @endif
</div> --}}

<div {{ $attributes->merge(['class' => 'breadcrumb']) }} data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
            <div class="d-flex align-items-center me-2 border border-secondary rounded">
                <!--begin::Back Button-->
                <div class="btn btn-icon btn-active-color-primary btn-outline w-40px h-40px bg-body border border-body" onclick="window.history.back();" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Go Back" data-bs-custom-class="custom-tooltip">
                    <i class="bi bi-arrow-left" style="font-size: 28px;"></i>
                </div>
                <!--end::Back Button-->
            </div>    
@if(Breadcrumbs::exists())
        <h2 class="fw-bold my-0 fs-2">
            @php
                // Attempt to render breadcrumbs only if all required parameters are available
                try {
                    echo Breadcrumbs::render();
                } catch (\Exception $e) {
                     // Retrieve the current route name
                    $currentRouteName = Route::currentRouteName();

                    //@dump('Current Route Name: ' . $currentRouteName);
                    // Define a simple map of route names to user-friendly titles
                    $titles = [
                        'default' => 'GBA' // Default title
                    ];

                    // Check if there is a custom title for the current route, otherwise use default
                    $pageTitle = $currentRouteName ?? $titles['default'];

                    //echo $pageTitle;
                    echo "<h2 class='d-flex flex-column text-dark fw-bold my-0 fs-2'>$pageTitle</h2>";                   
                    //echo "Default Breadcrumb or Page Title"; // Adjust this as per your needs
                }
            @endphp
        </h2>
    @else
         {{-- <h2 class="d-flex flex-column text-dark fw-bold my-0 fs-1"> --}}
            {{-- {!! Breadcrumbs::render() !!} --}}
            {{-- <small class="text-muted fs-6 fw-semibold ms-1 pt-1"> --}}
                {{-- {!! Breadcrumbs::render() !!} --}}
            {{-- </small> --}}
        {{-- </h2>  --}}
    @endif
</div>