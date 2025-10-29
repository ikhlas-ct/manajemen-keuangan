@extends('layouts.app')

{{-- ==================== PAGE TITLE ==================== --}}
@section('title', 'Data Pengeluaran')

@section('styles')
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Pengeluaran</h4>
                    @include('partials.alert')

                    <div class="d-flex justify-content-between mb-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                            Tambah Pengeluaran
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table id="pengeluaran-table" class="table-hover table-bordered table-striped table text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Jumlah</th>
                                    <th>Admin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah (server-side post ke controller) -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="formTambah" class="modal-content" method="POST"
                action="{{ route('admin.transaksi.pengeluaran.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Pengeluaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="date" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" name="description" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" name="amount" class="form-control" required />
                    </div>

                    <div class="form-group">
                        <label>Bukti (opsional)</label>
                        <input type="file" name="receipt_file" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" />
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

@section('scripts')
    <script>
        $(function() {
            // DataTable server-side
            var table = $('#pengeluaran-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.transaksi.pengeluaran.data') }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'amount_formatted',
                        name: 'amount',
                        className: 'text-right'
                    },
                    {
                        data: 'admin_name',
                        name: 'admin_name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [1, 'desc']
                ]
            });

            // delete via ajax
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                if (!id) return alert('ID tidak ditemukan.');
                if (!confirm('Yakin ingin menghapus data ini?')) return;

                $.ajax({
                    url: '{{ url('/admin/transaksi/pengeluaran') }}/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        if (res && res.success) {
                            table.ajax.reload(null, false);
                            alert(res.message || 'Data berhasil dihapus.');
                        } else {
                            alert(res.message || 'Gagal menghapus data.');
                        }
                    },
                    error: function(xhr) {
                        var msg = 'Terjadi kesalahan.';
                        try {
                            if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr
                                .responseJSON.message;
                        } catch (e) {}
                        alert(msg);
                    }
                });
            });
        });
    </script>
@endsection
