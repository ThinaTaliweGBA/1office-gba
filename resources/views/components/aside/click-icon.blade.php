<form method="POST" action="{{ route('logout') }}">
@csrf
<a href="{{ $link }}" class="btn btn-sm btn-icon btn-active-color-primary btn-icon-gray-600 btn-text-gray-600 {{ $class }}" onclick="event.preventDefault();
this.closest('form').submit();">
    <i class="{{ $icon }} fs-1 me-2">
        <span class="path1"></span>
        <span class="path2"></span>
    </i>
    <!--begin::Major-->
    <span class="d-flex flex-shrink-0 fw-bold">{{ $text }}</span>
    <!--end::Major-->
</a>
</form>


