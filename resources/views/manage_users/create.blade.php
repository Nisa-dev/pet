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
                        <li class="breadcrumb-item"><a href="{{ route('manage_users.index') }}">จัดการผู้ใช้งานระบบ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">เพิ่มผู้ใช้งานระบบ</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
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

                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h1 class="h2">เพิ่มผู้ใช้งานระบบ</h1>
                        </div>

                        <form action="{{ route('manage_users.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>ชื่อ-นามสกุล</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>ชื่อผู้ใช้</label>
                                    <input type="text" class="form-control" name="username"  required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>อีเมล</label>
                                    <input type="text" class="form-control" name="email"  required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>รหัสผ่าน</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>ประเภทผู้ใช้</label>
                                    <select name="type" class="form-control" required>
                                        <option value="" selected disabled>เลือกประเภทผู้ใช้...</option>
                                        <option value="Member">Member</option>
                                        <option value="Deliveryman">Deliveryman</option>
                                    </select>
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
