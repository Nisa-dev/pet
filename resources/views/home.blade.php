@extends('layouts.app')
@section('content')
<header class="masthead" style="background-image: url('{{ asset('image/manage_web/'.$home->home_background_image) }}')">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 text-center">
                <h1 class="display-4 text-main">{{ $home->home_welcome_text }}</h1>
                <p class="lead text-white">@lang("บริการค้นหาเลขที่ไมโครชิพสัตว์เลี้ยง")</p>
                <form action="{{ route('microchip_no.search') }}" method="GET">
                    <div class="d-flex justify-content-center">
                        <div class="form-group col-md-4 pb-0 mb-1">
                            {{-- Message --}}
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade show my-3" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            <input type="text" name="microchip_no" class="form-control mb-2" placeholder="@lang("ป้อนหมายเลข")"
                                required minlength="15" maxlength="15">
                            <button type="submit" class="btn btn-block btn-main">@lang("ค้นหาเลขที่ไมโครชิพ")</button>
                        </div>
                    </div>
                </form>
                @auth
                @if (Auth::user()->type == 'Member')
                <div class="d-flex justify-content-center pt-0 mt-1">
                    <div class="form-group col-md-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-block btn-main" data-toggle="modal"
                            data-target="#exampleModal">
                            @lang("แจ้งความประสงค์ขอติดตั้งไมโครชิพ")
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-white border-0">
                                        <h5 class="modal-title" id="exampleModalLabel">@lang("แจ้งความประสงค์ขอติดตั้งไมโครชิพ")
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('microchip_no.install_search') }}" method="GET">
                                            <input type="text" name="microchip_no" class="form-control mb-2"
                                                placeholder="@lang("ป้อนหมายเลข")" required minlength="15" maxlength="15">
                                            <div class="form-group text-right">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">@lang("ยกเลิก")</button>
                                                <button type="submit" class="btn btn-main">@lang("ยืนยัน")</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                </div>
            </div>
            @endif
            @endauth
        </div>
    </div>
</header>

{{-- Dog Pic --}}
<div class="container-fluid pt-4">
        <div class="row text-center">
                @foreach ($dogs1 as $dog1)
                    <div class="col-lg-2 col-md-4 col-6">
                        <a href="#" class="d-block mx-1 mb-3 h-100" data-toggle="modal"
                            data-target="#viewPicModal{{$dog1->id}}">
                            <img class="img-fluid rounded" src="{{ asset('image/dogs/'.$dog1->dog_image)}}">
                        </a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="viewPicModal{{$dog1->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div id="carouselExampleControls{{$dog1->id}}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="img-fluid rounded" src="{{ asset('image/dogs/'.$dog1->dog_image)}}" width="100%">
                                        </div>
                                        @foreach ($dogs1 as $dog)
                                        <div class="carousel-item">
                                            <img class="img-fluid rounded" src="{{ asset('image/dogs/'.$dog->dog_image)}}" width="100%">
                                        </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls{{$dog1->id}}" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls{{$dog1->id}}" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
{{-- Dog Pic --}}

<div class="container-fluid pb-5">
    <div class="text-center">
        <h2 class="my-4">@lang("บทความล่าสุด")</h2>
    </div>
    <div class="row">
        @forelse ($articles as $article)
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                @if ($article->article_image != null)
                <img class="card-img-top" src="{{ asset('image/articles/'.$article->article_image)}}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $article->article_name }}</h5>
                    <small class="card-text">{{ str_limit($article->article_content, $limit = 200, $end = '...')}}
                        {{-- Triger Modal --}}
                        <a href="#" data-toggle="modal"
                            data-target="#exampleModalLong{{$article->id}}">@lang("อ่านเพิ่มเติม")</a>
                    </small>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong{{$article->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLong{{$article->id}}Title" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title" id="exampleModalLong{{$article->id}}Title">
                                        {{ $article->article_name }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center my-3">
                                        @if ($article->article_image == null)
                                        @else
                                        <img class="img-fluid rounded mb-4"
                                            src="{{ asset('image/articles/'.$article->article_image)}}">
                                        @endif
                                    </div>
                                    <p>{{ $article->article_content }}</p>
                                </div>
                                <div class="modal-footer border-0">
                                    <p class="text-muted text-right">
                                        {{ $article->updated_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <p class="card-text">@lang("ไม่มีบทความ")</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center">
        <a href="{{ url('/articles') }}"><small><i class="fas fa-newspaper"></i> @lang("ดูบทความทั้งหมด")</small></a>
    </div>

    <div class="container-fluid mt-5">
            <div class="text-center">
                <h2 class="my-4">Google Map</h2>
            </div>
        <iframe width="100%" height="350" frameborder="0" style="border-radius:20px"
            src="{{ $home->home_google_map_embed }}"
            allowfullscreen></iframe>
    </div>
</div>
@endsection
