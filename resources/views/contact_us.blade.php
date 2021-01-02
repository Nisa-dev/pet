@extends('layouts.app')
@section('title', __('ติดต่อเรา -'))
@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="text-center">
        <h1 class="mt-4">@lang("ติดต่อเรา")</h1>
        <h3 class="text-main mb-4">{{ $contact->contact_name }}</h3>
    </div>

    <!-- Page Content -->
    <div class="row d-flex justify-content-center text-center">
        <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
            <span class="contact-icon rounded-circle mx-auto mb-3">
                <i class="fas fa-map-marker-alt"></i>
            </span>
            <h4>
                <strong>@lang("ที่อยู่")</strong>
            </h4>
            <a href="{{$contact->contact_google_map_link}}" target="_blank">
                <p class="text-faded mb-0">{{ $contact->contact_address }}</p>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-5 mb-lg-0">
            <span class="contact-icon rounded-circle mx-auto mb-3">
                <i class="fas fa-mobile"></i>
            </span>
            <h4>
                <strong>@lang("เบอร์ติดต่อ")</strong>
            </h4>
            <p class="text-faded mb-0">{{ $contact->contact_tel_no }}</p>
        </div>
        <div class="col-lg-3 col-md-6 mb-5 mb-md-0">
            <span class="contact-icon rounded-circle mx-auto mb-3">
                <i class="fab fa-facebook-f"></i>
            </span>
            <h4>
                <strong>Facebook</strong>
            </h4>
            <a href="{{ $contact->contact_facebook_link }}" target="_blank">
                <p class="text-faded mb-0">{{ $contact->contact_facebook }}</p>
            </a>
        </div>
    </div>

    <div class="text-center my-4">
        <h4 class="mb-4"><strong>Line QR-Code</strong></h4>
        <img src="{{asset('image/manage_web/'.$contact->contact_line_qr) }}" class="rounded shadow" width="200px">
    </div>
</div>
@endsection
