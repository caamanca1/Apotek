@extends('layouts.template')

@section('content')
@if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
@if (Session::get('deleted'))
            <div class="alert alert-danger">{{ Session::get('deleted') }}</div>
@endif

<button type="button" class="btn btn-secondary mb-4 float-end">
    <a href="{{ route('user.create') }}" style="text-decoration: none; color: white;">Tambah Akun</a>
</button>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
                @foreach ($users as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->role }}</td>
                        <td class="d-flex justify-content-center">

                            <a href="{{ route('user.edit', $item->id)}}" class="btn btn-primary me-3">Edit</a>
                            <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}">Hapus</button>
                        
                            <div class="modal fade" id="exampleModal-{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    Hapus ga?
                                  </div>
                                  <div class="modal-footer">
                                          <form action="{{ route('user.delete', $item->id) }}" method="post">
                                              @csrf
                                              @method('DELETE')
                                      <button type="submit" class="btn btn-danger">Iya, Hapus</button>
                                  </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Gajadi</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
@endsection



  
    

