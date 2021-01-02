@extends('layouts.app')
@section('title', __('บทความ -'))
@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="text-center">
        <h1 class="my-4">@lang("บทความ")</h1>
    </div>

    <!-- Page Content -->
    <div class="row">
        @forelse ($articles as $article)
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if ($article->article_image != null)
                <img class="card-img-top" src="{{ asset('image/articles/'.$article->article_image) }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $article->article_name }}</h5>
                    <small class="card-text">{{ str_limit($article->article_content, $limit = 200, $end = '...')}}
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

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {!! $articles->links() !!}
    </div>
</div>
@endsection
