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
                        <li class="breadcrumb-item"><a
                                href="{{ route('manage_orders.index_deliveryman') }}">จัดการรายการจัดส่งสินค้า</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ข้อมูลรายการจัดส่งสินค้า</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
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
                        <div class="row">
                            <div class="col-md">
                                <ul class="list-unstyled">
                                    <li>
                                        <h4 class="my-2">รายการจัดส่งสินค้า รหัส {{ $order->id }}
                                            {{ $order->order_dog }}
                                            {{ $order->order_microchip }}
                                        </h4>
                                    </li>
                                    <li class="mb-2">
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
                                    </li>
                                </ul>
                            </div>
                        </div><hr>

                        <div class="row">
                            <div class="col-md-8">
                                <ul class="list-unstyled">
                                    <h5>ข้อมูลลูกค้า</h5>
                                    <li><b>ชื่อ-นามสกุล :</b> {{ $order->order_cus_name }}</li>
                                    <li><b>เบอร์โทร :</b> {{ $order->order_cus_tel_no }}</li>
                                    <li><b>ที่อยู่ :</b>
                                            บ้านเลขที่ {{$order->order_cus_house_no}} 
                                            หมู่ที่ {{$order->order_cus_village_no}} 
                                            ซอย {{$order->order_cus_lane}} 
                                            ถนน {{$order->order_cus_road}} 
                                            จังหวัด {{$order->order_cus_province}} 
                                            อำเภอ {{$order->order_cus_amphures}} 
                                            @if ($order->order_cus_districts != null)
                                                ตำบล {{$order->order_cus_districts}}
                                            @endif
                                            หมายเลขไปรณีย์ {{$order->order_cus_post_no}}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5>ข้อมูลการจัดส่ง</h5>
                                <ul class="list-unstyled">
                                    <li><b>พนักงานขนส่ง :</b> {{ $order->order_deliveryman }}</li>
                                    <li><b>ช่องทางจัดส่ง :</b> {{ $order->order_transport }}</li>
                                    @if ($order->order_send_time !=  '-' && $order->order_receive_time !=  '-')
                                    <li><b>เวลาส่ง :</b> {{ $order->order_send_time }}</li>
                                    <li><b>เวลารับ :</b> {{ $order->order_receive_time }}</li>
                                    @endif
                                    @if ($order->order_tracking_no !=  null)
                                    <li><b>หมายเลข Tracking :</b> {{ $order->order_tracking_no }}</li>
                                    @endif
                                    @if ($order->order_pic !=  null)
                                    <li>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                                            ดูรูปภาพจัดส่ง
                                        </button>
                                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                                    <img class="img-fluid rounded" width="100%"
                                                    src="{{ asset('image/orders/'.$order->order_pic)}}">  
                                            </div>
                                          </div>
                                        </div>
                                    </li>
                                    @endif
                                    @if ($order->order_status == 3)
                                    <li><b>วันที่ส่ง :</b> {{ $order->updated_at->format('d/m/Y') }}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center" colspan="2">รายการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @if ($order->order_dog != null)
                                            <td>{{ $order->order_dog }}</td>
                                            @endif
                                            @if ($order->order_microchip != null)
                                            <td>{{ $order->order_microchip }}</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if ($order->order_status == 0 || $order->order_status == 2)
                                                <!-- Trigger confrim modal -->
                                                <button type="button" class="btn btn-main" data-toggle="modal"
                                                    data-target="#comfirm{{ $order->id }}Modal">
                                                    <i class="fas fa-check"></i> ยืนยันการจัดส่ง
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
