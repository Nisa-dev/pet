@extends('layouts.admin')
@section('title','จัดการฟาร์มสุนัข')
@section('content')
<div id="page-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white shadow-sm">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">แดชบอร์ด</a></li>
                        <li class="breadcrumb-item active" aria-current="page">จัดการฟาร์มสุนัข</li>
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
                            <h1 class="h2">จัดการฟาร์มสุนัข</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">
                                    {{-- Triger add Modal --}}
                                    <button type="button" class="btn btn-main" data-toggle="modal"
                                        data-target="#addDogFarmModal">
                                        เพิ่มฟาร์มสุนัข
                                    </button>
                                    {{-- Add Modal --}}
                                    <div class="modal fade" id="addDogFarmModal" tabindex="-1" role="dialog"
                                        aria-labelledby="addDogFarmModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h4 class="modal-title" id="addDogFarmModalLabel">เพิ่มฟาร์มสุนัข
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('manage_dog_farms.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="dog_farm_count" value="0">
                                                        <div class="form-row">
                                                            <div class="form-group col-md">
                                                                <label>ชื่อฟาร์มสุนัข</label>
                                                                <input type="text" class="form-control"
                                                                    name="dog_farm_name" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-right">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">ยกเลิก</button>
                                                            <button type="submit"
                                                                class="btn btn-main">บันทึกข้อมูล</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>รหัส</th>
                                        <th>ฟาร์ม</th>
                                        <th>จำนวนสุนัข</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dog_farms as $dog_farm)
                                    <tr>
                                        <td>{{ $dog_farm->id }}</td>
                                        <td>{{ $dog_farm->dog_farm_name }}</td>
                                        <td>{{ $dog_farm->dog_farm_count }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-link text-dark" title="ดู"
                                                    href="{{ route('manage_dog_farms.show',[$dog_farm->id, $dog_farm->dog_farm_name]) }}"
                                                    role="button"><i class="fas fa-eye"></i></a>

                                                <!-- Trigger edit modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="แก้ไข"
                                                    data-target="#edit{{ $dog_farm->id }}Modal">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="edit{{ $dog_farm->id }}Modal" tabindex="-1" 
                                                    role="dialog" aria-labelledby="edit{{ $dog_farm->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h4 class="modal-title"
                                                                    id="edit{{ $dog_farm->id }}ModalLabel">
                                                                    แก้ไขฟาร์มสุนัข</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('manage_dog_farms.update',$dog_farm->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="old_value" value="{{ $dog_farm->dog_farm_name}}">
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md">
                                                                            <label>ชื่อฟาร์มสุนัข</label>
                                                                            <input type="text" class="form-control"
                                                                                name="dog_farm_name"
                                                                                value="{{ $dog_farm->dog_farm_name}}"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group text-right">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="submit"
                                                                            class="btn btn-main">บันทึกข้อมูล</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if ($dog_farm->dog_farm_count == 0)
                                                <!-- Trigger delete modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="ลบ"
                                                    data-target="#delete{{ $dog_farm->id }}Modal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete{{ $dog_farm->id }}Modal"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="delete{{ $dog_farm->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="delete{{ $dog_farm->id }}ModalLabel">
                                                                    ยืนยันการลบฟาร์มสุนัข</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>คุณต้องการลบฟาร์มสุนัข รหัส {{ $dog_farm->id }}
                                                                    "{{ $dog_farm->dog_farm_name }}" หรือไม่?</p>
                                                                <div class="form-group text-right">
                                                                    <form
                                                                        action="{{ route('manage_dog_farms.destroy',$dog_farm->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="submit"
                                                                            class="btn btn-main">ลบข้อมูล</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Delete Modal -->
                                                @endif
                                            </div>

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
                                {!! $dog_farms->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
