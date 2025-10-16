@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Wali Kelas</h1>
    <p>Halo, {{ auth()->user()->name }}.</p>
</div>
@endsection
