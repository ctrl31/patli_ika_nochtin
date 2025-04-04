@extends ('layouts.app')



@section('content')

@include('home.banner')
+
@include('home.health')
@include('home.news')
@php
    $contacts = [
        ['name' => '🚑 Ambulancia', 'phone' => '911', 'location' => 'Servicio Nacional'],
        ['name' => '🔥 Bomberos', 'phone' => '911', 'location' => 'Servicio Nacional'],
        ['name' => '👮 Policía', 'phone' => '911', 'location' => 'Servicio Nacional'],
        ['name' => '➕ Cruz Roja', 'phone' => '+52 55 5557 5757', 'location' => 'México'],
        ['name' => '🏥 Hospital General', 'phone' => '+52 55 1234 5678', 'location' => 'CDMX'],
    ];
@endphp

@include('home.card', ['contacts' => $contacts])
@include('home.client')


@endsection




@section('scripts')



<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.js.map') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js.map') }}"></script>
<script src="{{ asset('js/bootstrap.js.map') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js.map') }}"></script>
<script src="{{ asset('/js/custom.js') }}"></script>
<script src="{{ asset('/js/jquery-3.0.0.min.js') }}"></script>
<script src="{{ asset('/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/jquery.validate.js') }}"></script>
<script src="{{ asset('/js/plugin.js') }}"></script>
<script src="{{ asset('/js/popper.js') }}"></script>
<script src="{{ asset('/js/popper.min.js') }}"></script>
<script src="{{ asset('/js/slider-setting.js') }}"></script>
@endsection