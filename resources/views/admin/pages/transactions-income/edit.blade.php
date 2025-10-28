@extends('admin.layouts.app')

@section('title', 'Edit Income Transaction')

@section('content')
<div class="container">

    <div class="card shadow-sm">
        <div class="card-body" style="font-size: 13px;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="card-title mb-0">Edit Income</h4>
            </div>

            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control select2" required>
                        <option value="">-- Select Category --</option>
                        {{-- @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $income->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach --}}
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="text" class="form-control form-control-sm date" id="date" name="date"
                           value="" placeholder="Select Date" required>
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control form-control-sm" id="amount" name="amount"
                           value="" placeholder="Enter Amount" required>
                </div>

                <div class="mb-3">
                    <label for="receipt_file" class="form-label">Receipt</label>
                    <input type="file" class="form-control form-control-sm" id="receipt_file" name="receipt_file">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control form-control-sm" id="description" name="description" rows="2"
                              placeholder="Tambahkan Deskripsi">    </textarea>
                </div>

                <div class="text-end">
                    <a href="/income" class="btn btn-sm text-white" style="background: grey">Cancel</a>
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
            minDate: "today",
            allowInput: true
        });

        $('#category_id').select2({
            width: '100%',
            placeholder: "- Select Category -"
        });
    });
</script>

