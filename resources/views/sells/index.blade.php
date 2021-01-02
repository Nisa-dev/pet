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
                        <li class="breadcrumb-item active" aria-current="page">รายการขาย</li>
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
                            <h1 class="h2">รายการขาย</h1>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>รหัส</th>
                                        <th>รายการ</th>
                                        <th>วันที่ขาย</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sells as $sell)
                                    <tr>
                                        <td>{{ $sell->id }}</td>
                                        @if ($sell->sell_dog != null && $sell->sell_microchip == null)
                                        <td>{{ $sell->sell_dog }}</td>
                                        @elseif ($sell->sell_microchip != null && $sell->sell_dog == null)
                                        <td>{{ $sell->sell_microchip }}</td>
                                        @elseif ($sell->sell_dog != null && $sell->sell_microchip != null)
                                        <td>{{ $sell->sell_dog }} ,<br> {{ $sell->sell_microchip }}</td>
                                        @endif
                                        <td>{{ $sell->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-link text-dark" href="{{route('sells.show',$sell->id)}}" role="button" title="ดู"><i
                                                        class="fas fa-eye"></i></a>
                                                <a class="btn btn-link text-dark" href="{{route('pdf_sell',$sell->id)}}" target="_blank" role="button" title="ออกใบรายการขาย"><i
                                                        class="fas fa-receipt"></i></a>
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
                                {!! $sells->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
