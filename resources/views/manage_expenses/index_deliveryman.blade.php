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
                        <li class="breadcrumb-item active" aria-current="page">การเงินธุรกิจ</li>
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
                            <h1 class="h2">การเงินธุรกิจ</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                    <div class="btn-group mr-2">
                                        {{-- Triger add Modal --}}
                                        <button type="button" class="btn btn-main" data-toggle="modal"
                                            data-target="#addExpenseModal">
                                            เพิ่มค่าใช้จ่าย
                                        </button>
                                        {{-- Add Modal --}}
                                        <div class="modal fade" id="addExpenseModal" tabindex="-1" role="dialog"
                                            aria-labelledby="addExpenseModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header border-0">
                                                        <h4 class="modal-title" id="addExpenseModalLabel">เพิ่มค่าใช้จ่าย
                                                        </h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('manage_expenses.store_deliveryman') }}" method="POST">
                                                            @csrf
                                                            <div class="form-row">
                                                                <div class="form-group col-md">
                                                                    <label>รายการ</label>
                                                                    <input type="text" class="form-control"
                                                                        name="list" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label>จำนวน</label>
                                                                    <input type="number" class="form-control"
                                                                        name="amount" required>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label>ค่าใช้จ่าย</label>
                                                                    <input type="number" class="form-control"
                                                                        name="cost" required>
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
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">รหัส</th>
                                        <th class="text-center">รายการ</th>
                                        <th class="text-center">จำนวน</th>
                                        <th class="text-center">ค่าใช้จ่าย</th>
                                        <th class="text-center">สุทธิ</th>
                                        <th class="text-center" width="100px">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" value="{{$total = 0}}">
                                    @forelse ($expenses as $expense)
                                        <tr>
                                            <td class="text-center">{{$expense->id}}</td>
                                            <td>{{$expense->list}}</td>
                                            <td class="text-right">{{$expense->amount}}</td>
                                            <td class="text-right">{{number_format($expense->cost)}}</td>
                                            <td class="text-right">{{number_format($net = $expense->cost * $expense->amount)}}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <!-- Trigger edit modal -->
                                                    <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="แก้ไข"
                                                        data-target="#edit{{ $expense->id }}Modal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="edit{{ $expense->id }}Modal" tabindex="-1" 
                                                        role="dialog" aria-labelledby="edit{{ $expense->id }}ModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header border-0">
                                                                    <h4 class="modal-title"
                                                                        id="edit{{ $expense->id }}ModalLabel">
                                                                        แก้ไขค่าใช้จ่าย</h4>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-left">
                                                                    <form
                                                                        action="{{ route('manage_expenses.update_deliveryman',$expense->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <div class="form-row">
                                                                            <div class="form-group col-md">
                                                                                <label>รายการ</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="list"
                                                                                    value="{{ $expense->list}}"
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="form-group col-md-6">
                                                                                <label>จำนวน</label>
                                                                                <input type="number" class="form-control"
                                                                                    name="amount"
                                                                                    value="{{ $expense->amount}}"
                                                                                    required>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label>ค่าใช้จ่าย</label>
                                                                                <input type="number" class="form-control"
                                                                                    name="cost"
                                                                                    value="{{ $expense->cost}}"
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
                                                <button type="button" class="btn btn-link text-dark" data-toggle="modal" title="ลบ"
                                                    data-target="#delete{{ $expense->id }}Modal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="delete{{ $expense->id }}Modal"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="delete{{ $expense->id }}ModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-0">
                                                                <h5 class="modal-title"
                                                                    id="delete{{ $expense->id }}ModalLabel">
                                                                    ยืนยันการลบค่าใช้จ่าย</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-left">คุณต้องการลบค่าใช้จ่าย รหัส {{ $expense->id }}
                                                                    "{{ $expense->list }}" หรือไม่?</p>
                                                                <div class="form-group text-right">
                                                                    <form
                                                                        action="{{ route('manage_expenses.destroy_deliveryman',$expense->id) }}"
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
                                                <!-- Delete Modal -->
                                                </div>
                                            </td>
                                            <input type="hidden" value="{{$total += $net}}">
                                        </tr>
                                    @empty
                                        <td colspan="5">ไม่มีข้อมูล</td>
                                    @endforelse
                                    @if (!empty($expenses))
                                    <tr>
                                        <th class="text-right" colspan="4">รวม</th>
                                        <th class="text-right">{{number_format($total)}}</th>
                                        <td></td>
                                    </tr>
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