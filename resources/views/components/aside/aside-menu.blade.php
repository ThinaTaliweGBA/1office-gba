@props(['menuTitle', 'menuIcon', 'menuItems'])

@php
    $isActive = collect($menuItems)->contains(function ($item) {
        return request()->is(ltrim($item['url'], '/'));
    });
@endphp

<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ $isActive ? 'here show' : '' }}">
    <span class="menu-link">
        <span class="menu-icon">
            <i class="{{ $menuIcon }} fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </span>
        <span class="menu-title">{{ $menuTitle }}</span>
        <span class="menu-arrow"></span>
    </span>
    <div class="menu-sub menu-sub-accordion {{ $isActive ? 'menu-active-bg show' : '' }}">
        @foreach ($menuItems as $item)
        <div class="menu-item">
            <a class="menu-link {{ request()->is(ltrim($item['url'], '/')) ? 'active' : '' }}" href="{{ $item['url'] }}">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">{{ $item['title'] }}</span>
            </a>
        </div>
        @endforeach
    </div>
</div>
