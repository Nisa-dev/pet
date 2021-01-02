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
                        <li class="breadcrumb-item"><a href="{{ route('manage_microchips.index') }}">จัดการไมโครชิพ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ข้อมูลติดตั้งไมโครชิพ</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="text-center">
                            <h1 class="my-4">ข้อมูลสุนัขไมโครชิพหมายเลข <span class="text-main">{{ $install_microchip->install_microchip_no}}</span></h1>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                @if ($install_microchip->install_microchip_image == null)
                                <div class="text-center">
                                    <img src="{{asset('image/no_img.jpg')}}" class="img-fluid rounded" width="450px">
                                </div>
                                @else
                                <div class="text-center">
                                    <img class="img-fluid rounded"
                                        src="{{ asset('image/dogs/'.$install_microchip->install_microchip_image)}}"
                                        width="450px">
                                </div>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <h3 class="my-3">
                                    {{ $install_microchip->install_microchip_breed }}
                                    {{ $install_microchip->install_microchip_color }}
                                    {{ $install_microchip->install_microchip_sex }}
                                </h3>

                                <h5 class="my-3">วันเกิด
                                    {{ $install_microchip->install_microchip_birth_date }}
                                </h5>

                                <ul class="list-unstyled">
                                    <ul>
                                        <li><span class="text-main">วันที่ติดตั้งไมโครชิพ
                                            </span>
                                            {{$install_microchip->created_at->format('d/m/Y')}}
                                        <li><span class="text-main">ชื่อเจ้าของ</span>
                                            {{$install_microchip->install_microchip_owner_name}}
                                        </li>
                                        <li><span class="text-main">เบอร์โทร</span>
                                            {{$install_microchip->install_microchip_owner_tel_no}}
                                        </li>
                                        <li><span class="text-main">ที่อยู่</span>
                                            <p>
                                                บ้านเลขที่
                                                {{$install_microchip->install_microchip_owner_house_no}}
                                                หมู่ที่
                                                {{$install_microchip->install_microchip_owner_village_no}}
                                                ซอย
                                                {{$install_microchip->install_microchip_owner_lane}}
                                                ถนน
                                                {{$install_microchip->install_microchip_owner_road}}
                                                จังหวัด
                                                {{$install_microchip->install_microchip_owner_province}}
                                                อำเภอ
                                                {{$install_microchip->install_microchip_owner_amphures}}
                                                ตำบล
                                                {{$install_microchip->install_microchip_owner_districts}}
                                                หมายเลขไปรณีย์
                                                {{$install_microchip->install_microchip_owner_post_no}}
                                            </p>
                                        </li>
                                    </ul>
                                </ul>

                                <h5 class="my-3">ข้อมูลสัตวแพทย์</h5>
                                <ul class="list-unstyled">
                                    <ul>
                                            <li><span class="text-main">ชื่อสัตวแพทย์</span>
                                                {{$install_microchip->install_microchip_veterinarian}}
                                            </li>
                                            <li><span class="text-main">ที่อยู่สัตวแพทย์</span>
                                                {{$install_microchip->install_microchip_veterinarian_address}}
                                            </li>
                                            <li><span class="text-main">เบอร์โทร</span>
                                                {{$install_microchip->install_microchip_veterinarian_tel_no}}
                                            </li>
                                    </ul>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
