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
                        <li class="breadcrumb-item active" aria-current="page">ประวัติการลบข้อมูล</li>
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

                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                            <h1 class="h2">ประวัติการลบข้อมูล</h1>
                        </div>

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('delete_history.history_all') }}">ทั้งหมด</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">ประเภท</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item"
                                        {{-- href="#">สุนัข</a> --}}
                                        href="{{ route('delete_history.history_sort','สุนัข') }}">สุนัข</a>
                                    <a class="dropdown-item"
                                        {{-- href="#">ไมโครชิพ</a> --}}
                                        href="{{ route('delete_history.history_sort','ไมโครชิพ') }}">ไมโครชิพ</a>
                                </div>
                            </li>
                        </ul>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>รหัส</th>
                                        <th>รายการ</th>
                                        <th>ประเภท</th>
                                        <th>วันที่ลบ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($dogs != null)
                                    @foreach ($dogs as $dog)
                                    <tr>
                                        <td>{{ $dog->id }}</td>
                                        <td>
                                            @if ($dog->dog_image == null)
                                                <p>ไม่มีรูปภาพ</p>
                                            @else
                                            <p>
                                                <img class="img-fluid rounded" width="100" src="{{ asset('image/dogs/'.$dog->dog_image)}}"> &emsp;
                                                {{ $dog->dog_breed }} {{ $dog->dog_color }} {{ $dog->dog_sex }} (ฟาร์ม {{ $dog->dog_farm_name }})
                                            </p>
                                            @endif
                                        </td>
                                        <td>สุนัข</td>
                                        <td>{{ $dog->deleted_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!-- Trigger restore modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="กู้คืน"
                                                    data-target="#restore{{ $dog->id }}Modal">
                                                    <i class="fas fa-history"></i>
                                                </button>
                                                <!-- restore Modal -->
                                                <div class="modal fade" id="restore{{ $dog->id }}Modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="restore{{ $dog->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="restore{{ $dog->id }}ModalLabel">ยืนยันการกู้คืนข้อมูล รหัส {{ $dog->id }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group text-right">
                                                                    <form
                                                                        action="{{ route('delete_history.restore_dog',$dog->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="submit"
                                                                            class="btn btn-main">กู้คืนข้อมูล</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- .Delete Modal -->

                                                <!-- Trigger delete modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="ลบ"
                                                    data-target="#delete{{ $dog->id }}Modal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete{{ $dog->id }}Modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="delete{{ $dog->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="delete{{ $dog->id }}ModalLabel">ยืนยันการลบข้อมูล รหัส {{ $dog->id }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>ยืนยันการลบข้อมูล? การดำเนินการนี้ไม่สามารถย้อนกลับได้</p>
                                                                <div class="form-group text-right">
                                                                    <form
                                                                        action="{{ route('delete_history.destroy_dog',$dog->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="submit"
                                                                            class="btn btn-main">ลบข้อมูล</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- .Delete Modal -->
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    
                                    {{-- microchip --}}
                                    @if ($microchips != null)
                                    @foreach ($microchips as $microchip)
                                    <tr>
                                        <td>{{ $microchip->id }}</td>
                                        <td>ไมโครชิพหมายเลข {{ $microchip->microchip_no }}</td>
                                        <td>ไมโครชิพ</td>
                                        <td>{{ $microchip->deleted_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!-- Trigger restore modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="กู้คืน"
                                                    data-target="#restore{{ $microchip->id }}Modal">
                                                    <i class="fas fa-history"></i>
                                                </button>
                                                <!-- restore Modal -->
                                                <div class="modal fade" id="restore{{ $microchip->id }}Modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="restore{{ $microchip->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="restore{{ $microchip->id }}ModalLabel">ยืนยันการกู้คืนข้อมูล รหัส {{ $microchip->id }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group text-right">
                                                                    <form
                                                                        action="{{ route('delete_history.restore_microchip',$microchip->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="submit"
                                                                            class="btn btn-main">กู้คืนข้อมูล</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- .Delete Modal -->

                                                <!-- Trigger delete modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="ลบ"
                                                    data-target="#delete{{ $microchip->id }}Modal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete{{ $microchip->id }}Modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="delete{{ $microchip->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="delete{{ $microchip->id }}ModalLabel">ยืนยันการลบข้อมูล รหัส {{ $microchip->id }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>ยืนยันการลบข้อมูล? การดำเนินการนี้ไม่สามารถย้อนกลับได้</p>
                                                                <div class="form-group text-right">
                                                                    <form
                                                                        action="{{ route('delete_history.destroy_microchip',$microchip->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="submit"
                                                                            class="btn btn-main">ลบข้อมูล</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- .Delete Modal -->
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
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