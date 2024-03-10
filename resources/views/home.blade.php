@extends('layout')


@section('content')
    <div class="container text-center">
        <div class="mt-5">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
                @if (count($aquariums) == 0)
                    <div class="alert alert-primary" role="alert">
                        <h1>No aquariums</h1>
                    </div>
                @else
                    @foreach ($aquariums as $aquarium)
                        <div class="card custom-card">
                            <a href="/sensors/{{ $aquarium['id'] }}" class="aquarium-link">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $aquarium['name'] }}</h3>
                                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $aquarium['id'] }}</h6>
                                </div>
                        </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
