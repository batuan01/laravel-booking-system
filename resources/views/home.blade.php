@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading">Trang khách hàng</div>
                <div class="panel-body">
                    <ul class="list-unstyled" style="margin-bottom: 0;">
                        <li><a href="{{ route('services.index') }}">Danh sách dịch vụ</a></li>
                    </ul>
                </div>
            </div>

            @if (auth()->user()->isAdmin())
                <div class="panel panel-default">
                    <div class="panel-heading">Trang quản trị</div>
                    <div class="panel-body">
                        <ul class="list-unstyled" style="margin-bottom: 0;">
                            <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li><a href="{{ route('admin.services.index') }}">Quản lý dịch vụ</a></li>
                            <li><a href="{{ route('admin.staff.index') }}">Quản lý nhân viên</a></li>
                            <li><a href="{{ route('admin.working-hours.index') }}">Quản lý giờ làm việc</a></li>
                            <li><a href="{{ route('admin.bookings.index') }}">Quản lý booking</a></li>
                        </ul>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection
