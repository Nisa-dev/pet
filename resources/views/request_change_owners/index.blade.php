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
                        <li class="breadcrumb-item active" aria-current="page">คำขอเปลี่ยนเจ้าของ</li>
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
                            <h1 class="h2">คำขอเปลี่ยนเจ้าของ</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัส</th>
                                        <th>สุนัข</th>
                                        <th>หมายเลขไมโครชิพ</th>
                                        <th>วันที่ขอเปลี่ยนข้อมูล</th>
                                        <th>สถานะ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($request_changes as $request_change)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $request_change->id }}</td>
                                        <td>{{ $request_change->install_microchip_breed }}
                                            {{ $request_change->install_microchip_color }}
                                            {{ $request_change->install_microchip_sex }}</td>
                                        <td>{{ $request_change->install_microchip_no }}</td>
                                        <td>{{ date('d/m/Y', strtotime($request_change->created_at)) }}</td>
                                        <td>
                                            @if ($request_change->request_change_owner_status == 0)
                                            <span class="badge badge-pill badge-dark">รอยืนยันข้อมูล</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Trigger confrim modal -->
                                            <button type="button" class="btn btn-link text-dark" data-toggle="modal"
                                                data-target="#comfirm{{ $request_change->id }}Modal">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <!-- Cimfirm Modal -->
                                            <div class="modal fade" id="comfirm{{ $request_change->id }}Modal"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="comfirm{{ $request_change->id }}ModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title"
                                                                id="comfirm{{ $request_change->id }}ModalLabel">
                                                                ยืนยันคำขอเปลี่ยนข้อมูลเจ้าของ
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>
                                                                <p>{{ $request_change->install_microchip_breed }}
                                                                    {{ $request_change->install_microchip_color }}
                                                                    {{ $request_change->install_microchip_sex }}
                                                                    รหัส {{ $request_change->install_microchip_no }}
                                                                </p>
                                                            </h5>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong class="text-danger">ข้อมูลเจ้าของ
                                                                        (เดิม)</strong>
                                                                    <p>ชื่อเจ้าของ {{$request_change->old_owner_name}}
                                                                        เบอร์โทร
                                                                        {{$request_change->old_owner_tel_no}}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong class="text-success">ข้อมูลเจ้าของ
                                                                        (ใหม่)</strong>
                                                                    <p>ชื่อเจ้าของ
                                                                        {{$request_change->request_change_owner_name}}
                                                                        เบอร์โทร
                                                                        {{$request_change->request_change_owner_tel_no}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong class="text-danger">ข้อมูลที่อยู่
                                                                        (เดิม)</strong>
                                                                    <p>
                                                                        บ้านเลขที่
                                                                        {{$request_change->old_owner_house_no}} หมู่ที่
                                                                        {{$request_change->old_owner_village_no}} ซอย
                                                                        {{$request_change->old_owner_lane}} ถนน
                                                                        {{$request_change->old_owner_road}} จังหวัด
                                                                        {{$request_change->old_owner_province}} อำเภอ
                                                                        {{$request_change->old_owner_amphures}} ตำบล
                                                                        {{$request_change->old_owner_districts}}
                                                                        หมายเลขไปรณีย์
                                                                        {{$request_change->old_owner_post_no}}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <strong class="text-success">ข้อมูลที่อยู่
                                                                        (ใหม่)</strong>
                                                                    <p>
                                                                        บ้านเลขที่
                                                                        {{$request_change->request_change_owner_house_no}}
                                                                        หมู่ที่
                                                                        {{$request_change->request_change_owner_village_no}}
                                                                        ซอย
                                                                        {{$request_change->request_change_owner_lane}}
                                                                        ถนน
                                                                        {{$request_change->request_change_owner_road}}
                                                                        จังหวัด
                                                                        {{$request_change->request_change_owner_province}}
                                                                        อำเภอ
                                                                        {{$request_change->request_change_owner_amphures}}
                                                                        ตำบล
                                                                        {{$request_change->request_change_owner_districts}}
                                                                        หมายเลขไปรณีย์
                                                                        {{$request_change->request_change_owner_post_no}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <form
                                                                action="{{ route('request_change_owners.confirm',$request_change->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="request_change_owner_status"
                                                                    value="{{ $request_change->request_change_owner_status}}">
                                                                <input type="hidden" name="install_microchip_id"
                                                                    value="{{ $request_change->install_microchip_id}}">
                                                                <input type="hidden" name="microchip_id"
                                                                    value="{{ $request_change->microchip_id}}">
                                                                <input type="hidden" name="dog_id"
                                                                    value="{{ $request_change->dog_id}}">
                                                                <input type="hidden" name="request_change_owner_name"
                                                                    value="{{ $request_change->request_change_owner_name}}">
                                                                <input type="hidden" name="request_change_owner_tel_no"
                                                                    value="{{ $request_change->request_change_owner_tel_no}}">
                                                                <input type="hidden"
                                                                    name="request_change_owner_house_no"
                                                                    value="{{ $request_change->request_change_owner_house_no}}">
                                                                <input type="hidden"
                                                                    name="request_change_owner_village_no"
                                                                    value="{{ $request_change->request_change_owner_village_no}}">
                                                                <input type="hidden" name="request_change_owner_lane"
                                                                    value="{{ $request_change->request_change_owner_lane}}">
                                                                <input type="hidden" name="request_change_owner_road"
                                                                    value="{{ $request_change->request_change_owner_road}}">
                                                                <input type="hidden"
                                                                    name="request_change_owner_province"
                                                                    value="{{ $request_change->request_change_owner_province}}">
                                                                <input type="hidden"
                                                                    name="request_change_owner_amphures"
                                                                    value="{{ $request_change->request_change_owner_amphures}}">
                                                                <input type="hidden"
                                                                    name="request_change_owner_districts"
                                                                    value="{{ $request_change->request_change_owner_districts}}">
                                                                <input type="hidden" name="request_change_owner_post_no"
                                                                    value="{{ $request_change->request_change_owner_post_no}}">
                                                                <div class="form-group text-right">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">ยกเลิก</button>
                                                                    <button type="submit"
                                                                        class="btn btn-main">อนุมัติ</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Cimfirm Modal -->
                                            <!-- Trigger cancel modal -->
                                            <button type="button" class="btn btn-link text-dark" data-toggle="modal"
                                                data-target="#cancel{{ $request_change->id }}Modal">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                            <!-- Cancel Modal -->
                                            <div class="modal fade" id="cancel{{ $request_change->id }}Modal"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="cancel{{ $request_change->id }}ModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title"
                                                                id="cancel{{ $request_change->id }}ModalLabel">
                                                                ไม่อนุมัติคำขอเปลี่ยนข้อมูลเจ้าของ
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>คุณต้องการยืนยันไม่อนุมัติคำขอเปลี่ยนข้อมูลเจ้าของ
                                                                "{{ $request_change->install_microchip_breed }}
                                                                {{ $request_change->install_microchip_color }}
                                                                {{ $request_change->install_microchip_sex }}
                                                                รหัส {{ $request_change->install_microchip_no }}"
                                                                หรือไม่?
                                                            </p>
                                                            <div class="form-group text-right">
                                                                <form
                                                                    action="{{ route('request_change_owners.delete',$request_change->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">ยกเลิก</button>
                                                                    <button type="submit"
                                                                        class="btn btn-main">ยืนยัน</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                {!! $request_changes->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
