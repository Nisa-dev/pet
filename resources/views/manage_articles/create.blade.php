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
                        <li class="breadcrumb-item active" aria-current="page">เพิ่มบทความ</li>
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

                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h1 class="h2">เพิ่มบทความ</h1>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <form action="{{ route('manage_articles.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>ชื่อบทความ</label>
                                    <input type="text" class="form-control" name="article_name" required>
                                </div>
                                <div class="form-group">
                                    <label>เนื้อหาบทความ</label>
                                    <textarea class="form-control" name="article_content" rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>รูปภาพ</label>
                                    <input type="file" class="form-control" name="article_image">
                                </div>


                          </div>
                          <div class="col-md-6">

                                @csrf
                                <div class="form-group">
                                    <label>ชื่อบทความ ENG <img src="{{ asset('image/en_flag.png') }}" width="20px"</label>
                                    <input type="text" class="form-control" name="article_name_en" required>
                                </div>
                                <div class="form-group">
                                    <label>เนื้อหาบทความ ENG <img src="{{ asset('image/en_flag.png') }}" width="20px"></label>
                                    <textarea class="form-control" name="article_content_en" rows="4" required></textarea>
                                </div>
                          </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-main">บันทึกข้อมูล</button>
                            <button type="reset" class="btn btn-secondary">ยกเลิก</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
