@extends('layouts.app')
@section('title',__('ข้อมูลสุนัข -'))
@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="text-center">
        {{-- Message --}}
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
        <h1 class="mt-4">@lang("ข้อมูลสุนัข")</h1>
        <h3 class="mb-4">@lang("ไมโครชิพหมายเลข") <span class="text-main">{{ $install_microchip->install_microchip_no}}</span>
            @auth
            @if (Auth::user()->type == 'Member' && $install_microchip->user_id == 0)
            <form action="{{route('my_lists.add',$install_microchip->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-link"><i class="far fa-star"></i></button>
                </form>
            @endif
            @endauth
        </h3>
    </div>

    <div class="row">
        <div class="col-md-6">
            @if ($install_microchip->install_microchip_image == null)
            <img src="{{asset('image/no_img.jpg')}}" class="img-fluid rounded" width="350px">
            @else
            <img class="img-fluid rounded" src="{{ asset('image/dogs/'.$install_microchip->install_microchip_image)}}"
                width="450px">
            @endif
        </div>

        <div class="col-md-6">
            <h3 class="my-3">{{ $install_microchip->install_microchip_breed }}
                {{ $install_microchip->install_microchip_color }} {{ $install_microchip->install_microchip_sex }}</h3>
            @if ($install_microchip->install_microchip_birth_date != null)
            <h5 class="my-3">@lang("วันเกิด") {{ $install_microchip->install_microchip_birth_date }}</h5>
            @endif
            <ul class="list-unstyled">
                <ul>
                    <li><span class="text-main">@lang("วันที่ติดตั้งไมโครชิพ") </span>
                        {{$install_microchip->created_at->format('d/m/Y')}}
                    <li><span class="text-main">@lang("ชื่อเจ้าของ")</span> {{$install_microchip->install_microchip_owner_name}}
                    </li>
                    <li><span class="text-main">@lang("เบอร์โทร")</span> {{$install_microchip->install_microchip_owner_tel_no}}
                    </li>
                    <li><span class="text-main">@lang("ที่อยู่")</span>
                        <p>
                            บ้านเลขที่ {{$install_microchip->install_microchip_owner_house_no}} หมู่ที่
                            {{$install_microchip->install_microchip_owner_village_no}} ซอย
                            {{$install_microchip->install_microchip_owner_lane}} ถนน
                            {{$install_microchip->install_microchip_owner_road}} จังหวัด
                            {{$install_microchip->install_microchip_owner_province}} อำเภอ
                            {{$install_microchip->install_microchip_owner_amphures}} ตำบล
                            {{$install_microchip->install_microchip_owner_districts}} หมายเลขไปรณีย์
                            {{$install_microchip->install_microchip_owner_post_no}}
                        </p>
                    </li>
                </ul>
            </ul>
            <h5 class="my-3">@lang("ข้อมูลสัตวแพทย์")</h5>
            <ul class="list-unstyled">
                <ul>
                        <li><span class="text-main">@lang("ชื่อสัตวแพทย์")</span>
                            {{$install_microchip->install_microchip_veterinarian}}
                        </li>
                        <li><span class="text-main">@lang("ที่อยู่สัตวแพทย์")</span>
                            {{$install_microchip->install_microchip_veterinarian_address}}
                        </li>
                        <li><span class="text-main">@lang("เบอร์โทร")</span>
                            {{$install_microchip->install_microchip_veterinarian_tel_no}}
                        </li>
                </ul>
            </ul>
            @if ($dog != null)
            <h4 class="my-3">@lang("ราคา") {{ number_format($dog->dog_sell_price + $microchip->microchip_sell_price, 2) }} บาท</h4>
            @else
            @endif
            @auth
            @if (Auth::user()->type == 'Member')
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-main" data-toggle="modal" data-target="#exampleModal">
                    @lang("แจ้งขอเปลี่ยนเจ้าของ")
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h4 class="modal-title" id="exampleModalLabel">@lang("แจ้งขอเปลี่ยนเจ้าของ")</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('request_change_owners.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="request_change_owner_status" value="0">
                                <input type="hidden" name="install_microchip_id" value="{{ $install_microchip->id}}">
                                <input type="hidden" name="dog_id" value="{{ $install_microchip->dog_id}}">
                                <input type="hidden" name="microchip_id" value="{{ $install_microchip->microchip_id}}">
                                <input type="hidden" name="install_microchip_breed" value="{{ $install_microchip->install_microchip_breed}}">
                                <input type="hidden" name="install_microchip_color" value="{{ $install_microchip->install_microchip_color}}">
                                <input type="hidden" name="install_microchip_sex" value="{{ $install_microchip->install_microchip_sex}}">
                                <input type="hidden" name="install_microchip_no" value="{{ $install_microchip->install_microchip_no}}">
                                {{-- old data --}}
                                <input type="hidden" name="old_owner_name" value="{{ $install_microchip->install_microchip_owner_name}}">
                                <input type="hidden" name="old_owner_tel_no" value="{{ $install_microchip->install_microchip_owner_tel_no}}">
                                <input type="hidden" name="old_owner_house_no" value="{{ $install_microchip->install_microchip_owner_house_no}}">
                                <input type="hidden" name="old_owner_village_no" value="{{ $install_microchip->install_microchip_owner_village_no}}">
                                <input type="hidden" name="old_owner_lane" value="{{ $install_microchip->install_microchip_owner_lane}}">
                                <input type="hidden" name="old_owner_road" value="{{ $install_microchip->install_microchip_owner_road}}">
                                <input type="hidden" name="old_owner_province" value="{{ $install_microchip->install_microchip_owner_province}}">
                                <input type="hidden" name="old_owner_amphures" value="{{ $install_microchip->install_microchip_owner_amphures}}">
                                <input type="hidden" name="old_owner_districts" value="{{ $install_microchip->install_microchip_owner_districts}}">
                                <input type="hidden" name="old_owner_post_no" value="{{ $install_microchip->install_microchip_owner_post_no}}">
                                <strong>@lang("ข้อมูลเจ้าของ")</strong>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>@lang("ชื่อ-นามสกุล")</label>
                                        <input type="text" class="form-control" name="request_change_owner_name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>@lang("เบอร์โทร")</label>
                                        <input type="number" class="form-control" name="request_change_owner_tel_no" required onKeyPress="if(this.value.length==10) return false;">
                                    </div>
                                </div>
                                <strong>@lang("ข้อมูลที่อยู่")</strong>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>@lang("บ้านเลขที่")</label>
                                        <input type="text" class="form-control" name="request_change_owner_house_no" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>@lang("หมู่ที่")</label>
                                        <input type="text" class="form-control" name="request_change_owner_village_no" required>
                
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>@lang("ซอย")</label>
                                        <input type="text" class="form-control" name="request_change_owner_lane" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>@lang("ถนน")</label>
                                        <input type="text" class="form-control" name="request_change_owner_road" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>@lang("จังหวัด")</label>
                                        <select class="form-control province" name="request_change_owner_province" required>
                                            <option value="" selected disabled>@lang("เลือกจังหวัด")</option>
                                            @foreach ($provinces as $province)
                                            <option value="{{ $province->name_th }}">{{ $province->name_th }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>@lang("อำเภอ")</label>
                                        <select class="form-control amphures" name="request_change_owner_amphures" required>
                                            <option value="">@lang("เลือกอำเภอ")</option>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>@lang("ตำบล")</label>
                                        <select class="form-control districts" name="request_change_owner_districts" required>
                                            <option value="">@lang("เลือกตำบล")</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>@lang("หมายเลขไปรณีย์")</label>
                                        <select class="form-control zip_code" name="request_change_owner_post_no" required>
                                            <option value="">@lang("เลือกหมายเลขไปรณีย์")</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">@lang("ยกเลิก")</button>
                                    <button type="submit"
                                        class="btn btn-main">@lang("บันทึกข้อมูล")</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endauth
        </div>

    </div>

    <div class="row my-4">
        <div class="col-md">
            <button class="btn btn-link text-decoration-none" type="button" data-toggle="collapse"
                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                @lang("ประวัติการแก้ไขข้อมูล")
            </button>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <ul class="list-group list-group-flush">
                        @forelse ($request_changes as $request_change)
                        <li class="list-group-item">
                            <h5>@lang("การแก้ไขข้อมูลครั้งที่") {{++$i}} @lang("เมื่อวันที่")
                                {{$request_change->updated_at->format('d/m/Y')}}</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong class="text-danger">@lang("ข้อมูลเจ้าของ (เดิม)")</strong>
                                    <p>@lang("ชื่อเจ้าของ") {{$request_change->old_owner_name}} @lang("เบอร์โทร")
                                        {{$request_change->old_owner_tel_no}}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong class="text-success">@lang("ข้อมูลเจ้าของ (ใหม่)")</strong>
                                    <p>@lang("ชื่อเจ้าของ") {{$request_change->request_change_owner_name}} @lang("เบอร์โทร")
                                        {{$request_change->request_change_owner_tel_no}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong class="text-danger">@lang("ข้อมูลที่อยู่ (เดิม)")</strong>
                                    <p>
                                        บ้านเลขที่ {{$request_change->old_owner_house_no}} หมู่ที่
                                        {{$request_change->old_owner_village_no}} ซอย
                                        {{$request_change->old_owner_lane}} ถนน
                                        {{$request_change->old_owner_road}} จังหวัด
                                        {{$request_change->old_owner_province}} อำเภอ
                                        {{$request_change->old_owner_amphures}} ตำบล
                                        {{$request_change->old_owner_districts}} หมายเลขไปรณีย์
                                        {{$request_change->old_owner_post_no}}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <strong class="text-success">@lang("ข้อมูลที่อยู่ (ใหม่)")</strong>
                                    <p>
                                        บ้านเลขที่ {{$request_change->request_change_owner_house_no}} หมู่ที่
                                        {{$request_change->request_change_owner_village_no}} ซอย
                                        {{$request_change->request_change_owner_lane}} ถนน
                                        {{$request_change->request_change_owner_road}} จังหวัด
                                        {{$request_change->request_change_owner_province}} อำเภอ
                                        {{$request_change->request_change_owner_amphures}} ตำบล
                                        {{$request_change->request_change_owner_districts}} หมายเลขไปรณีย์
                                        {{$request_change->request_change_owner_post_no}}
                                    </p>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">@lang("ไม่มีประวัติการแก้ไขข้อมูล")</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
