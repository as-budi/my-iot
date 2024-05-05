
@extends('layouts.main')
@section('container')

    <h1>Devices</h1>

    @php
        $i = 1;
    @endphp
    <table border="1" cellpadding="10" cellspacing="0">
        <td>No</td>
        <td>ID</td>
        <td>Device Name</td>
        <td>Min</td>
        <td>Max</td>
        <td>Current Value</td>
        @foreach($devices as $device)
            <tr>
                <td>{{ $i }}</td>
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

@endsection

