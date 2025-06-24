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
                                <a href="{{ route('admin.akun.tambah') }}" class="btn btn-primary">Tambah Akun
                                    +</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table border table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Tipe Akun</th>
                                            <th>Kode Tempat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($akuns as $index => $akun)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    {{ $akun->username }}
                                                    @if ($akun->username == Auth::user()->username)
                                                        <span class="text-success font-weight-bold font-italic">(akun
                                                            anda)</span>
                                                    @endif
                                                </td>
                                                <td>{{ $akun->tipe_akun }}</td>
                                                <td>{{ $akun->kode_tempat }}</td>
                                                <td>
                                                    <a href="{{ route('admin.akun.edit', $akun->username) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('admin.akun.hapus', $akun->username) }}"
                                                        method="POST" style="display:inline-block"
                                                        onsubmit="return confirm('Yakin hapus user ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Data tidak ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>


                            {{-- Pagination --}}
                            <div class="d-flex justify-content-start mt-3">
                                {{ $akuns->links() }}
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
@endsection
