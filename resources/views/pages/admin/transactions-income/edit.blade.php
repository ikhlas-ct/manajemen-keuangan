@extends('layouts.app')

@section('title', 'Edit Income Transaction')

@section('content')
<div class="container">

    <div class="card shadow-sm">
        <div class="card-body" style="font-size: 13px;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title mb-0">Edit Income</h4>
            </div>

            <form action="{{ route('income.update', $income->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                  @include('partials.alert')
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control select2" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $income->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="text" class="form-control form-control-sm date" id="date" name="date"
                           value="{{ \Carbon\Carbon::parse($income->date)->format('d-m-Y') }}" placeholder="Select Date" required>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control form-control-sm" id="amount" name="amount"
                           value="{{ $income->amount }}" placeholder="Enter Amount" required>
                </div>

                <div class="mb-3">
                    <label for="receipt_file" class="form-label">Receipt</label>
                    @if ($income->receipt_file)
                        <div class="mb-2">
                            <img id="preview"
                                src="{{ asset('storage/' . $income->receipt_file) }}"
                                alt="Preview"
                                style="max-width: 150px; border-radius: 8px;">
                        </div>
                    @else
                        <img id="preview" style="max-width: 150px; border-radius: 8px; display: none;">
                    @endif
                    <input type="file" class="form-control form-control-sm" id="receipt_file" name="receipt_file" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control form-control-sm" id="description" name="description" rows="2"
                              placeholder="Tambahkan Deskripsi">{{ $income->description }}</textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('income.index') }}" class="btn btn-sm text-white" style="background: grey">Cancel</a>
                    <button type="submit" class="btn btn-warning btn-sm text-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(".date", {
            dateFormat: "d-m-Y",
            allowInput: true,
            minDate: "today"
        });

        $('#category_id').select2({
            width: '100%',
            placeholder: "- Select Category -"
        });
    });

    const fileInput = document.getElementById('receipt_file');
    const preview = document.getElementById('preview');

    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });
</script>
