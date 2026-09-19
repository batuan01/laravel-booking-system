@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Dịch vụ</h2>

            <div class="list-group">
                @foreach ($services as $service)
                    <a href="{{ route('services.show', $service) }}" class="list-group-item">
                        <h4 class="list-group-item-heading">{{ $service->name }}</h4>
                        <p class="list-group-item-text">
                            {{ $service->duration }} phút &mdash; {{ number_format($service->price) }} đ
                        </p>
                    </a>
                @endforeach
            </div>

            {{ $services->links() }}
        </div>
    </div>
</div>
@endsection
