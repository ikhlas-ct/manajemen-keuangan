<div class="modal fade" id="createIncomeModal" tabindex="-1" aria-labelledby="createIncomeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('income.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title" id="createIncomeModalLabel" style="font-weight: bold">+ Add Income</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="font-size: 13px;">
                    <div class="mb-2">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-control select2" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="date" class="form-label">Date</label>
                        <input type="text" class="form-control form-control-sm date" id="date" name="date" placeholder="Select Date" required>
                    </div>
                    <div class="mb-2">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" class="form-control form-control-sm" id="amount" name="amount" placeholder="Enter Amount" required>
                    </div>
                    <div class="mb-2">
                        <label for="receipt_file" class="form-label">Receipt</label>
                        <input type="file" class="form-control form-control-sm" id="receipt_file" name="receipt_file">
                    </div>
                    <div class="mb-2">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control form-control-sm" id="description" name="description" rows="2" placeholder="Tambahkan Deskripsi"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" style="background: grey" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        flatpickr(".date", {
            dateFormat: "d-m-Y",
            minDate: "today",
            allowInput: true
        });

        $('#category_id').select2({
            dropdownParent: $('#createIncomeModal'),
            width: '100%',
            placeholder: "- Select Category -"
        });
    });
</script>
