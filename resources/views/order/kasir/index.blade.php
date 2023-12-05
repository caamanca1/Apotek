@extends('layouts.template')

@section('content')
    <div class="container mt-3">
        <div class="d-flex justify-content-end">
            <a href="{{ route('kasir.order.create') }}" class="btn btn-primary">Pembelian Baru</a>
        </div>

        <form action="" method="GET" class="form-inline my-2 my-lg-2 d-flex">
            <input class="form-control w-25 h-25 mr-sm-2" type="date" placeholder="Search" aria-label="Search" name="Date">
            &nbsp;<button class="btn btn-outline-primary my-0 my-sm-10" type="submit">Cari data</button>
            &nbsp;<button class="btn btn-outline-danger my-0 my-sm-10" type="Reset">Clear</button>
        </form>

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Pembeli</th>
                    <th>Obat</th>
                    <th>Total Bayar</th>
                    <th>Kasir</th>
                    <th>Tanggal Beli</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($orders as $item)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $item['name_customer'] }}</td>
                        <td>
                            {{-- karena column medicines pada table orders bertipe json yang diubah formatnya menjadi array; maka dari itu untuk mengakses/menampilkan item nya perlu menggunakan looping --}}
                            @foreach ($item['medicines'] as $medicine)
                            <ol>
                                <li>
                                    {{-- mengakses key array assoc dari tiap item array value column medicines --}}
                                    {{ $medicine['name_medicine'] }} (Rp. {{ number_format($medicine['price'], 0, ',', '.') }} ) : Rp. {{ number_format($medicine['sub_price'], 0, ',', '.') }} <small>qty {{ $medicine['qty'] }}</small>
                                </li>
                            </ol>
                            @endforeach
                        </td>
                        <td>Rp. {{ number_format($item['total_price'], 0, ',', '.') }}</td>
                        {{-- karna nama kasir terdapat pada table users, dan relasi antara order dan users telah didefinisikan pada function relasi bernama user. maka, untuk mengakses column pada table users melalui relsi antara keduanya dapat dilakukan dengan $var ['namaFuncRelasi']['columnDariTableLainnya'] --}}
                        <td>{{ $item['user']['name'] }}</td>
                        {{-- <td>{{ $item['created_at'] }}</td> --}}
                        @php
                            // setting lokal time sebagai wilayah indonesia
                            setlocale(LC_ALL, 'IND');
                        @endphp
                        <td> {{ Carbon\Carbon::parse($item->created_at)->formatLocalized('%d %B %Y') }} </td>
                        <td>
                            <a href="{{ route('kasir.order.download', $item['id']) }}" class="btn btn-secondary">Download Setruk</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{-- jjika data ada atau > 0 --}}
            @if ($orders->count())
            {{-- munculkan tampilann pagination --}}
                {{ $orders->links() }}
            @endif
        </div>
    </div>
@endsection
