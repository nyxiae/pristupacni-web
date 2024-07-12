<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Novi unos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm" class="modal-form">
                    <div class="d-flex">
                        <div class="form-group w-50 pe-2">
                            <label for="createNaziv">Naziv</label>
                            <input type="text" class="form-control" id="createNaziv" name="naziv">
                        </div>
                        <div class="form-group w-50">
                            <label for="createStranica">Stranica</label>
                            <select class="form-control" id="createStranica" name="id_stranica">
                                <?php foreach($stranica_opcije as $option): ?>
                                    <option value="<?= $option[0] ?>"><?= $option[1] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div> 
                    <div class="form-group summernote">
                        <label for="editorCreate">Tekst</label>
                        <textarea id="summernoteCreate" class="editorCreate" name="editordata"></textarea>
                    </div> 
                    <button type="button" class="btn btn-primary" id="saveCreate">Spremi unos</button>
                </form>
            </div>
        </div>
    </div>
</div>