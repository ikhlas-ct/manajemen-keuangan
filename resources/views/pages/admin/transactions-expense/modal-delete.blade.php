<div class="modal fade" id="deleteExpenseModal" tabindex="-1" aria-labelledby="deleteExpenseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg rounded">
            <form id="formDeleteExpense" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-header bg-danger text-white py-2 px-3">
                    <h4 class="modal-title mb-0" id="deleteExpenseModalLabel">
                        <i class="bi bi-trash3-fill"></i> Delete Expense
                    </h4>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center" style="font-size: 14px;">
                    <p class="mb-1">Are you sure you want to delete this expense?</p>
                </div>

                <div class="modal-footer justify-content-center py-2">
                    <button type="button" class="btn btn-sm px-3" style="color: grey" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger btn-sm px-3">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll('.btn-delete-expense');
        const formDelete = document.getElementById('formDeleteExpense');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                formDelete.action = '/expense/' + id;
            });
        });
    });
</script>
