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
                        <li class="breadcrumb-item"><a href="{{ route('manage_transports.index') }}">จัดการช่องทางจัดส่ง</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">รายการจัดส่ง</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div
                            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h1 class="h2">รายการจัดส่ง {{$transport_id->transport_name}}</h1>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>รหัส</th>
                                        <th>รายการ</th>
                                        <th>ลูกค้า</th>
                                        <th width="340px">ที่อยู่</th>
                                        <th>พนักงานขนส่ง</th>
                                        <th>วันที่ส่งสินค้า</th>
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
                                        <td>{{ $order->order_cus_name }}</td>
                                        <td>
                                            เลขที่
                                            {{$order->order_cus_house_no}}
                                            หมู่ที่
                                            {{$order->order_cus_village_no}}
                                            ซ.
                                            {{$order->order_cus_lane}}
                                            ถ.
                                            {{$order->order_cus_road}}
                                            จ.
                                            {{$order->order_cus_province}}
                                            อ.
                                            {{$order->order_cus_amphures}}
                                            @if ($order->order_cus_districts != null)
                                            ต.
                                            {{$order->order_cus_districts}}
                                            @endif
                                            {{$order->order_cus_post_no}}  
                                        </td>
                                        <td>{{ $order->order_deliveryman }}</td>
                                        @if ($order->order_status == 3)
                                            <td>{{ $order->updated_at->format('d/m/Y') }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
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
