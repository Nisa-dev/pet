@extends('layouts.app')
@section('title',__('แจ้งความประสงค์ขอติดตั้งไมโครชิพ -'))
@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="text-center">
        <h1 class="mt-4">@lang("แจ้งความประสงค์ขอติดตั้งไมโครชิพ")</h1>
        <h5>@lang("หมายเลขไมโครชิพ") {{ $get_microchip_no->microchip_no }} </h5>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-11 my-3">
            {{-- Message --}}
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>@lang("เกิดข้อผิดพลาด!")</strong>
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

            <form action="{{ route('request_install.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="microchip_id" value="{{$get_microchip_no->id}}">
                <input type="hidden" name="install_microchip_no" value="{{$get_microchip_no->microchip_no}}">
                <input type="hidden" name="install_microchip_status" value="0">

                <strong>@lang("ข้อมูลเจ้าของ")</strong>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>@lang("ชื่อ-นามสกุล")</label>
                        <input type="text" class="form-control" name="install_microchip_owner_name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>@lang("เบอร์โทร")</label>
                        <input type="number" class="form-control" name="install_microchip_owner_tel_no" required onKeyPress="if(this.value.length==10) return false;">
                    </div>
                </div>

                <strong>@lang("ข้อมูลที่อยู่")</strong>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>@lang("บ้านเลขที่")</label>
                        <input type="text" class="form-control" name="install_microchip_owner_house_no" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>@lang("หมู่ที่")</label>
                        <input type="text" class="form-control" name="install_microchip_owner_village_no" required>

                    </div>
                    <div class="form-group col-md-3">
                        <label>@lang("ซอย")</label>
                        <input type="text" class="form-control" name="install_microchip_owner_lane" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>@lang("ถนน")</label>
                        <input type="text" class="form-control" name="install_microchip_owner_road" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>@lang("จังหวัด")</label>
                        <select class="form-control province" name="install_microchip_owner_province" required>
                            <option value="" selected disabled>@lang("เลือกจังหวัด")</option>
                            @foreach ($provinces as $province)
                            <option value="{{ $province->name_th }}">{{ $province->name_th }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>@lang("อำเภอ")</label>
                        <select class="form-control amphures" name="install_microchip_owner_amphures" required>
                            <option value="">@lang("เลือกอำเภอ")</option>
                        </select>

                    </div>
                    <div class="form-group col-md-3">
                        <label>@lang("ตำบล")</label>
                        <select class="form-control districts" name="install_microchip_owner_districts" required>
                            <option value="">@lang("เลือกตำบล")</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>@lang("หมายเลขไปรณีย์")</label>
                        <select class="form-control zip_code" name="install_microchip_owner_post_no" required>
                            <option value="">@lang("เลือกหมายเลขไปรณีย์")</option>
                        </select>
                    </div>
                </div>

                <strong>@lang("ข้อมูลสัตว์")</strong>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>@lang("สายพันธ์")</label>
                        <input type="text" class="form-control" name="install_microchip_breed" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label>@lang("สี")</label>
                        <input type="text" class="form-control" name="install_microchip_color" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="dog_sex">@lang("เพศ")</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="install_microchip_sex" id="inlineRadio1"
                                value="ตัวผู้" checked>
                            <label class="form-check-label" for="inlineRadio1">@lang("ตัวผู้")</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="install_microchip_sex" id="inlineRadio2"
                                value="ตัวเมีย">
                            <label class="form-check-label" for="inlineRadio2">@lang("ตัวเมีย")</label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>@lang("รูปภาพ (ตัวเลือก)")</label>
                        <input type="file" class="form-control" name="install_microchip_image">
                    </div>
                </div>

                    <strong>@lang("ข้อมูลสัตวแพทย์")</strong>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>@lang("ชื่อสัตวแพทย์")</label>
                            <input type="text" class="form-control" name="install_microchip_veterinarian" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>@lang("ที่อยู่สัตวแพทย์")</label>
                            <input type="text" class="form-control" name="install_microchip_veterinarian_address" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>@lang("เบอร์โทร")</label>
                            <input type="number" class="form-control" name="install_microchip_veterinarian_tel_no" required onKeyPress="if(this.value.length==10) return false;">
                        </div>
                    </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label><strong>@lang("วันที่จองติดตั้ง")</strong></label>
                        <input type="date" class="form-control" name="install_microchip_booking_date" required>
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-main">@lang("บันทึกข้อมูล")</button>
                    <button type="reset" class="btn btn-secondary">@lang("ยกเลิก")</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
