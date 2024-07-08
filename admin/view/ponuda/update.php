<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="updateID" name="id_ponuda" readonly>
                    </div>
                    <div class="form-group">
                        <label for="updateNaslov">Naslov</label>
                        <input type="text" class="form-control" id="updatenaslov" name="naslov">
                    </div>
                    <textarea id="summernote" name="editordata"></textarea>
                    <button type="button" class="btn btn-primary" id="saveUpdate">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        $('#updateModal .close').on('click', function() {
            $('#updateModal').modal('hide');
        });
        $('#saveUpdate').on('click', function() {
            const updatedData = {
                id_stranica: $('#updateID').val(),
                naziv: $('#updateNaziv').val(),
            };

            // Perform AJAX request to update the data
            $.ajax({
                url: '/admin/api/kompanija/update.php', // Adjust the URL to your update endpoint
                type: 'POST',
                data: JSON.stringify(updatedData),
                contentType: 'application/json; charset=utf-8',
                success: function(response) {
                    $('#updateModal').modal('hide');
                    datatable.ajax.reload(); // Reload DataTable to see the changes
                },
                error: function(xhr, status, error) {
                    console.error('Update failed:', error);
                }
            });
        });
</script>