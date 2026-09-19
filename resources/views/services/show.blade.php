@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <a href="{{ route('services.index') }}">&larr; Quay lại danh sách dịch vụ</a>

            <div class="panel panel-default" style="margin-top: 15px;">
                <div class="panel-heading">{{ $service->name }}</div>
                <div class="panel-body">
                    <p>{{ $service->description }}</p>
                    <p><strong>Thời lượng:</strong> {{ $service->duration }} phút</p>
                    <p><strong>Giá:</strong> {{ number_format($service->price) }} đ</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
