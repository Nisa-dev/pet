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
                            <h1 class="h2">เพิ่มรายการขายสุนัขพร้อมติดตั้งไมโครชิพ</h1>
                        </div>

                        <form action="{{ route('manage_orders.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_type" value="2">
                            <input type="hidden" name="order_status" value="0">
                            <input type="hidden" name="dog_id" value="{{ $dog->id}}">
                            <input type="hidden" name="microchip_id" value="{{ $microchip->id}}">
                            <input type="hidden" name="dog_cost_price" value="{{ $dog->dog_sell_price - $dog->dog_buy_price}}">
                            <input type="hidden" name="microchip_cost_price" value="{{ $microchip->microchip_sell_price - $microchip->microchip_buy_price}}">
                            {{-- Create Install --}}
                            <input type="hidden" name="dog_breed" value="{{ $dog->dog_breed}}">
                            <input type="hidden" name="dog_color" value="{{ $dog->dog_color}}">
                            <input type="hidden" name="dog_sex" value="{{ $dog->dog_sex}}">
                            <input type="hidden" name="dog_birth_date" value="{{ $dog->dog_birth_date}}">
                            <input type="hidden" name="dog_image" value="{{ $dog->dog_image}}">

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
                                    <input type="number" class="form-control" name="order_dog_discount_price">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="order_microchip"
                                        value="ไมโครชิพ {{ $microchip->id }} - หมายเลข {{ $microchip->microchip_no }}"
                                        readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control" name="order_microchip_buy_price"
                                        value="{{ $microchip->microchip_buy_price }}" readonly>

                                </div>
                                <div class="form-group col-md-2">
                                    <input type="text" class="form-control" name="order_microchip_sell_price"
                                        value="{{ $microchip->microchip_sell_price }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="number" class="form-control" name="order_microchip_discount_price">
                                </div>
                            </div>
                            <strong>ข้อมูลลูกค้า</strong>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>ชื่อ-นามสกุล</label>
                                    <input type="text" class="form-control" name="order_cus_name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>เบอร์โทร</label>
                                    <input type="number" class="form-control" name="order_cus_tel_no" required onKeyPress="if(this.value.length==10) return false;">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>บ้านเลขที่</label>
                                    <input type="text" class="form-control" name="order_cus_house_no" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>หมู่ที่</label>
                                    <input type="text" class="form-control" name="order_cus_village_no" required>

                                </div>
                                <div class="form-group col-md-3">
                                    <label>ซอย</label>
                                    <input type="text" class="form-control" name="order_cus_lane" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>ถนน</label>
                                    <input type="text" class="form-control" name="order_cus_road" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>จังหวัด</label>
                                    <select class="form-control province" name="order_cus_province" required>
                                        <option value="" selected disabled>เลือกจังหวัด</option>
                                        @foreach ($provinces as $province)
                                        <option value="{{ $province->name_th }}">{{ $province->name_th }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>อำเภอ</label>
                                    <select class="form-control amphures" name="order_cus_amphures" required>
                                        <option value="">เลือกอำเภอ</option>
                                    </select>

                                </div>
                                <div class="form-group col-md-3">
                                    <label>ตำบล</label>
                                    <select class="form-control districts" name="order_cus_districts">
                                        <option value="">เลือกตำบล</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>หมายเลขไปรณีย์</label>
                                    <select class="form-control zip_code" name="order_cus_post_no" required>
                                        <option value="">เลือกหมายเลขไปรณีย์</option>
                                    </select>
                                </div>
                            </div>

                            <strong>ข้อมูลสัตวแพทย์</strong>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>ชื่อสัตวแพทย์</label>
                                    <input type="text" class="form-control" name="install_microchip_veterinarian"
                                        value="Pattama Chaocherd">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>ที่อยู่สัตวแพทย์</label>
                                    <input type="text" class="form-control" name="install_microchip_veterinarian_address"
                                        value="499/2 ม.7 ต.แม่เหียะ อ.เมือง จ.เชียงใหม่">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>เบอร์โทร</label>
                                    <input type="text" class="form-control" name="install_microchip_veterinarian_tel_no"
                                        value="053444017">
                                </div>
                            </div>

                            <strong>ข้อมูลการจัดส่ง</strong>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>พนักงานขนส่ง</label>
                                    <select class="form-control" name="order_deliveryman">
                                        <option value="" selected disabled>เลือกพนักงานขนส่ง</option>
                                        @foreach ($deliverymans as $deliveryman)
                                        <option value="{{ $deliveryman->name }}">{{ $deliveryman->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>ช่องทางจัดส่ง</label>
                                    <select class="form-control transports" name="order_transport" required>
                                        <option value="" selected disabled>เลือกช่องทางจัดส่ง</option>
                                        @foreach ($transports as $transport)
                                        <option value="{{ $transport->transport_name }}">
                                            {{ $transport->transport_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <div class="transport_price">
                                        <label>ค่าจัดส่ง</label>
                                        <input type="number" class="form-control" name="order_transport_price" value=""
                                            required>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                        <label>เวลาส่ง</label>
                                        <select class="form-control" name="order_send_time" required>
                                            <option value="" selected disabled>เลือกเวลาส่ง</option>
                                            <option value="6.30">6.30</option>
                                            <option value="8.30">8.30</option>
                                            <option value="12.30">12.30</option>
                                            <option value="16.30">16.30</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label>เวลารับ</label>
                                        <select class="form-control" name="order_receive_time" required>
                                            <option value="" selected disabled>เลือกเวลารับ</option>
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
