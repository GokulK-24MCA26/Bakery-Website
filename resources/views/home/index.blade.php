@extends('layouts.app')

@section('title', 'GMS Web Studio Bakery | Fresh Cakes & Bakery in Erode')

@section('content')
    @include('home.hero')
    @include('home.stats')
    @include('home.categories')
    @include('home.featured')
    @include('home.why-us')
    @include('home.about-preview')
    @include('home.gallery-preview')
    @include('home.testimonials')
    @include('home.cta-banner')
@endsection
