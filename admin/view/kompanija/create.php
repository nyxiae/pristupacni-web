<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Novi unos</h5>
                <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm" class="modal-form">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="createID" name="id_kompanija" readonly>
                    </div>
                    <div class="form-group">
                        <label for="createNaziv">Naziv</label>
                        <input type="text" class="form-control" id="createNaziv" name="naziv">
                    </div>
                    <div class="form-group">
                        <label for="createEmail">E-mail</label>
                        <input type="email" class="form-control" id="createEmail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="createTelefon">Telefon</label>
                        <input type="text" class="form-control" id="createTelefon" name="telefon">
                    </div>
                    <div class="form-group summernote">
                        <label for="editorCreate">Tekst</label>
                        <textarea id="summernoteCreate" class="editorCreate" name="editordata"></textarea>
                    </div> 
                    <button type="button" class="btn btn-primary" id="saveCreate">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>