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
                        <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลติดต่อเรา</li>
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

                        {{-- Error Message --}}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>เกิดข้อผิดพลาด!</strong><br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div
                            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h1 class="h2">แก้ไขข้อมูลติดต่อเรา</h1>
                        </div>

                        <form action="{{ route('contact_us.update',$contact->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label>ชื่อติดต่อ</label>
                                <input type="text" class="form-control" name="contact_name"
                                    value="{{ $contact->contact_name }}" required>
                            </div>
                            <div class="form-group">
                                <label>ที่อยู่</label>
                                <textarea class="form-control" name="contact_address" rows="3"
                                    required>{{ $contact->contact_address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>เบอร์ติดต่อ</label>
                                <input type="text" class="form-control" name="contact_tel_no"
                                    value="{{ $contact->contact_tel_no }}" required>
                            </div>
                            <div class="form-group">
                                <label>Google Map Link</label>
                                <input type="text" class="form-control" name="contact_google_map_link"
                                    value="{{ $contact->contact_google_map_link }}" required>
                            </div>
                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="text" class="form-control" name="contact_facebook"
                                    value="{{ $contact->contact_facebook }}" required>
                            </div>
                            <div class="form-group">
                                <label>Facebook Link</label>
                                <input type="text" class="form-control" name="contact_facebook_link"
                                    value="{{ $contact->contact_facebook_link }}" required>
                            </div>
                            <div class="form-row">
                                    <div class="form-group col-md-6">
                                            <label>Line QR-Code</label>
                                            <div class="mb-2">
                                                <img src="{{ asset('image/manage_web/'.$contact->contact_line_qr) }}"
                                                    class="rounded" width="200px">
                                            </div>
                                            <label>เปลี่ยนรูปภาพ</label><br>
                                            <input type="file" class="form-input" name="contact_line_qr">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Logo</label>
                                            <div class="mb-2">
                                                <img src="{{ asset('image/manage_web/'.$contact->contact_logo) }}"
                                                    class="rounded" width="40px">
                                            </div>
                                            <label>เปลี่ยนรูปภาพ</label><br>
                                            <input type="file" class="form-input" name="contact_logo">
                                        </div>
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
