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
                        <li class="breadcrumb-item active" aria-current="page">จัดการผู้ใช้งานระบบ</li>
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
                            <h1 class="h2">จัดการผู้ใช้งานระบบ</h1>
                            <div class="mb-2 mb-md-0">
                                <div class="btn-group">
                                    <a class="btn btn-main" href="{{ route('manage_users.create') }}" role="button">เพิ่มผู้ใช้งานระบบ</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>รหัส</th>
                                        <th>ชื่อผู้ใช้</th>
                                        <th>อีเมล</th>
                                        <th>ประเภท</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><span class="badge badge-success">{{ $user->type }}</span></td>
                                        <td>
                                            <a class="btn btn-link text-dark" href="{{ route('manage_users.edit',$user->id) }}" role="button" title="แก้ไข">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if ($user->type != 'Admin')
                                            <!-- Trigger delete modal -->
                                            <button type="button" class="btn btn-link text-dark" data-toggle="modal"
                                                data-target="#delete{{ $user->id }}Modal" title="ลบ">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="delete{{ $user->id }}Modal" tabindex="-1" role="dialog"
                                                aria-labelledby="delete{{ $user->id }}ModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title" id="delete{{ $user->id }}ModalLabel">ยืนยันการลบบทความ
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>คุณต้องการลบผู้ใช้งานระบบ รหัส {{ $user->id }} "{{ $user->name }} ตำแหน่ง
                                                                {{ $user->type }}"
                                                                หรือไม่?</p>
                                                            <div class="form-group text-right">
                                                                <form action="{{ route('manage_users.destroy',$user->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">ยกเลิก</button>
                                                                    <button type="submit" class="btn btn-main">ลบข้อมูล</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td>ไม่มีข้อมูล</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{-- Pagination --}}
                            <div class="d-flex justify-content-center">
                                {!! $users->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
