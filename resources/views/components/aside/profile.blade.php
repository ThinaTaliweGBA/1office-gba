    <div class="d-flex align-items-center flex-column {{ $attributes->get('class') }}">
        <!--begin::Symbol-->
        <div class="symbol symbol-75px mb-4 position-relative">
            <img src="{{ $profileImg }}" alt="" class="rounded-3 border border-secondary" />
            <div class="position-absolute top-0 end-0 rounded-circle p-1" style="z-index: -0.7;">
                <a class="icon-link icon-link-hover" href="{{ $profileLink }}"><i class="fa fa-gear spin-on-hover" style="font-size:18px"></i></a>   
            </div>
        </div>
        <!--end::Symbol-->
        <!--begin::Info-->
        <div class="text-center">
            <!--begin::Username-->
            <a href="{{ $profileLink }}"
                class="text-gray-800 text-hover-primary fs-4 fw-bolder">{{ $name }}</a>
            <!--end::Username-->
            <!--begin::Description-->
            <span class="text-gray-600 fw-semibold d-block fs-7 mb-1">{{ $description }}</span>
            <!--end::Description-->
        </div>
        <!--end::Info-->
    </div>
