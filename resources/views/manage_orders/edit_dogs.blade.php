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
                        <li class="breadcrumb-item"><a href="{{ route('manage_dogs.index') }}">จัดการสุนัข</a></li>
                        <li class="breadcrumb-item active" aria-current="page">เพิ่มรายการขายสินค้า</li>
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

                        <div
                            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h1 class="h2">เพิ่มรายการขายสุนัข</h1>
                        </div>

                        <form action="{{ route('manage_orders.update',$order->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <!-- <form action="{{ route('manage_articles.update',$order->id) }}" method="POST"
                                enctype="multipart/form-data"> -->
                            @csrf

                            <input type="hidden" name="dog_id" value="{{ $dog->id}}">
                            <input type="hidden" name="dog_cost_price" value="{{ $dog->dog_sell_price - $dog->dog_buy_price}}">
                            <strong>ข้อมูลสินค้า</strong>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>รายการ</label>
                                    <input type="text" class="form-control" name="order_dog"
                                        value="สุนัข {{$dog->id}} - {{ $dog->dog_breed }} {{ $dog->dog_color }} {{ $dog->dog_sex }} ฟาร์ม {{ $dog->dog_farm_name }}"
                                        readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>ราคาซื้อ</label>
                                    <input type="text" class="form-control" name="order_dog_buy_price"
                                        value="{{ $dog->dog_buy_price }}" readonly>

                                </div>
                                <div class="form-group col-md-2">
                                    <label>ราคาขาย</label>
                                    <input type="text" class="form-control" name="order_dog_sell_price"
                                        value="{{ $dog->dog_sell_price }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>ส่วนลด</label>
                                    <input type="number" class="form-control" value="{{$order->order_dog_discount_price}}" name="order_dog_discount_price">
                                </div>
                            </div>
                            <strong>ข้อมูลลูกค้า</strong>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ชื่อ-นามสกุล</label>
                                    <input type="text" class="form-control" value="{{$order->order_cus_name}}" name="order_cus_name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>เบอร์โทร</label>
                                    <input type="number" class="form-control" value="{{$order->order_cus_tel_no}}" name="order_cus_tel_no" required onKeyPress="if(this.value.length==10) return false;">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>บ้านเลขที่</label>
                                    <input type="text" class="form-control" value="{{$order->order_cus_house_no}}" name="order_cus_house_no" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>หมู่ที่</label>
                                    <input type="text" class="form-control" value="{{$order->order_cus_village_no}}" name="order_cus_village_no" required>

                                </div>
                                <div class="form-group col-md-3">
                                    <label>ซอย</label>
                                    <input type="text" class="form-control" value="{{$order->order_cus_lane}}" name="order_cus_lane" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>ถนน</label>
                                    <input type="text" class="form-control" value="{{$order->order_cus_road}}" name="order_cus_road" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>จังหวัด</label>
                                    <select class="form-control province" name="order_cus_province" required>
                                        <option value="{{$order->order_cus_province}}" selected>{{$order->order_cus_province}}</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{ $province->name_th }}">{{ $province->name_th }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>อำเภอ</label>
                                    <select class="form-control amphures" name="order_cus_amphures" required>
                                        <option value="{{$order->order_cus_amphures}}">{{$order->order_cus_amphures}}</option>
                                    </select>

                                </div>
                                <div class="form-group col-md-3">
                                    <label>ตำบล</label>
                                    <select class="form-control districts" name="order_cus_districts" required>
                                        <option value="{{$order->order_cus_districts}}">{{$order->order_cus_districts}}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                        <label>หมายเลขไปรณีย์</label>
                                        <select class="form-control zip_code" name="order_cus_post_no" required>
                                            <option value="{{$order->order_cus_post_no}}">{{$order->order_cus_post_no}}</option>
                                        </select>
                                </div>
                            </div>

                            <strong>ข้อมูลการจัดส่ง</strong>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>พนักงานขนส่ง</label>
                                    <select class="form-control" name="order_deliveryman" required>
                                        <option value="{{$order->order_deliveryman}}" selected>{{$order->order_deliveryman}}</option>
                                        @foreach ($deliverymans as $deliveryman)
                                        <option value="{{ $deliveryman->name }}">{{ $deliveryman->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>ช่องทางจัดส่ง</label>
                                    <select class="form-control transports" name="order_transport" required>
                                        <option value="{{ $order->order_transport }}" selected>{{ $order->order_transport }}</option>
                                        @foreach ($transports as $transport)
                                        <option value="{{ $transport->transport_name }}">
                                            {{ $transport->transport_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="transport_price">
                                        <label>ค่าจัดส่ง</label>
                                        <input type="number" class="form-control" name="order_transport_price"  value="{{ $order->order_transport_price }}" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>เวลาส่ง</label>
                                    <select class="form-control" name="order_send_time" required>
                                        <option value="{{ $order->order_send_time }}" selected>{{ $order->order_send_time }}</option>
                                        <option value="6.30">6.30</option>
                                        <option value="8.30">8.30</option>
                                        <option value="12.30">12.30</option>
                                        <option value="16.30">16.30</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>เวลารับ</label>
                                    <select class="form-control" name="order_receive_time" required>
                                        <option value="{{ $order->order_receive_time }}" selected>{{ $order->order_receive_time }}</option>
                                        <option value="11.00">11.00</option>
                                        <option value="12.30">12.30</option>
                                        <option value="16.30">16.30</option>
                                        <option value="17.00">17.00</option>
                                        <option value="17.30">17.30</option>
                                        <option value="20.30">20.30</option>
                                        <option value="21.30">21.30</option>
                                        <option value="23.00">23.00</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-main">บันทึกข้อมูล</button>
                                <a class="btn btn-secondary" href="{{ route('manage_orders.index') }}" role="button">ยกเลิก</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
