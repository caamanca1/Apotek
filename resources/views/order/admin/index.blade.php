@extends('layouts.template')

@section('content')
    <div class="container mt-3">
        <div class="d-flex justify-content-end">
            <a href="{{ route('order.export-excel') }}" class="btn btn-primary">Export Data (excel)</a>
        </div><br>

        <form action="" method="GET" class="form-inline my-2 my-lg-2 d-flex">
            <input class="form-control w-25 h-25 mr-sm-2" type="date" placeholder="Search" aria-label="Search" name="Date">
            &nbsp;<button class="btn btn-outline-primary my-0 my-sm-10" type="submit">Cari data</button>
            &nbsp;<button class="btn btn-outline-danger my-0 my-sm-10" type="Reset">Clear</button>
        </form>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pembeli</th>
                    <th>Obat</th>
                    <th>Kasir</th>
                    <th>Tanggal Beli</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        {{-- menampilkan angka urutan berdasarkan page pagination (digunakan ketika mengambil data dengan paginate / simple paginate ) --}}
                        <td> {{ ($orders->currentpage()-1)* $orders->perpage() + $loop->index + 1 }} </td>
                        <td>{{ $order->name_customer }}</td>
                        <td>
                            {{-- nested loop : didalam looping ada looping --}}
                            {{-- karena columns medicines tipe datanya berbentuk array json, maka untuk mengaksesnya perlu di looping --}}
                            <ol>
                                @foreach ($order['medicines'] as $medicine)
                                    <li>
                                        {{-- hasil yang diinginkan : --}}
                                        {{-- 1. nama obat (Rp. 3000) :  Rp. 15000 qty 5 --}}
                                        {{ $medicine['name_medicine'] }}
                                        ( Rp. {{ number_format($medicine['price'], 0, ',','.') }} ) :
                                        Rp. {{ number_format($medicine['sub_price'], 0, ',','.') }}
                                        <small>qty {{ $medicine['qty'] }}</small>
                                    </li>
                                @endforeach
                            </ol>
                        </td>
                        <td>{{ $order['user']['name'] }}</td>
                        {{-- carbon : package bawaan laravel untuk mengatur hal2 yang berkaitan dengan tipe data date/datetime --}}
                        @php
                            // setting lokal time sebagai wilayah indonesia
                            setlocale(LC_ALL, 'IND');
                        @endphp
                        <td> {{ Carbon\Carbon::parse($order->created_at)->formatLocalized('%d %B %Y') }} </td>
                        <td> <a href="{{ route('order.download', $order['id']) }}" class="btn btn-secondary">Unduh (.pdf)</a> </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
