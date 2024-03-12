@extends('layout')


@section('content')
    <div class="container text-center">
        <div class="row">
            @if (count($sensors) == 0)
                <div class="alert alert-primary" role="alert">
                    <h1>No sensors</h1>
                </div>
            @endif
            @foreach ($sensors as $sensor)
                <div class="col-md-4">
                    <div class="card">

                        <div class="card-body">
                            <h2 class="card-title">{{ $sensor['serialNum'] }}</h2>
                            <h4 class="card-subtitle mb-2 text-body-secondary">{{ $sensor['senName'] }}</h4>
                            <h6 class="card-text mb-2 text-body-secondary">{{ $sensor['sensor_type'] }}</h6>
                        </div>
                    </div>

                    @if (count($sensor['measurements']) == 0)
                        <div class="alert alert-primary" role="alert">
                            <h1>No measurements</h1>
                        </div>
                    @else
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Value</th>
                                    <th scope="col">Units</th>
                                    <th scope="col">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = count($sensor['measurements']) - 1; $i >= 0; $i--)
                                    <tr>
                                        <th scope="row">{{ $i+1 }}</th>
                                        <td>{{ $sensor['measurements'][$i]['value'] }}</td>
                                        <td>{{ $sensor['measurements'][$i]['unit'] }}</td>
                                        <td>{{ $sensor['measurements'][$i]['time'] }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
