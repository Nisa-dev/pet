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
                        <li class="breadcrumb-item active" aria-current="page">จัดการรายการจัดส่งสินค้า</li>
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
                            <h1 class="h2">จัดการรายการจัดส่งสินค้า</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">

                                </div>
                            </div>
                        </div>

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manage_orders.index') }}">ทั้งหมด</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">พนักงานขนส่ง</a>
                                <div class="dropdown-menu">
                                    @foreach ($users as $user)
                                    <a class="dropdown-item"
                                        href="{{ route('manage_orders.index_sort_deliveryman',$user->name) }}">{{$user->name}}</a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">สถานะ</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        href="{{ route('manage_orders.index_sort_status','0') }}">รอดำเนินการจัดส่ง</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_orders.index_sort_status','1') }}">รอยืนยันข้อมูล</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_orders.index_sort_status','2') }}">จัดส่งใหม่</a>
                                    <a class="dropdown-item"
                                        href="{{ route('manage_orders.index_sort_status','3') }}">จัดส่งแล้ว</a>
                                </div>
                            </li>
                        </ul>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>รหัส</th>
                                        <th>รายการ</th>
                                        <th>พนักงานขนส่ง</th>
                                        <th>วันที่สร้างรายการ</th>
                                        <th>วันที่ส่งสินค้า</th>
                                        <th>สถานะ</th>
                                        <th>จัดการ</th>
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
                                        <td>{{ $order->order_deliveryman }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        @if ($order->order_status == 3)
                                            <td>{{ date('d/m/Y', strtotime($order->updated_at)) }}</td>

                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>
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
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                               @if (($order->order_status != 3))
                                              <a class="btn btn-link text-dark" title="แก้ไข"
                                                  href="{{ route('manage_orders.edit',$order->id) }}" role="button"><i
                                                      class="fas fa-edit"></i></a>
                                              @endif
                                                <a class="btn btn-link text-dark" title="ดู"
                                                    href="{{ route('manage_orders.show',$order->id) }}" role="button"><i
                                                        class="fas fa-eye"></i></a>

                                                @if (($order->order_status == 3))
                                                <a class="btn btn-link text-dark" href="{{route('pdf_order_admin',$order->id)}}"  title="ออกใบเสร็จ" target="_blank" role="button"><i
                                                    class="fas fa-receipt"></i></a>
                                                @endif

                                                {{-- แสดง ปุ่มยกเลิก --}}
                                                @if ($order->order_status == 0 || $order->order_status == 2)
                                                <!-- Trigger cancel modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="ยกเลิก"
                                                    data-target="#cancel{{ $order->id }}Modal">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                                <!-- Cancel Modal -->
                                                <div class="modal fade" id="cancel{{ $order->id }}Modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="cancel{{ $order->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="cancel{{ $order->id }}ModalLabel">
                                                                    ยืนยันการยกเลิกรายการจัดส่งสินค้า
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>คุณต้องการยกเลิกรายการจัดส่งสินค้า รหัส
                                                                    {{ $order->id }}
                                                                    {{ $order->order_dog }}
                                                                    {{ $order->order_microchip }} หรือไม่?</p>
                                                                <div class="form-group text-right">
                                                                    <form
                                                                        action="{{ route('manage_orders.destroy',$order->id) }}"
                                                                        method="POST">
                                                                        <input type="hidden" name="order_type"
                                                                            value="{{ $order->order_type }}">
                                                                        <input type="hidden" name="dog_id"
                                                                            value="{{ $order->dog_id }}">
                                                                        <input type="hidden" name="microchip_id"
                                                                            value="{{ $order->microchip_id }}">
                                                                        <input type="hidden" name="order_transport"
                                                                            value="{{ $order->order_transport }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="submit"
                                                                            class="btn btn-main">ยืนยัน</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($order->order_status == 1)
                                                <!-- Call Confirm Modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="ยืนยัน"
                                                    data-target="#confirm{{ $order->id }}Modal">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <!-- Confirm Modal -->
                                                <div class="modal fade" id="confirm{{ $order->id }}Modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="confirm{{ $order->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="confirm{{ $order->id }}ModalLabel">
                                                                    ยืนยันรายการจัดส่งสินค้า</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('manage_orders.confirm', $order->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $order->id}}">
                                                                    <input type="hidden" name="dog_id"
                                                                        value="{{ $order->dog_id}}">
                                                                    <input type="hidden" name="microchip_id"
                                                                        value="{{ $order->microchip_id}}">
                                                                    <input type="hidden" name="order_cus_name"
                                                                        value="{{ $order->order_cus_name}}">
                                                                    {{-- Variable for create sell --}}
                                                                    <input type="hidden" name="sell_dog"
                                                                        value="{{ $order->order_dog}}">
                                                                    <input type="hidden" name="sell_dog_buy_price"
                                                                        value="{{ $order->order_dog_buy_price}}">
                                                                    <input type="hidden" name="sell_dog_sell_price"
                                                                        value="{{ $order->order_dog_sell_price}}">
                                                                    <input type="hidden" name="sell_dog_discount_price"
                                                                        value="{{ $order->order_dog_discount_price}}">
                                                                    <input type="hidden" name="sell_microchip"
                                                                        value="{{ $order->order_microchip}}">
                                                                    <input type="hidden" name="sell_microchip_buy_price"
                                                                        value="{{ $order->order_microchip_buy_price}}">
                                                                    <input type="hidden"
                                                                        name="sell_microchip_sell_price"
                                                                        value="{{ $order->order_microchip_sell_price}}">
                                                                    <input type="hidden"
                                                                        name="sell_microchip_discount_price"
                                                                        value="{{ $order->order_microchip_discount_price}}">
                                                                    <input type="hidden" name="sell_cus_name"
                                                                        value="{{ $order->order_cus_name}}">
                                                                    <input type="hidden" name="sell_cus_tel_no"
                                                                        value="{{ $order->order_cus_tel_no}}">
                                                                    <input type="hidden" name="sell_cus_address"
                                                                        value="บ้านเลขที่ {{ $order->order_cus_house_no}} หมู่ที่ {{ $order->order_cus_village_no}} ซอย {{ $order->order_cus_lane}} ถนน {{ $order->order_cus_road}} จังหวัด {{ $order->order_cus_province}} อำเภอ {{ $order->order_cus_amphures}} ตำบล {{ $order->order_cus_districts}} หมายเลขไปรณีย์ {{ $order->order_cus_post_no}}">
                                                                    <input type="hidden" name="sell_transport_price"
                                                                        value="{{ $order->order_transport_price}}">
                                                                    {{-- Variable for create sell --}}
                                                                    <p>คุณต้องการยืนยันรายการจัดส่งสินค้า รหัส
                                                                        {{ $order->id }}
                                                                        {{ $order->order_dog }}
                                                                        {{ $order->order_microchip }}</p>
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
                                                <!-- .Confirm Modal -->
                                                <!-- Trigger cancel modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="ส่งใหม่"
                                                    data-target="#cancel{{ $order->id }}Modal">
                                                    <i class="fas fa-redo"></i>
                                                </button>

                                                <!-- Cancel Modal -->
                                                <div class="modal fade" id="cancel{{ $order->id }}Modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="cancel{{ $order->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="cancel{{ $order->id }}ModalLabel">
                                                                    ยืนยันการจัดส่งสินค้าใหม่
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>คุณต้องการยืนยันการจัดส่งสินค้าใหม่ รหัส
                                                                    {{ $order->id }}
                                                                    {{ $order->order_dog }}
                                                                    {{ $order->order_microchip }}</p>
                                                                <div class="form-group text-right">
                                                                    <form
                                                                        action="{{ route('manage_orders.resend',$order->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <input type="hidden" name="order_type" value="{{$order->order_type}}">
                                                                        <input type="hidden" name="dog_id" value="{{$order->dog_id}}">
                                                                        <input type="hidden" name="microchip_id" value="{{$order->microchip_id}}">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="submit"
                                                                            class="btn btn-main">ยืนยัน</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>

                                        </td>
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
