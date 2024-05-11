{{-- @dd($device) --}}

@extends('layouts.main')
@section('container')
    <h1>{{ $device['id'] }} - {{ $device['name'] }}</h1>
    {{-- <h4>Current Value: {{ $data[0]['data'] }}</h4> --}}

    <form class="form-group" action="{{ route('publish') }}" method="post">
        @csrf
        <div class="form-group mb-2">
            <input type="hidden" name="device_id" value={{ $device['id'] }}>
            <label class="sr-only">Insert a value for your device</label>
            <input type="number" name="data" class="form-control" id="value">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Publish</button>
    </form>

    @php
        $i = 1;
    @endphp
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Datetime</th>
                <th scope="col">Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $d['created_at'] }}</td>
                    <td>{{ $d['data'] }}</td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>

    <a href="/devices">back to Devices</a>
@endsection
