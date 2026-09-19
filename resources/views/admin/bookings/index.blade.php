@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>
                    Quản lý đặt chỗ
                    <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary pull-right">Thêm đặt chỗ</a>
                </h2>

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Khách hàng</th>
                            <th>Dịch vụ</th>
                            <th>Nhân viên</th>
                            <th>Ngày</th>
                            <th>Giờ</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->service->name }}</td>
                                <td>{{ $booking->staff->name }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>
                                    <a href="{{ route('admin.bookings.edit', $booking) }}">Sửa</a>
                                    &nbsp;|&nbsp;
                                    <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST"
                                        style="display: inline;" onsubmit="return confirm('Xóa đặt chỗ này?');">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-link" style="padding: 0;">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $bookings->links() }}
            </div>
        </div>
    </div>
@endsection
