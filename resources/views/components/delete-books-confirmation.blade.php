<div class="modal fade" id="deleteBook" tabindex="-1" aria-labelledby="deleteBookLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteBookLabel">{{ __("You're sure to delete this record?") }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('books.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <input id="deleteId" name="id" hidden>
                    <div class="text-right justify-items-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger ms-3">
                            {{ __('Delete') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
