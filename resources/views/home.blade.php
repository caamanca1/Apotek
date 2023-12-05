@extends('layouts.template')

@section('content')
@if (Session::get('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if (Session::get('LoggedIn'))
    <div class="alert alert-danger">{{ Session::get('LoggedIn') }}</div>
@endif
<div class="jumbotron py-4 px-5">
    <h1 class="display-4">
        Selamat Datang, {{ Auth::user()->name }}!
    </h1>
    <hr class="my-4">
    <p>Aplikasi ini digunakan oleh pegawai apotek sebagai alat untuk mengelola obat, penyetokan, juga pembelian (kasir)</p>
</div>
@endsection
