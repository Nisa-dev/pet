@extends('layouts.app')
@section('title', __('เกี่ยวกับเรา -'))
@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="text-center">
        <h1 class="my-4">@lang("เกี่ยวกับเรา")</h1>
    </div>

    <!-- Page Content -->
    <div class="row">
        <div class="col-md-4 text-center">
            <img class="img-fluid rounded" width="80%" src="{{ asset('image/manage_web/'.$about_pic->about_image)}}">
        </div>
        <div class="col-md-8">
              <h3 class="text-main my-3">{{ $about->about_title}}</h3>
              <h3 class="font-weight-bold lead my-3">{{ $about->about_subtitle}}</h3>
              <p class="text-justify">{{ $about->about_content}}</p>
        </div>
    </div>
</div>
@endsection
