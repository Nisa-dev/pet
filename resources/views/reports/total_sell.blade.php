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
                        <li class="breadcrumb-item active" aria-current="page">รายการยอดขาย</li>
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
                            <h1 class="h2">รายงานยอดขาย</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                    <div class="btn-group mr-2">
                                            <a class="btn  btn-main" href="{{ route('pdf_total_sell',[$option,$range]) }}" target="_blank"
                                            role="button"><i class="fas fa-receipt"></i> ออกรายงาน</a>
                                    </div>
                                </div>
                        </div>

                        <form action="{{route('total_sell.sort')}}">
                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="options" value="op_date" id="op1">
                                            <label class="form-check-label" for="op1">ยอดขายประจำวัน</label>
                                        </div>
                                        <input type="date" class="form-control" name="getDate">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="options" value="op_month" id="op2">
                                            <label class="form-check-label" for="op2">ยอดขายประจำเดือน</label>
                                        </div>
                                        <select class="form-control" name="getMonth">
                                            <option value="" selected disabled>เลือกยอดขายประจำเดือน</option>
                                            @foreach ($select_months as $select_month)
                                                <option value="{{$select_month['0']['created_at']->format('Y-m')}}">{{$select_month['0']['created_at']->format('M Y')}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="options" value="op_year" id="op3">
                                            <label class="form-check-label" for="op3">ยอดขายประจำปี</label>
                                        </div>
                                        <select class="form-control" name="getYear">
                                            <option value="" selected disabled>เลือกยอดขายประจำปี</option>
                                            @foreach ($select_years as $select_year)
                                                <option value="{{$select_year['0']['created_at']->format('Y')}}">{{$select_year['0']['created_at']->format('Y')}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="options" value="op_all" id="op4" required>
                                        <label class="form-check-label" for="op4">ยอดขายทั้งหมด</label>
                                    </div>
                                    <button type="submit" class="btn btn-block btn-primary">ดูยอดขาย</button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">รายการ</th>
                                        <th class="text-center">วันที่ขาย</th>
                                        <th class="text-center">ราคา</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" value="{{$total = 0}}">
                                    @forelse ($sells as $sell)
                                    <tr>
                                        <td class="text-center">{{++$i}}</td>
                                        {{-- list --}}
                                        @if ($sell->sell_dog != null && $sell->sell_microchip == null)
                                            <td>{{ $sell->sell_dog }}</td>
                                        @elseif ($sell->sell_microchip != null && $sell->sell_dog == null)
                                            <td>{{ $sell->sell_microchip }}</td>
                                        @elseif ($sell->sell_dog != null && $sell->sell_microchip != null)
                                            <td>{{ $sell->sell_dog }} ,<br> {{ $sell->sell_microchip }}</td>
                                        @endif
                                            <td class="text-center">{{ $sell->created_at->format('d/m/Y') }}</td>
                                        {{-- price --}}
                                        @if ($sell->sell_dog != null && $sell->sell_microchip == null)
                                            <td class="text-right">{{ number_format($sell_net = $sell->sell_dog_sell_price - $sell->sell_dog_discount_price - $sell->sell_transport_price,2) }}</td>
                                        @elseif ($sell->sell_microchip != null && $sell->sell_dog == null)
                                            <td class="text-right">{{ number_format($sell_net = $sell->sell_microchip_sell_price - $sell->sell_microchip_discount_price - $sell->sell_transport_price,2) }}</td>
                                        @elseif ($sell->sell_dog != null && $sell->sell_microchip != null)
                                            <td class="text-right">{{ number_format($sell_net = $sell->sell_dog_sell_price + $sell->sell_microchip_sell_price - $sell->sell_dog_discount_price - $sell->sell_microchip_discount_price - $sell->sell_transport_price,2) }}</td>
                                        @endif
                                        <input type="hidden" value="{{$total += $sell_net}}">
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4">ไม่มีข้อมูล</td>
                                    </tr>
                                    @endforelse
                                    <tr>
                                        <th class="text-right" colspan="3">รวม</th>
                                        <th class="text-right">{{number_format($total,2)}}</th>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
