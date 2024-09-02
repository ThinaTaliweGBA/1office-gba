<div class="ms-1 {{ $classes }}">
    <div class="btn btn-sm btn-icon btn-icon-gray-600 btn-active-color-primary position-relative me-n1" data-kt-menu-trigger="click" data-kt-menu-overflow="true" data-kt-menu-placement="top-start">
        <i class="ki-duotone ki-setting-2 fs-1">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--begin::User account menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
        @foreach($items as $item)
            <!--begin::Menu item-->
            <div class="menu-item px-5">
                <a href="{{ $item['url'] }}" class="menu-link px-5">
                    <span class="menu-text">{{ $item['title'] }}</span>
                    @if(isset($item['badge']))
                        <span class="menu-badge">
                            <span class="badge badge-light-danger badge-circle fw-bold fs-7">{{ $item['badge'] }}</span>
                        </span>
                    @endif
                </a>
            </div>
            <!--end::Menu item-->
        @endforeach
    </div>
    <!--end::User account menu-->
</div>
