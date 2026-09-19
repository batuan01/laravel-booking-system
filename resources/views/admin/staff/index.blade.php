@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>
                Quản lý nhân viên
                <a href="{{ route('admin.staff.create') }}" class="btn btn-primary pull-right">Thêm nhân viên</a>
            </h2>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staff as $member)
                        <tr>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->phone }}</td>
                            <td>{{ $member->is_active ? 'Hoạt động' : 'Ngừng' }}</td>
                            <td>
                                <a href="{{ route('admin.staff.edit', $member) }}">Sửa</a>
                                &nbsp;|&nbsp;
                                <form action="{{ route('admin.staff.destroy', $member) }}" method="POST" style="display: inline;" onsubmit="return confirm('Xóa nhân viên này?');">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-link" style="padding: 0;">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $staff->links() }}
        </div>
    </div>
</div>
@endsection
