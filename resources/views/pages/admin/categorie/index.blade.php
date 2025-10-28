{{-- @extends('layouts.app') 

@section('content')
<div class="col-lg-12 grid-margin stretch-card mx-auto">
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>

          <h4 class="card-title">Daftar Kategori Transaksi</h4>
          <p class="card-description">Kelola kategori untuk transaksi pemasukan dan pengeluaran perusahaan.</p>
        </div>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createCategoryModal" href="/categorie" :active="request()->is('categorie')">
          <i class="bi bi-plus-circle"></i> Tambah Kategori
        </button>
      </div>


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
            @forelse($categorie as $index => $category)
              <tr class="text-center">
                <td>{{ $index + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>
                  @if($category->type == 'income')
                    <label class="badge badge-success">Pemasukan</label>
                  @else
                    <label class="badge badge-danger">Pengeluaran</label>
                  @endif
                </td>
                <td>
                  <button 
                    class="btn btn-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#editCategoryModal"
                    data-id="{{ $category->id }}"
                    data-name="{{ $category->name }}"
                    data-type="{{ $category->type }}">
                    <i class="bi bi-pencil-square"></i>
                  </button>

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
    </div>
  </div>
</div>


<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('manajer.categories.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createCategoryModalLabel">Tambah Kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="name" class="form-control" placeholder="Contoh: Gaji, Operasional" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Tipe Transaksi</label>
            <select name="type" class="form-select" required>
              <option value="income">Pemasukan</option>
              <option value="expense">Pengeluaran</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title" id="editCategoryModalLabel">Edit Kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="name" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Tipe Transaksi</label>
            <select name="type" class="form-select" required>
              <option value="income">Pemasukan</option>
              <option value="expense">Pengeluaran</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-warning">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
  const editModal = document.getElementById('editCategoryModal');
  editModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget;
    const id = button.getAttribute('data-id');
    const name = button.getAttribute('data-name');
    const type = button.getAttribute('data-type');

    const form = editModal.querySelector('form');
    form.action = `/manajer/categories/${id}`;
    form.querySelector('input[name="name"]').value = name;
    form.querySelector('select[name="type"]').value = type;
  });
</script>
@endsection --}}




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
                  <button 
                    class="btn btn-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#editCategoryModal"
                    data-id="{{ $category->id }}"
                    data-name="{{ $category->name }}"
                    data-type="{{ $category->type }}">
                    <i class="bi bi-pencil-square"></i>
                  </button>

                  <button 
                    class="btn btn-danger btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteCategoryModal"
                    data-id="{{ $category->id }}"
                    data-name="{{ $category->name }}">
                    <i class="bi bi-trash3"></i>
                  </button>
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
@include('pages.admin.categorie.modal-edit')
@include('pages.admin.categorie.modal-delete')

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
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
});
</script>
@endsection
