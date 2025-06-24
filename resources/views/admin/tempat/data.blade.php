@extends('layouts.app')

@section('content')
    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="card card-social">
                    <div class="card-block border-bottom">
                        <div class="row">
                            <div class="d-flex justify-content-between mb-3">
                                <a href="{{ route('admin.tempat.tambah') }}" class="btn btn-primary">Tambah Kode Tempat
                                    +</a>
                            </div>
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table class="table border table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Kode Tempat</th>
                                                <th>Nama Tempat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tempats as $tempat)
                                                <tr>
                                                    <td>{{ $tempat->kode_tempat }}</td>
                                                    <td>{{ $tempat->nama_tempat ?? '-' }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.tempat.edit', $tempat->kode_tempat) }}"
                                                            class="btn btn-sm btn-warning">Edit</a>
                                                        <form
                                                            action="{{ route('admin.tempat.hapus', $tempat->kode_tempat) }}"
                                                            method="POST" style="display:inline-block;"
                                                            onsubmit="return confirm('Hapus tempat ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- Pagination --}}
                                <div class="d-flex justify-content-start mt-3">
                                    {{ $tempats->links() }}
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    @endsection
