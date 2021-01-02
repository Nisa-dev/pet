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
                                href="{{ route('manage_orders.index') }}">จัดการรายการจัดส่งสินค้า</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ข้อมูลรายการจัดส่งสินค้า</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
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
                                        @if ($order->order_status == 3)
                                        <li><b>วันที่ส่ง :</b> {{ $order->updated_at->format('d/m/Y') }}</li>
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
                                            @if ($order->order_dog != null)
                                            <tr>
                                                <td>{{ $order->order_dog }}</td>
                                                <td class="text-right">{{ number_format($order->order_dog_discount_price, 2) }}</td>
                                                <td class="text-right">{{ number_format($order->order_dog_buy_price, 2) }}</td>
                                                <td class="text-right">{{ number_format($order->order_dog_sell_price, 2) }}</td>
                                            </tr>
                                            @endif
                                            @if ($order->order_microchip != null)
                                            <tr>
                                                <td>{{ $order->order_microchip }}</td>
                                                <td class="text-right">{{ number_format($order->order_microchip_discount_price, 2) }}</td>
                                                <td class="text-right">{{ number_format($order->order_microchip_buy_price, 2) }}</td>
                                                <td class="text-right">{{ number_format($order->order_microchip_sell_price, 2) }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td colspan="2"></td>
                                                <th class="text-right">รวมราคาขาย</td>
                                                <td class="text-right">{{ number_format($total_sell = $order->order_dog_sell_price+$order->order_microchip_sell_price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <th class="text-right">รวมราคาซื้อ</td>
                                                <td class="text-right">{{ number_format($toal_buy = $order->order_dog_buy_price+$order->order_microchip_buy_price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <th class="text-right">รวมส่วนลด</td>
                                                <td class="text-right">{{ number_format($total_discount = $order->order_dog_discount_price+$order->order_microchip_discount_price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <th class="text-right">ค่าจัดส่ง</td>
                                                <td class="text-right">{{ number_format($order->order_transport_price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <th class="text-right">ราคาขายสุทธิ</td>
                                                <th class="text-right">{{ number_format($total_sell - $total_discount + $order->order_transport_price, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <th class="text-right">กำไร</th>
                                                <th class="text-right">{{ number_format($total_sell - $toal_buy - $total_discount + $order->order_transport_price, 2) }}</th>
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
