<!-- sidebar -->
<aside class="page-aside" data-routeName="{{ \Request::route()->getName() }}">
    <!-- accordion menu -->

    <!-- aside brand -->
    <div class="aside-brand">
        <h5>{{ preg_replace('/[^A-Za-z0-9\-]/', '', \Request::route()->getPrefix()) }}</h5>

        {{-- <a href="#">
            <img src="{{ asset('images/logos/logo_with_name.svg') }}" alt="logo">
            <span>{{ preg_replace('/[^A-Za-z0-9\-]/', '', \Request::route()->getPrefix()) }}</span>
        </a> --}}
    </div>
    <!-- End aside-brand -->

    {{-- dashboard aside start --}}
    @if(\Request::route()->getPrefix() == '/dashboard')
        @include('layouts.aside.dashboard')
    @endif
    {{-- dashboard aside end --}}

    {{-- tailor aside start --}}
    @if(\Request::route()->getPrefix() == '/tailor')
        @include('layouts.aside.tailor')
    @endif
    {{-- tailor aside end --}}

    {{-- accounting aside start --}}
    @if(\Request::route()->getPrefix() == '/accounting')
        @include('layouts.aside.accounting')
    @endif
    {{-- accounting aside end --}}

    {{-- Role-Policy aside start --}}
    @if(\Request::route()->getPrefix() == 'role-policy')
        @include('layouts.aside.rolePolicy')
    @endif
    {{-- Role-Policy aside end --}}

    {{-- developer aside start --}}
    @if(\Request::route()->getPrefix() == 'developer')
        @include('layouts.aside.developer')
    @endif
    {{-- developer aside end --}}
</aside>
<!-- End sidebar -->

<!-- page-aside-layer -->
<div class="page-aside-layer"></div>
