@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Admin Dashboard</h2>

            <ul class="list-unstyled">
                <li><a href="{{ route('admin.services.index') }}">Quản lý dịch vụ</a></li>
                <li><a href="{{ route('admin.staff.index') }}">Quản lý nhân viên</a></li>
                <li><a href="{{ route('admin.working-hours.index') }}">Quản lý giờ làm việc</a></li>
                <li><a href="{{ route('admin.bookings.index') }}">Quản lý booking</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
