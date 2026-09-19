@extends('layouts.app')

@php
    $dayNames = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
@endphp

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Thêm giờ làm việc</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-bottom: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.working-hours.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Nhân viên</label>
                    <select name="staff_id" class="form-control">
                        @foreach ($staffList as $s)
                            <option value="{{ $s->id }}" {{ old('staff_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Ngày trong tuần</label>
                    <select name="day_of_week" class="form-control">
                        @foreach ($dayNames as $index => $day)
                            <option value="{{ $index }}" {{ old('day_of_week') == $index ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Giờ bắt đầu</label>
                    <input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}">
                </div>

                <div class="form-group">
                    <label>Giờ kết thúc</label>
                    <input type="time" name="end_time" class="form-control" value="{{ old('end_time') }}">
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{ route('admin.working-hours.index') }}" class="btn btn-default">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection
