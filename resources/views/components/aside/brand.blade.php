<div {{ $attributes->merge(['class' => 'aside-logo flex-column-auto px-9 mb-9 mb-lg-17 mx-auto']) }} id="kt_aside_logo">
    <!--begin::Logo-->
    <a href="{{ $href }}">
        <img alt="Logo" src="{{ $logoLight }}" class="h-30px logo theme-light-show" />
        <img alt="Logo" src="{{ $logoDark }}" class="h-30px logo theme-dark-show" />
    </a>
    <!--end::Logo-->
</div>
