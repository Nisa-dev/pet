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
                        <li class="breadcrumb-item active" aria-current="page">จัดการช่องทางจัดส่ง</li>
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
                            <h1 class="h2">จัดการช่องทางจัดส่ง</h1>
                            <div class="mb-2 mb-md-0">
                                <div class="btn-group">
                                    {{-- Triger add Modal --}}
                                    <button type="button" class="btn btn-main" data-toggle="modal"
                                        data-target="#addTransportModal">
                                        เพิ่มช่องทางจัดส่ง
                                    </button>
                                    {{-- Add Modal --}}
                                    <div class="modal fade" id="addTransportModal" tabindex="-1" role="dialog"
                                        aria-labelledby="addTransportModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h4 class="modal-title" id="addTransportModalLabel">
                                                        เพิ่มช่องทางจัดส่ง
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('manage_transports.store') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="transport_count" value="0">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-8">
                                                                <label>ช่องทางจัดส่ง</label>
                                                                <input type="text" class="form-control"
                                                                    name="transport_name" required>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label>ค่าจัดส่ง</label>
                                                                <input type="number" class="form-control"
                                                                    name="transport_price" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group text-right">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">ยกเลิก</button>
                                                            <button type="submit"
                                                                class="btn btn-main">บันทึกข้อมูล</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>รหัส</th>
                                        <th>ช่องทาง</th>
                                        <th>ค่าจัดส่ง</th>
                                        <th>จำนวนการส่ง</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transports as $transport)
                                    <tr>
                                        <td>{{ $transport->id }}</td>
                                        <td>{{ $transport->transport_name }}</td>
                                        <td>{{ $transport->transport_price }}</td>
                                        <td>{{ $transport->transport_count }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-link text-dark"
                                                    href="{{ route('manage_transports.show',[$transport->id, $transport->transport_name]) }}"
                                                    role="button"><i class="fas fa-eye"></i>
                                                </a>

                                                <!-- Trigger edit modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal"
                                                    data-target="#edit{{ $transport->id }}Modal">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <!-- Edit Modal -->
                                                <div class="modal fade" id="edit{{ $transport->id }}Modal" tabindex="-1"
                                                    role="dialog" aria-labelledby="edit{{ $transport->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h4 class="modal-title"
                                                                    id="edit{{ $transport->id }}ModalLabel">
                                                                    แก้ไขช่องทางจัดส่ง</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('manage_transports.update',$transport->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <input type="hidden" name="transport_count"
                                                                        value="{{ $transport->transport_count}}">
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-8">
                                                                            <label>ช่องทางจัดส่ง</label>
                                                                            <input type="text" class="form-control"
                                                                                name="transport_name"
                                                                                value="{{ $transport->transport_name }}"
                                                                                required>
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label>ค่าจัดส่ง</label>
                                                                            <input type="number" class="form-control"
                                                                                name="transport_price"
                                                                                value="{{ $transport->transport_price }}"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group text-right">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">ยกเลิก</button>
                                                                        <button type="submit"
                                                                            class="btn btn-main">บันทึกข้อมูล</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Trigger delete modal -->
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal"
                                                    data-target="#delete{{ $transport->id }}Modal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete{{ $transport->id }}Modal"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="delete{{ $transport->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="delete{{ $transport->id }}ModalLabel">
                                                                    ยืนยันการลบช่องทางจัดส่ง
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>คุณต้องการลบช่องทางจัดส่ง รหัส {{ $transport->id }}
                                                                    "{{ $transport->transport_name }}"
                                                                    หรือไม่?</p>
                                                                <div class="form-group text-right">
                                                                    <form
                                                                        action="{{ route('manage_transports.destroy',$transport->id) }}"
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
                                {!! $transports->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
