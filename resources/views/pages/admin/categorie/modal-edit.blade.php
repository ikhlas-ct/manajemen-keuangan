@extends('layouts.app')

@section('content')
<div class="col-lg-6 grid-margin stretch-card mx-auto">
  <div class="card shadow-sm">
    <div class="card-body">
      <h4 class="card-title mb-4">Edit Kategori</h4>

      <form action="{{ route('manajer.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label class="form-label">Nama Kategori</label>
          <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Tipe Transaksi</label>
          <select name="type" class="form-select" required>
            <option value="income" {{ $category->type == 'income' ? 'selected' : '' }}>Pemasukan</option>
            <option value="expense" {{ $category->type == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
          </select>
        </div>

        <div class="d-flex justify-content-end gap-2">
          <a href="{{ route('manajer.categories.index') }}" class="btn btn-secondary">Batal</a>
          <button type="submit" class="btn btn-warning">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

