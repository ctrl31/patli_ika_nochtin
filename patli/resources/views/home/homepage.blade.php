@extends ('layouts.app')



@section('content')

@include('home.banner')
@include('home.health')
@include('home.news')
@include('home.client')


@endsection


@section('scripts')
<script src="{{ asset('resources/js/bootstrap.js') }}"></script>
<script src="{{ asset('resources/js/bootstrap copy.js') }}"></script>
<script src="{{ asset('resources/js/jquery.validate.js') }}"></script>
<script src="{{ asset('resources/js/bootstrap.bundle.js') }}"></script>
<script src="{{ asset('resources/js/slider-setting.js') }}"></script>
<script src="{{ asset('resources/js/popper.min.js') }}"></script>
<script src="{{ asset('resources/js/plugin.js') }}"></script>
<script src="{{ asset('resources/js/jquery.validate.js') }}"></script>
<script src="{{ asset('resources/js/modernizer.js') }}"></script>
<script src="{{ asset('resources/js/jquery-3.0.0.min.js') }}"></script>
<script src="{{ asset('resources/js/bootstrap.min.js.js') }}"></script>
<script src="{{ asset('resources/js/custom.js') }}"></script>
<script src="{{ asset('resources/js/custom.js') }}"></script>
<script src="{{ asset('resources/js/custom.js') }}"></script>
@endsection
