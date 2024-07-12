<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateForm">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="updateID" name="id_kompanija" readonly>
                    </div>
                    <div class="form-group">
                        <label for="updateNaziv">Naziv</label>
                        <input type="text" class="form-control" id="updateNaziv" name="naziv">
                    </div>
                    <div class="form-group">
                        <label for="updateEmail">E-mail</label>
                        <input type="email" class="form-control" id="updateEmail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="updateTelefon">Telefon</label>
                        <input type="text" class="form-control" id="updateTelefon" name="telefon">
                    </div>
                    <textarea id="summernote" name="editordata"></textarea>
                    <button type="button" class="btn btn-primary" id="saveCreate">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        $('#createModal .close').on('click', function() {
            $('#createModal').modal('hide');
        });
        $('#saveCreate').on('click', function() {
            const updatedData = {
                id_kompanija: $('#updateID').val(),
                naziv: $('#updateNaziv').val(),
                mail: $('#updateEmail').val(),
                telefon: $('#updateTelefon').val()
            };

            $.ajax({
                url: '/admin/api/stranica/create.php', 
                type: 'POST',
                data: JSON.stringify(updatedData),
                contentType: 'application/json; charset=utf-8',
                success: function(response) {
                    $('#createModal').modal('hide');
                    datatable.ajax.reload(); // Reload DataTable to see the changes
                },
                error: function(xhr, status, error) {
                    console.error('Update failed:', error);
                }
            });
        });
</script>