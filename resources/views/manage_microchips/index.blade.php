@extends('layouts.admin')
@section('title','จัดการไมโครชิพ')
@section('content')
<div id="page-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white shadow-sm">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">แดชบอร์ด</a></li>
                        <li class="breadcrumb-item active" aria-current="page">จัดการไมโครชิพ</li>
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

                        {{-- Error --}}
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>เกิดข้อผิดพลาด!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div
                            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h1 class="h2">จัดการไมโครชิพ</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">
                                    {{-- Triger add Modal --}}
                                    <button type="button" class="btn btn-main" data-toggle="modal"
                                        data-target="#addDogFarmModal">
                                        เพิ่มไมโครชิพ
                                    </button>
                                    {{-- Add Modal --}}
                                    <div class="modal fade" id="addDogFarmModal" tabindex="-1" role="dialog"
                                        aria-labelledby="addDogFarmModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h4 class="modal-title" id="addDogFarmModalLabel">เพิ่มไมโครชิพ</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('manage_microchips.store') }}" method="POST"
                                                        class="needs-validation" novalidate>
                                                        @csrf
                                                        <input type="hidden" name="microchip_status" value="0">
                                                        <input type="hidden" name="install_status" value="0">
                                                        <div class="form-row">
                                                            <div class="form-group col-md">
                                                                <label>หมายเลขไมโครชิพ</label>
                                                                <input type="text" class="form-control"
                                                                    name="microchip_no"
                                                                    placeholder="กรอกหมายเลขไมโครชิพ 15 หลัก" required
                                                                    minlength="15" maxlength="15">
                                                                <div class="invalid-feedback">
                                                                    กรุณากรอกหมายเลขไมโครชิพ 15 หลัก
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label>ราคาซื้อ</label>
                                                                <input type="text" class="form-control"
                                                                    name="microchip_buy_price" required>
                                                                <div class="invalid-feedback">
                                                                    กรุณากรอกราคาซื้อ
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>ราคาขาย</label>
                                                                <input type="text" class="form-control"
                                                                    name="microchip_sell_price" required>
                                                                <div class="invalid-feedback">
                                                                    กรุณากรอกราคาขาย
                                                                </div>
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

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manage_microchips.index') }}">ทั้งหมด</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">สถานะ</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('manage_microchips.index_sort_status','0') }}">มีจำหน่าย</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_microchips.index_sort_status','1') }}">รอดำเนินการจัดส่ง</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_microchips.index_sort_status','2') }}">รอยืนยันข้อมูล</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_microchips.index_sort_status','3') }}">ขายแล้ว</a>
                                </div>
                            </li>
                            <li class="nav-item pt-2">
                                <form action="{{route('manage_microchips.search')}}" method="get">
                                    <div class="form-row">
                                        <div class="input-group mb-3">
                                            <input type="search" name="search" class="form-control form-control-sm" placeholder="กรอกหมายเลขไมโครชิพ">
                                            <div class="input-group-append">
                                                <button class="btn btn-main btn-sm" type="submit">
                                                    <i class="fas fa-search"></i> ค้นหา
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>รหัส</th>
                                        <th>หมายเลขไมโครชิพ</th>
                                        <th>ราคาซื้อ</th>
                                        <th>ราคาขาย</th>
                                        <th>สถานะ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($microchips as $microchip)
                                    <tr>
                                        <td>{{ $microchip->id }}</td>
                                        <td>{{ $microchip->microchip_no }}</td>
                                        <td>{{ number_format($microchip->microchip_buy_price) }}</td>
                                        <td>{{ number_format($microchip->microchip_sell_price) }}</td>
                                        <td>
                                            @switch($microchip->microchip_status)
                                            @case(0)
                                            <span class="badge badge-pill badge-main">มีจำหน่าย</span>
                                            @break
                                            @case(1)
                                            <span class="badge badge-pill badge-primary">รอดำเนินการจัดส่ง</span>
                                            @break
                                            @case(2)
                                            <span class="badge badge-pill badge-dark">รอยืนยันข้อมูล</span>
                                            @break
                                            @case(3)
                                            <span class="badge badge-pill badge-success">ขายแล้ว</span>
                                            @break
                                            @endswitch

                                            @switch($microchip->install_status)
                                            @case(0)
                                            @break
                                            @case(1)
                                            <a href="{{route('manage_microchips.show_install',$microchip->id)}}" class="badge badge-pill badge-success">ติดตั้งไมโครชิพแล้ว</a>
                                            @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                {{-- Triger view Modal --}}
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="ดู"
                                                    data-target="#viewDogFarmModal{{$microchip->id}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                {{-- View Modal --}}
                                                <div class="modal fade" id="viewDogFarmModal{{$microchip->id}}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="viewDogFarmModal{{$microchip->id}}Label"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h4 class="modal-title"
                                                                    id="viewDogFarmModal{{$microchip->id}}Label">
                                                                    ข้อมูลไมโครชิพ</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <ul class="list-unstyled">
                                                                        <li>
                                                                            <h3 class="my-2">ไมโครชิพ รหัส
                                                                                {{ $microchip->id }}</h3>
                                                                            <h5 class="my-2">หมายเลขไมโครชิพ
                                                                                {{ $microchip->microchip_no }}</h5>
                                                                        </li>
                                                                        <li class="mb-2">
                                                                            @switch($microchip->microchip_status)
                                                                            @case(0)
                                                                            <span
                                                                                class="badge badge-pill badge-main">มีจำหน่าย</span>
                                                                            @break
                                                                            @case(1)
                                                                            <span
                                                                                class="badge badge-pill badge-primary">รอดำเนินการจัดส่ง</span>
                                                                            @break
                                                                            @case(2)
                                                                            <span
                                                                                class="badge badge-pill badge-dark">รอยืนยันข้อมูล</span>
                                                                            @break
                                                                            @case(3)
                                                                            <span
                                                                                class="badge badge-pill badge-success">ขายแล้ว</span>
                                                                            @break
                                                                            @case(4)
                                                                            <span
                                                                                class="badge badge-pill badge-success">ขายพร้อมติดตั้งไมโครชิพ</span>
                                                                            @break
                                                                            @endswitch
                                                                        </li>
                                                                        <ul>
                                                                            <li><span class="text-main">ราคาซื้อ</span>
                                                                                {{ number_format($microchip->microchip_buy_price, 2) }}
                                                                                บาท
                                                                            </li>
                                                                            <li><span class="text-main">ราคาขาย</span>
                                                                                {{ number_format($microchip->microchip_sell_price, 2) }}
                                                                                บาท
                                                                            </li>
                                                                            @if ($microchip->microchip_status == 3)
                                                                            <li><span class="text-main">เจ้าของ</span>
                                                                                {{ $microchip->microchip_owner }}
                                                                            </li>
                                                                            @endif
                                                                        </ul>
                                                                    </ul>
                                                                </div>
                                                                <div class="form-group text-right">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">ปิด</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if ($microchip->microchip_status == 0)
                                                <!-- Trigger edit modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="แก้ไข"
                                                    data-target="#edit{{ $microchip->id }}Modal">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <a class="btn btn-link text-dark"
                                                    href="{{ route('manage_orders.create_microchip',$microchip->id) }}" title="ขาย"
                                                    role="button"><i class="fas fa-truck"></i></a>

                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="edit{{ $microchip->id }}Modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="edit{{ $microchip->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h4 class="modal-title"
                                                                    id="edit{{ $microchip->id }}ModalLabel">
                                                                    แก้ไขไมโครชิพ</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('manage_microchips.update',$microchip->id) }}"
                                                                    method="POST" class="needs-validation" novalidate>
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="microchip_status"
                                                                        value="{{ $microchip->microchip_status}}">
                                                                        <input type="hidden" name="install_status" value="{{ $microchip->install_status}}">
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md">
                                                                            <label>หมายเลขไมโครชิพ</label>
                                                                            <input type="text" class="form-control"
                                                                                name="microchip_no"
                                                                                value="{{ $microchip->microchip_no}}"
                                                                                placeholder="กรอกหมายเลขไมโครชิพ 15 หลัก"
                                                                                minlength="15" maxlength="15" required>
                                                                            <div class="invalid-feedback">
                                                                                กรุณากรอกหมายเลขไมโครชิพ 15 หลัก
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label>ราคาซื้อ</label>
                                                                            <input type="text" class="form-control"
                                                                                name="microchip_buy_price"
                                                                                value="{{ $microchip->microchip_buy_price}}"
                                                                                required>
                                                                            <div class="invalid-feedback">
                                                                                กรุณากรอกราคาซื้อ
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label>ราคาขาย</label>
                                                                            <input type="text" class="form-control"
                                                                                name="microchip_sell_price"
                                                                                value="{{ $microchip->microchip_sell_price}}"
                                                                                required>
                                                                            <div class="invalid-feedback">
                                                                                กรุณากรอกราคาขาย
                                                                            </div>
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

                                                <!-- Trigger delete modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="ลบ"
                                                    data-target="#delete{{ $microchip->id }}Modal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete{{ $microchip->id }}Modal"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="delete{{ $microchip->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="delete{{ $microchip->id }}ModalLabel">
                                                                    ยืนยันการลบไมโครชิพ</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>คุณต้องการลบไมโครชิพ รหัส {{ $microchip->id }}
                                                                    หมายเลข "{{ $microchip->microchip_no }}"
                                                                    หรือไม่?</p>
                                                                <div class="form-group text-right">
                                                                    <form
                                                                        action="{{ route('manage_microchips.destroy',$microchip->id) }}"
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
                                {!! $microchips->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
