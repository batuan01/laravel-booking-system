@extends('layouts.app')

@php
    $dayNames = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'];
@endphp

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>
                Quản lý giờ làm việc
                <a href="{{ route('admin.working-hours.create') }}" class="btn btn-primary pull-right">Thêm giờ làm việc</a>
            </h2>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nhân viên</th>
                        <th>Ngày</th>
                        <th>Bắt đầu</th>
                        <th>Kết thúc</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($workingHours as $workingHour)
                        <tr>
                            <td>{{ $workingHour->staff->name ?? '—' }}</td>
                            <td>{{ $dayNames[$workingHour->day_of_week] }}</td>
                            <td>{{ $workingHour->start_time }}</td>
                            <td>{{ $workingHour->end_time }}</td>
                            <td>
                                <a href="{{ route('admin.working-hours.edit', $workingHour) }}">Sửa</a>
                                &nbsp;|&nbsp;
                                <form action="{{ route('admin.working-hours.destroy', $workingHour) }}" method="POST" style="display: inline;" onsubmit="return confirm('Xóa giờ làm việc này?');">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-link" style="padding: 0;">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $workingHours->links() }}
        </div>
    </div>
</div>
@endsection
