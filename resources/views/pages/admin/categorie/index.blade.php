@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card mx-auto">
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h4 class="card-title">Daftar Kategori Transaksi</h4>
          <p class="card-description">Kelola kategori untuk transaksi pemasukan dan pengeluaran perusahaan.</p>
        </div>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createCategoryModal">
          <i class="bi bi-plus-circle"></i> Tambah Kategori
        </button>
      </div>

      {{-- Pesan sukses --}}
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr class="text-center">
              <th>No</th>
              <th>Nama Kategori</th>
              <th>Tipe Transaksi</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($categories as $index => $category)
              <tr class="text-center">
                <td>{{ $index + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>
                  @if($category->type == 'income')
                    <span class="badge bg-success">Pemasukan</span>
                  @else
                    <span class="badge bg-danger">Pengeluaran</span>
                  @endif
                </td>

                <td>
                    {{-- Tombol Edit --}}
                  <a href="{{ route('manajer.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  {{-- Tombol Delete --}}
                  <form action="{{ route('manajer.categories.destroy', $category->id) }}" 
                        method="POST" class="d-inline"
                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash3"></i>
                      </button>
                  </form>
                </td>

              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center text-muted">Belum ada kategori tersedia.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-3">
        {{-- {{ $categories->links() }} --}}
      </div>
    </div>
  </div>
</div>

@include('pages.admin.categorie.modal-create')


@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // === Modal Edit ===
  const editModal = document.getElementById('editCategoryModal');
  if (editModal) {
    editModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const name = button.getAttribute('data-name');
      const type = button.getAttribute('data-type');

      const form = editModal.querySelector('form');
      form.action = `/categories/${id}`;
      form.querySelector('input[name="name"]').value = name;
      form.querySelector('select[name="type"]').value = type;
    });
  }

  // === Modal Delete ===
  const deleteModal = document.getElementById('deleteCategoryModal');
  if (deleteModal) {
    deleteModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const name = button.getAttribute('data-name');

      const form = deleteModal.querySelector('form');
      form.action = `/categories/${id}`;
      deleteModal.querySelector('#deleteCategoryName').textContent = name;
    });
  }


  // === Modal Tambah (Create) ===
  const createModal = document.getElementById('createCategoryModal');
  if (createModal) {
    // Reset form setiap kali modal ditutup (baik tekan batal atau klik luar)
    createModal.addEventListener('hidden.bs.modal', function () {
      const form = createModal.querySelector('form');
      form.reset();
    });
  }
  
});
</script>
@endsection
