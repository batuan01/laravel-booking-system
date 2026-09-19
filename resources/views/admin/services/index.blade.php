@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>
                Quản lý dịch vụ
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary pull-right">Thêm dịch vụ</a>
            </h2>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Thời lượng</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $service->name }}</td>
                            <td>{{ $service->duration }} phút</td>
                            <td>{{ number_format($service->price) }} đ</td>
                            <td>{{ $service->is_active ? 'Hoạt động' : 'Ngừng' }}</td>
                            <td>
                                <a href="{{ route('admin.services.edit', $service) }}">Sửa</a>
                                &nbsp;|&nbsp;
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display: inline;" onsubmit="return confirm('Xóa dịch vụ này?');">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-link" style="padding: 0;">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $services->links() }}
        </div>
    </div>
</div>
@endsection
