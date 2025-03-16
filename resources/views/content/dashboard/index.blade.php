@extends('layout.base')

@section('title')
Dashboard
@endsection
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
            <!-- if breadcrumb is single--><span>Home</span>
        </li>
        <li class="breadcrumb-item active"><span>Dashboard</span></li>
    </ol>
</nav>
@endsection
@section('content')
<div class="container-lg">
    <iframe style="width:90%" src="https://www.youtube.com/embed/T3qqRZhWzDI?si=sVzNQRrA-rPIs3uA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
</div>
@endsection