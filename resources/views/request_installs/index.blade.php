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
                        <li class="breadcrumb-item active" aria-current="page">คำขอติดตั้งไมโครชิพ</li>
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
                            <h1 class="h2">คำขอติดตั้งไมโครชิพ</h1>
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
                                        <th>วันที่จองติดตั้ง</th>
                                        <th>สถานะ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($request_installs as $request_install)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $request_install->id }}</td>
                                        <td>{{ $request_install->install_microchip_breed }}
                                            {{ $request_install->install_microchip_color }}
                                            {{ $request_install->install_microchip_sex }}</td>
                                        <td>{{ $request_install->install_microchip_no }}</td>
                                        <td>{{ date('d/m/Y', strtotime($request_install->install_microchip_booking_date)) }}</td>
                                        <td>
                                            @if ($request_install->install_microchip_status == 0)
                                            <span class="badge badge-pill badge-dark">รอยืนยันข้อมูล</span>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Trigger confrim modal -->
                                            <button type="button" class="btn btn-link text-dark" data-toggle="modal"
                                                data-target="#comfirm{{ $request_install->id }}Modal">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <!-- Confirm Modal -->
                                            <div class="modal fade" id="comfirm{{ $request_install->id }}Modal"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="comfirm{{ $request_install->id }}ModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title"
                                                                id="comfirm{{ $request_install->id }}ModalLabel">
                                                                ยืนยันคำขอติดตั้งไมโครชิพ
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                คุณต้องการอนุมัติคำขอติดตั้งไมโครชิพหรือไม่?
                                                            </p>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    @if ($request_install->install_microchip_image ==
                                                                    null)
                                                                    <img src="{{asset('image/no_img.jpg')}}"
                                                                        class="img-fluid rounded" width="450px">
                                                                    @else
                                                                    <img class="img-fluid rounded"
                                                                        src="{{ asset('image/dogs/'.$request_install->install_microchip_image)}}"
                                                                        width="450px">
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h3 class="my-3">
                                                                        {{ $request_install->install_microchip_breed }}
                                                                        {{ $request_install->install_microchip_color }}
                                                                        {{ $request_install->install_microchip_sex }}
                                                                    </h3>
                                                                    <h5 class="my-3">
                                                                        หมายเลขไมโครชิพ
                                                                        {{ $request_install->install_microchip_no }}
                                                                    </h5>
                                                                    @if ($request_install->install_microchip_birth_date
                                                                    != null)
                                                                    <h5 class="my-3">วันเกิด
                                                                        {{ $request_install->install_microchip_birth_date }}
                                                                    </h5>
                                                                    @endif
                                                                    <ul class="list-unstyled">
                                                                        <ul>
                                                                            <li><span class="text-main">วันที่จองติดตั้ง
                                                                                </span>
                                                                                {{$request_install->install_microchip_booking_date}}
                                                                            <li><span
                                                                                    class="text-main">ชื่อเจ้าของ</span>
                                                                                {{$request_install->install_microchip_owner_name}}
                                                                            </li>
                                                                            <li><span class="text-main">เบอร์โทร</span>
                                                                                {{$request_install->install_microchip_owner_tel_no}}
                                                                            </li>
                                                                            <li><span class="text-main">ที่อยู่</span>
                                                                                <p>
                                                                                    บ้านเลขที่
                                                                                    {{$request_install->install_microchip_owner_house_no}}
                                                                                    หมู่ที่
                                                                                    {{$request_install->install_microchip_owner_village_no}}
                                                                                    ซอย
                                                                                    {{$request_install->install_microchip_owner_lane}}
                                                                                    ถนน
                                                                                    {{$request_install->install_microchip_owner_road}}
                                                                                    จังหวัด
                                                                                    {{$request_install->install_microchip_owner_province}}
                                                                                    อำเภอ
                                                                                    {{$request_install->install_microchip_owner_amphures}}
                                                                                    ตำบล
                                                                                    {{$request_install->install_microchip_owner_districts}}
                                                                                    หมายเลขไปรณีย์
                                                                                    {{$request_install->install_microchip_owner_post_no}}
                                                                                </p>
                                                                            </li>
                                                                            <li><span class="text-main">ชื่อสัตวแพทย์</span>
                                                                                {{$request_install->install_microchip_veterinarian}}
                                                                            </li>
                                                                            <li><span class="text-main">ที่อยู่สัตวแพทย์</span>
                                                                                {{$request_install->install_microchip_veterinarian_address}}
                                                                            </li>
                                                                            <li><span class="text-main">เบอร์โทร</span>
                                                                                {{$request_install->install_microchip_veterinarian_tel_no}}
                                                                            </li>
                                                                        </ul>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <form
                                                                action="{{ route('request_install.confirm',$request_install->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="install_microchip_id"
                                                                    value="{{ $request_install->install_microchip_id}}">
                                                                <input type="hidden" name="microchip_id"
                                                                    value="{{ $request_install->microchip_id}}">
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
                                            <!-- Confirm Modal -->
                                            <!-- Trigger cancel modal -->
                                            <button type="button" class="btn btn-link text-dark" data-toggle="modal"
                                                data-target="#cancel{{ $request_install->id }}Modal">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                            <!-- Cancel Modal -->
                                            <div class="modal fade" id="cancel{{ $request_install->id }}Modal"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="cancel{{ $request_install->id }}ModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title"
                                                                id="cancel{{ $request_install->id }}ModalLabel">
                                                                ไม่อนุมัติคำขอติดตั้งไมโครชิพ
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>คุณต้องการยืนยันไม่อนุมัติคำขอติดตั้งไมโครชิพ
                                                                "{{ $request_install->install_microchip_breed }}
                                                                {{ $request_install->install_microchip_color }}
                                                                {{ $request_install->install_microchip_sex }}
                                                                หมายเลขไมโครชิพ
                                                                {{ $request_install->install_microchip_no }}"
                                                                หรือไม่?
                                                            </p>
                                                            <div class="form-group text-right">
                                                                <form
                                                                    action="{{ route('request_install.delete',$request_install->id) }}"
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
                                {!! $request_installs->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
