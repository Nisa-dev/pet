@extends('layouts.deliveryman')
@section('content')
<div id="page-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                {{-- Breadcrumb --}}
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-white shadow-sm">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.deliveryman') }}">แดชบอร์ด</a></li>
                        <li class="breadcrumb-item active" aria-current="page">จัดการรายการจัดส่งสินค้า</li>
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
                        {{-- Message --}}
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
                            <h1 class="h2">จัดการรายการจัดส่งสินค้า</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">

                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manage_orders.index_deliveryman') }}">ทั้งหมด</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">สถานะ</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('manage_orders.index_deliveryman_sort_status','0') }}">รอดำเนินการจัดส่ง</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_orders.index_deliveryman_sort_status','1') }}">รอยืนยันข้อมูล</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_orders.index_deliveryman_sort_status','2') }}">จัดส่งใหม่</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_orders.index_deliveryman_sort_status','3') }}">จัดส่งแล้ว</a>
                                </div>
                            </li>
                        </ul>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>รหัส</th>
                                        <th>รายการ</th>
                                        <th>ช่องทางส่ง</th>
                                        <th>วันที่สร้างรายการ</th>
                                        <th>วันที่ส่งสินค้า</th>
                                        <th>สถานะ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        @if ($order->order_dog != null && $order->order_microchip == null)
                                        <td>{{ $order->order_dog }}</td>
                                        @elseif ($order->order_microchip != null && $order->order_dog == null)
                                        <td>{{ $order->order_microchip }}</td>
                                        @elseif ($order->order_dog != null && $order->order_microchip != null)
                                        <td>{{ $order->order_dog }} ,<br> {{ $order->order_microchip }}</td>
                                        @endif
                                        <td>{{ $order->order_transport }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        @if ($order->order_status == 3)
                                            <td>{{ $order->updated_at->format('d/m/Y') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>
                                            @switch($order->order_status)
                                            @case(0)
                                            <span class="badge badge-pill badge-primary">รอดำเนินการจัดส่ง</span>
                                            @break
                                            @case(1)
                                            <span class="badge badge-pill badge-dark">รอยืนยันข้อมูล</span>
                                            @break
                                            @case(2)
                                            <span class="badge badge-pill badge-danger">จัดส่งใหม่</span>
                                            @break
                                            @case(3)
                                            <span class="badge badge-pill badge-success">จัดส่งแล้ว</span>
                                            @break
                                            @endswitch
                                        </td>
                                        <td>

                                            <div class="btn-group" role="group">
                                                <a class="btn btn-link text-dark" title="ดู"
                                                    href="{{ route('manage_orders.show_deliveryman',$order->id) }}" role="button"><i
                                                        class="fas fa-eye"></i></a>

                                                @if (($order->order_status == 1 || $order->order_status == 3))
                                                <a class="btn btn-link text-dark" href="{{route('pdf_order',$order->id)}}"  title="ออกใบเสร็จ" target="_blank" role="button"><i
                                                        class="fas fa-receipt"></i></a>
                                                @endif

                                                @if ($order->order_status == 0 || $order->order_status == 2)
                                                <!-- Trigger confrim modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="ยืนยัน"
                                                    data-target="#comfirm{{ $order->id }}Modal">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <!-- Cimfirm Modal -->
                                                <div class="modal fade" id="comfirm{{ $order->id }}Modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="comfirm{{ $order->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="comfirm{{ $order->id }}ModalLabel">
                                                                    ยืนยันการจัดส่ง
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>คุณต้องการยืนยันการจัดส่งสินค้า รหัส
                                                                    {{ $order->id }}
                                                                    {{ $order->order_dog }} {{ $order->order_microchip }}หรือไม่?</p>
                                                                <form
                                                                    action="{{ route('manage_orders.confirm_deliveryman',$order->id) }}"
                                                                    method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $order->id}}">
                                                                    <input type="hidden" name="dog_id"
                                                                        value="{{ $order->dog_id}}">
                                                                    <input type="hidden" name="microchip_id"
                                                                        value="{{ $order->microchip_id}}">
                                                                    @if ($order->order_transport != 'รถขนไก่')
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md">
                                                                            <label>หมายเลข Tracking</label>
                                                                            <input type="text" class="form-control"
                                                                                name="order_tracking_no"
                                                                                placeholder="กรอกหมายเลข Tracking 13 หลัก"
                                                                                required minlength="13" maxlength="13">
                                                                            <div class="invalid-feedback">
                                                                                กรุณากรอกหมายเลข Tracking 13 หลัก
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($order->order_type == 1 )
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-5">
                                                                            <label>ค่าจัดส่ง</label>
                                                                            <input type="number" class="form-control"
                                                                                name="order_transport_price" required max="999">
                                                                            <div class="invalid-feedback">
                                                                                กรุณากรอกค่าจัดส่ง || ค่าจัดส่งไม่เกินหลักร้อย
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-7">
                                                                            <label>รูปภาพ</label>
                                                                            <input type="file" class="form-control"
                                                                                name="order_pic">
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    @endif
                                                                    <div class="form-group text-right">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="submit"
                                                                            class="btn btn-main">ยืนยัน</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Cimfirm Modal -->
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
                                {!! $orders->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
