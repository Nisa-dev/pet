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
                            <li class="breadcrumb-item active" aria-current="page">รายงานสินค้าคงเหลือ</li>
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
                                <h1 class="h2">รายงานสินค้าคงเหลือ</h1>
                                <div class="btn-toolbar mb-2 mb-md-0">
                                    <div class="btn-group mr-2">
                                        <a class="btn btn-main" href="{{ route('pdf_stock') }}" target="_blank"
                                            role="button"><i class="fas fa-receipt"></i> ออกรายงาน</a>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('stock.index') }}">ทั้งหมด</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                            aria-haspopup="true" aria-expanded="false">ประเภท</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('stock.index_sort','สุนัข') }}">สุนัข</a>
                                            <a class="dropdown-item"
                                                href="{{ route('stock.index_sort','ไมโครชิพ') }}">ไมโครชิพ</a>
                                        </div>
                                    </li>
                                </ul>
    
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">ลำดับ</th>
                                            <th class="text-center">รายการ</th>
                                            <th class="text-center">ประเภท</th>
                                            <th class="text-center">ราคาซื้อ</th>
                                            <th class="text-center">ราคาขาย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <input type="hidden" value="{{$total_dog_buy = 0}}">
                                        <input type="hidden" value="{{$total_dog_sell = 0}}">
                                        <input type="hidden" value="{{$total_microchip_buy = 0}}">
                                        <input type="hidden" value="{{$total_microchip_sell = 0}}">
                                        @if ($dogs != null)
                                        @forelse ($dogs as $dog)
                                        <tr>
                                            <td class="text-center">{{++$i}}</td>
                                            <td >{{ $dog->dog_breed }} {{ $dog->dog_color }} {{ $dog->dog_sex }} {{ $dog->dog_farm_name }}</td>
                                            <td>สุนัข</td>
                                            <td class="text-right">{{number_format($dog->dog_buy_price,2)}}</td>
                                            <td class="text-right">{{number_format($dog->dog_sell_price,2)}}</td>
                                            <input type="hidden" value="{{$total_dog_buy += $dog->dog_buy_price}}">
                                            <input type="hidden" value="{{$total_dog_sell += $dog->dog_sell_price}}">
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5">ไม่มีข้อมูลสุนัข</td>
                                        </tr>
                                        @endforelse
                                        @endif
                                        @if ($microchips != null)
                                        @forelse ($microchips as $microchip)
                                        <tr>
                                            <td class="text-center">{{++$i}}</td>
                                            <td>ไมโครชิพหมายเลข {{$microchip->microchip_no}}</td>
                                            <td>ไมโครชิพ</td>
                                            <td class="text-right">{{number_format($microchip->microchip_buy_price,2)}}</td>
                                            <td class="text-right">{{number_format($microchip->microchip_sell_price,2)}}</td>
                                            <input type="hidden" value="{{$total_microchip_buy += $microchip->microchip_buy_price}}">
                                            <input type="hidden" value="{{$total_microchip_sell += $microchip->microchip_sell_price}}">
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5">ไม่มีข้อมูลไมโครชิพ</td>
                                        </tr>
                                        @endforelse
                                        @endif
                                        <tr>
                                            <th class="text-right" colspan="3">รวม</th>
                                            <th class="text-right">{{number_format($total_buy = $total_dog_buy + $total_microchip_buy,2)}}</th>
                                            <th class="text-right">{{number_format($total_sell = $total_dog_sell + $total_microchip_sell,2)}}</th>
                                        </tr>
                                        <tr>
                                            <th class="text-right" colspan="3">รวมราคาทุน</th>
                                            <th class="text-right" colspan="2">{{number_format($total_sell - $total_buy,2)}}</th>
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