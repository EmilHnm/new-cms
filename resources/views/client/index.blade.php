@php
    $route = Route::current()->getName();
    $prefix = Route::current()->getPrefix();
    $path = \Request::path();
    $topCategory = \App\Models\Category::withCount('posts')
    ->orderBy('posts_count', 'desc')
    ->limit(4)
    ->get();
@endphp
@extends('client.client_master')
@section('client')
<main>
    <div class="banner">
    <div class="banner__slider" id="banner-slider">
        <div class="banner__item">
        <div class="banner__item--image">
            <img src="{{ asset('upload/banner.png') }}" alt="" />
        </div>
        <div class="banner__item--content">
            <h1>ReviewNhà</h1>
            <h2>Finding your best home</h2>
        </div>
        </div>
        <div class="banner__item">
        <div class="banner__item--image">
            <img src="{{ asset('upload/banner.png') }}" alt="" />
        </div>
        <div class="banner__item--content">
            <h1>ReviewNhà</h1>
            <h2>Finding your best home 1</h2>
        </div>
        </div>
        <div class="banner__item">
        <div class="banner__item--image">
            <img src="{{ asset('upload/banner.png') }}" alt="" />
        </div>
        <div class="banner__item--content">
            <h1>ReviewNhà</h1>
            <h2>Finding your best home 2</h2>
        </div>
        </div>
    </div>
    <div class="banner__control">
        <div class="dot active" onclick="changeBanner(0)"></div>
        <div class="dot" onclick="changeBanner(1)"></div>
        <div class="dot" onclick="changeBanner(2)"></div>
    </div>
    </div>
    <div class="container">
    <div class="container__control">
        <a href={{ route('client.search.view') }} class="genre {{ $route == 'client.search.view' ? 'active' : '' }}">Tìm kiếm</a>
        <a href={{ route('home') }} class="genre {{ $route == 'home' ? 'active' : '' }}">Tất cả</a>
        @foreach ($topCategory as $category)
            <a href={{ route('client.category.post.view', $category->slug) }} class="genre {{ str_contains($path, $category->slug) ? 'active' : '' }}">{{ $category->name }}</a>
        @endforeach
    </div>
    @yield('index.content')
    </div>
</main>
@endsection
