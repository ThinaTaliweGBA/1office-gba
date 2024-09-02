<!-- resources/views/components/header/ThemeSwitcher.blade.php -->

<div class="d-flex align-items-center ms-3 ms-lg-4">
    <!--begin::Menu toggle-->
    <a href="#" class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline w-40px h-40px"
       data-kt-menu-trigger="{default:'click', lg: 'hover'}"
       data-kt-menu-attach="parent"
       data-kt-menu-placement="bottom-end">
        <i class="{{ $icon }} fs-1">
            <span class="path1"></span>
            <span class="path2"></span>
            <!-- Additional paths... -->
        </i>
    </a>
    <!--begin::Menu toggle-->
    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
         data-kt-menu="true" data-kt-element="theme-mode-menu">
        @foreach($themes as $theme)
            <!--begin::Menu item-->
            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="{{ $theme['value'] }}">
                    <span class="menu-icon" data-kt-element="icon">
                        <i class="{{ $theme['icon'] }} fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <!-- Additional paths... -->
                        </i>
                    </span>
                    <span class="menu-title">{{ $theme['title'] }}</span>
                </a>
            </div>
            <!--end::Menu item-->
        @endforeach
    </div>
    <!--end::Menu-->
</div>
