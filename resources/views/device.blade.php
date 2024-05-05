
{{-- @dd($device) --}}

@extends('layouts.main')
@section('container')
    <h2>{{ $device["name"] }} ({{ $device["id"] }})</h2>
    <h2>Value: {{ $device["current_value"] }}</h2>

    <a href="/devices">back to Devices</a>
@endsection