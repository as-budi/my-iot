
{{-- @dd($device) --}}

@extends('layouts.main')
@section('container')
<h1>{{ $device["name"] }}</h1>
<h2>Current Value: {{ $data[0]["data"] }}</h2>

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
        @foreach($data as $d)
        <tr>
            <th scope="row">{{ $i }}</th>
            <td>{{ $d["created_at"] }}</td>
            <td>{{ $d["data"] }}</td>
        </tr>
        @php
            $i++;
        @endphp
    @endforeach
    </tbody>
</table>

<a href="/devices">back to Devices</a>
@endsection