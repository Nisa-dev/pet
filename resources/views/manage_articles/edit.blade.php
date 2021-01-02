@extends('layouts.admin')
@section('content')
<div id="page-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white shadow-sm">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">แดชบอร์ด</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('manage_articles.index') }}">จัดการบทความ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">แก้ไขบทความ</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        {{-- Message --}}
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div
                            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h1 class="h2">แก้ไขบทความ</h1>
                        </div>

                        <form action="{{ route('manage_articles.update',$article->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>ชื่อบทความ</label>
                                <input type="text" class="form-control" name="article_name"
                                    value="{{ $article->article_name }}" required>
                            </div>
                            <div class="form-group">
                                <label>เนื้อหาบทความ</label>
                                <textarea class="form-control" name="article_content" rows="4"
                                    required>{{ $article->article_content }}</textarea>
                            </div>
                            <div class="form-group">
                                @if ($article->article_image != null)
                                <label>รูปภาพ</label>
                                <div class="mb-3">
                                    <img src="{{ asset('image/articles/'.$article->article_image) }}" class="rounded"
                                        width="30%">
                                </div>
                                <label>เปลี่ยนรูปภาพ</label>
                                <input type="file" class="form-control" name="article_image">
                                @else
                                <label>รูปภาพ</label>
                                <input type="file" class="form-control" name="article_image">
                                @endif
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-main">บันทึกข้อมูล</button>
                                <button type="reset" class="btn btn-secondary">ยกเลิก</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
