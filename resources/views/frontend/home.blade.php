{{-- extend app layout --}}
@extends('frontend.layouts.app')
{{-- content --}}
@section('content')
    {{-- include components --}}
    @include('frontend.components.banner')
    @include('frontend.components.services')
    @include('frontend.components.portfolio')
    @include('frontend.components.about')
    @include('frontend.components.team')
    @include('frontend.components.contact')
@endsection
