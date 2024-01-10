@include('superadmin.layouts.sidebar')
@include('superadmin.layouts.header')
{{-- @include('superadmin.layouts_baru.content') --}}

<main>
    @yield('container') <!-- Ini adalah tempat untuk konten yang akan digantikan -->
</main>
@include('superadmin.layouts.footer')