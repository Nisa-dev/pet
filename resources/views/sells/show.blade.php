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
                        <li class="breadcrumb-item"><a
                                href="{{ route('sells.index') }}">รายการขาย</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ข้อมูลรายการขาย</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <ul class="list-unstyled">
                                    <li>
                                        <h4 class="my-2">รายการขาย รหัส {{ $sell->id }}
                                            {{ $sell->sell_dog }}
                                            {{ $sell->sell_microchip }}
                                        </h4>
                                        <h5>วันที่ขาย {{$sell->created_at->format('d/m/Y')}}</h5>
                                    </li>
                                </ul>
                            </div>
                        </div><hr>

                        <div class="row">
                                <div class="col-md-8">
                                    <ul class="list-unstyled">
                                        <h5>ข้อมูลลูกค้า</h5>
                                        <li><b>ชื่อ-นามสกุล :</b> {{ $sell->sell_cus_name }}</li>
                                        <li><b>เบอร์โทร :</b> {{ $sell->sell_cus_tel_no }}</li>
                                        <li><b>ที่อยู่ :</b> {{$sell->sell_cus_address}}</li>
                                    </ul>
                                </div>
                                
                            </div>
    
                            <div class="row">
                                <div class="col-md">
                                    <table class="table table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center">รายการ</th>
                                                <th class="text-center">ส่วนลด</th>
                                                <th class="text-center">ราคาซื้อ</th>
                                                <th class="text-center">ราคาขาย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($sell->sell_dog != null)
                                            <tr>
                                                <td>{{ $sell->sell_dog }}</td>
                                                <td class="text-right">{{ number_format($sell->sell_dog_discount_price, 2) }}</td>
                                                <td class="text-right">{{ number_format($sell->sell_dog_buy_price, 2) }}</td>
                                                <td class="text-right">{{ number_format($sell->sell_dog_sell_price, 2) }}</td>
                                            </tr>
                                            @endif
                                            @if ($sell->sell_microchip != null)
                                            <tr>
                                                <td>{{ $sell->sell_microchip }}</td>
                                                <td class="text-right">{{ number_format($sell->sell_microchip_discount_price, 2) }}</td>
                                                <td class="text-right">{{ number_format($sell->sell_microchip_buy_price, 2) }}</td>
                                                <td class="text-right">{{ number_format($sell->sell_microchip_sell_price, 2) }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td colspan="2"></td>
                                                <th class="text-right">รวมราคาขาย</td>
                                                <td class="text-right">{{ number_format($total_sell = $sell->sell_dog_sell_price+$sell->sell_microchip_sell_price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <th class="text-right">รวมราคาซื้อ</td>
                                                <td class="text-right">{{ number_format($toal_buy = $sell->sell_dog_buy_price+$sell->sell_microchip_buy_price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <th class="text-right">รวมส่วนลด</td>
                                                <td class="text-right">{{ number_format($total_discount = $sell->sell_dog_discount_price+$sell->sell_microchip_discount_price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <th class="text-right">ค่าจัดส่ง</td>
                                                <td class="text-right">{{ number_format($sell->sell_transport_price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <th class="text-right">ราคาขายสุทธิ</td>
                                                <th class="text-right">{{ number_format($total_sell - $total_discount + $sell->sell_transport_price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <th class="text-right">กำไร</th>
                                                <th class="text-right">{{ number_format($total_sell - $toal_buy - $total_discount + $sell->sell_transport_price, 2) }}</th>
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
</div>
@endsection
