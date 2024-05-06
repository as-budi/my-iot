
@extends('layouts.main')
@section('container')

    <h1>Devices</h1>

    @php
        $i = 1;
    @endphp
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Device Name</th>
                <th scope="col">Minimum Value</th>
                <th scope="col">Maximum Value</th>
                <th scope="col">Current Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devices as $device)
            <tr>
                <th scope="row">{{ $i }}</th>
                <td>
                    <a href="/devices/{{ $device["id"] }}">{{ $device["id"] }}</a>
                </td>
                <td>{{ $device["name"] }}</td>
                <td>{{ $device["min_value"] }}</td>
                <td>{{ $device["max_value"] }}</td>
                <td>{{ $device["current_value"] }}</td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
        </tbody>
    </table>
@endsection

