@extends('layouts.app')
{{-- ==================== PAGE TITLE ==================== --}}
@section('title', 'Data Admin')

{{-- ==================== STYLES ==================== --}}
@section('styles')
@endsection

{{-- ==================== CONTENT ==================== --}}
@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Admin</h4>
                        @include('partials.alert')
                    <button type="button" class="btn btn-primary mb-3 mt-1" data-toggle="modal" data-target="#staticBackdrop">
                        Tambah Data Admin
                    </button>

                    <div class="table-responsive">
                        <table id="admin-table" class="table-hover table text-center">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama Admin</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Alamat</th>
                                    <th class="text-center">No Telepon</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content forms-sample" action="{{ route('manajer.admin.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @include('partials.alert')

                    <div class="form-group">
                        <label for="nama_admin">Nama Admin</label>
                        <input type="text" class="form-control @error('nama_admin') is-invalid @enderror"
                            id="nama_admin" name="nama_admin" value="{{ old('nama_admin') }}"
                            placeholder="Nama Admin" required>
                        @error('nama_admin')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" placeholder="Email" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                            name="alamat" value="{{ old('alamat') }}" placeholder="Alamat" required>
                        @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_telepon">No Telepon</label>
                        <input type="number" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon"
                            name="no_telepon" value="{{ old('no_telepon') }}" placeholder="No Telepon" required>
                        @error('no_telepon')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                      <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}" placeholder="name" required>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" placeholder="Password" required>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirm Password" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection

{{-- ==================== SCRIPTS ==================== --}}
@section('scripts')

    <script>
        $(function() {
            var table = $('#admin-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('manajer.admin.data') }}',
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_admin',
                        name: 'nama_admin'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'no_telepon',
                        name: 'no_telepon'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            // delegated event untuk tombol hapus (dapat dibuat di server-side render)
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                if (!id) return alert('ID tidak ditemukan.');

                if (!confirm('Yakin ingin menghapus data ini?')) return;

                $.ajax({
                    url: '/manajer/admin/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // respon JSON dari controller mengandung success & message
                        if (response && response.success) {
                            table.ajax.reload(null, false); // reload tanpa reset paging
                            alert(response.message || 'Data berhasil dihapus.');
                        } else {
                            alert(response.message || 'Gagal menghapus data.');
                        }
                    },
                    error: function(xhr) {
                        var msg = 'Terjadi kesalahan.';
                        try {
                            if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
                        } catch (e) {}
                        alert(msg);
                    }
                });
            });
        });
    </script>

@endsection
