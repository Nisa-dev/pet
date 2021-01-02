@extends('layouts.app')
@section('title', __('รายการสุนัขของฉัน -'))
@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="text-center">
        <h1 class="my-4">@lang("รายการสุนัขของฉัน")</h1>
    </div>

    <div class="card">
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

            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead class="thead-dark">
                        <tr>
                            <th>@lang("ลำดับ")</th>
                            <th>@lang("สุนัข")</th>
                            <th>@lang("หมายเลขไมโครชิพ")</th>
                            <th>@lang("จัดการ")</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dog_installs as $dog_install)
                        <tr>
                            <th>{{ ++$i }}</th>
                            <td>{{$dog_install->install_microchip_breed}} {{$dog_install->install_microchip_color}}
                                {{$dog_install->install_microchip_sex}}</td>
                            <td>{{$dog_install->install_microchip_no}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <form action="{{route('my_lists.show')}}" method="GET">
                                        @csrf
                                        <input type="hidden" name="dog_id" value="{{$dog_install->dog_id}}">
                                        <input type="hidden" name="microchip_id" value="{{$dog_install->microchip_id}}">
                                        <input type="hidden" name="install_microchip_no" value="{{$dog_install->install_microchip_no}}">
                                        <button type="submit" class="btn btn-link text-dark"><i
                                                class="fas fa-eye"></i></button>
                                    </form>
                                    <form action="{{route('my_lists.delete',$dog_install->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <button type="submit" class="btn btn-link text-dark"><i
                                                class="fas fa-minus"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td>@lang("ไม่มีข้อมูล")</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="row">
        <div class="col-md-4 text-center">

        </div>
        <div class="col-md-8">

        </div>
    </div>
</div>
@endsection
