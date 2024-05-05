@extends('layouts.main')
@section('container')
    <h1>Devices</h1>
    <h2> {{ $name }} </h2>
    <h3> Range value: {{ $min_value }} - {{ $max_value }} </h3>
    <p> Current value: {{ $current_value }} </p>
@endsection

