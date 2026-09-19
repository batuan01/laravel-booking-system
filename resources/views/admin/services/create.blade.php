@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Thêm dịch vụ</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="margin-bottom: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.services.store') }}" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label>Tên dịch vụ</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Thời lượng (phút)</label>
                    <input type="number" name="duration" class="form-control" value="{{ old('duration') }}">
                </div>

                <div class="form-group">
                    <label>Giá (đ)</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
                </div>

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_active" value="1" checked> Hoạt động
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{ route('admin.services.index') }}" class="btn btn-default">Hủy</a>
            </form>
        </div>
    </div>
</div>
@endsection
