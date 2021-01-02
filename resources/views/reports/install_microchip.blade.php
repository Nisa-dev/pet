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
                        <li class="breadcrumb-item active" aria-current="page">รายงานติดตั้งไมโครชิพ</li>
                    </ol>
                </nav>

                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <div
                            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h1 class="h2">รายงานติดตั้งไมโครชิพ</h1>
                        </div>

                        <form action="{{route('report_install.search')}}" method="get">
                            <div class="form-row">
                                <div class="input-group mb-3">
                                    <input type="search" name="search" class="form-control" placeholder="กรอกหมายเลขไมโครชิพ">
                                    <div class="input-group-append">
                                        <button class="btn btn-main" type="submit">
                                            <i class="fas fa-search"></i> ค้นหา
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>รหัส</th>
                                        <th>หมายเลขไมโครชิพ</th>
                                        <th>สุนัข</th>
                                        <th>เจ้าของ</th>
                                        <th width="300px">ที่อยู่เจ้าของ</th>
                                        <th>ติดต่อเจ้าของ</th>
                                        <th width="100px">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($installs as $install)
                                    <tr>
                                        <td>{{ $install->id }}</td>
                                        <td>{{ $install->install_microchip_no }}</td>
                                        <td>
                                            {{ $install->install_microchip_breed }}
                                            {{ $install->install_microchip_color }}
                                            {{ $install->install_microchip_sex }}    
                                        </td>
                                        <td>{{ $install->install_microchip_owner_name }}</td>
                                        <td>
                                            เลขที่
                                            {{$install->install_microchip_owner_house_no}}
                                            หมู่ที่
                                            {{$install->install_microchip_owner_village_no}}
                                            ซ.
                                            {{$install->install_microchip_owner_lane}}
                                            ถ.
                                            {{$install->install_microchip_owner_road}}
                                            จ.
                                            {{$install->install_microchip_owner_province}}
                                            อ.
                                            {{$install->install_microchip_owner_amphures}}
                                            @if ($install->install_microchip_owner_districts != null)
                                            ต.
                                            {{$install->install_microchip_owner_districts}}
                                            @endif
                                            {{$install->install_microchip_owner_post_no}}    
                                        </td>
                                        <td>{{ $install->install_microchip_owner_tel_no }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-link text-dark" href="{{route('pdf_install_microchip',$install->id)}}" target="_blank" role="button"><i
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
                                {!! $installs->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
