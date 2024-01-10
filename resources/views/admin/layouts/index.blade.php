@include('admin.layouts.sidebar')
@include('admin.layouts.header')
{{-- @include('admin.layouts_baru.content') --}}

<main>
    @yield('container') <!-- Ini adalah tempat untuk konten yang akan digantikan -->
</main>
@include('admin.layouts.footer')