<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Uređivanje</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateForm" class="modal-form">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="updateID" name="id_projekt" readonly>
                    </div>
                    <div class="d-flex">
                        <div class="form-group w-50 pe-1">
                            <label for="updateNaziv">Naziv</label>
                            <input type="text" class="form-control" id="updateNaziv" name="naziv">
                        </div>
                        <div class="form-group w-50">
                            <label for="updateStranica">Stranica</label>
                            <select class="form-control" id="updateStranica" name="id_stranica">
                                <?php foreach($stranica_opcije as $option): ?>
                                    <option value="<?= $option[0] ?>"><?= $option[1] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div> 
                    <div class="form-group summernote">
                        <label for="editorUpdate">Tekst</label>
                        <textarea id="summernoteUpdate" class="editorUpdate" name="editordata"></textarea>
                    </div> 
                    <button type="button" class="btn btn-primary" id="saveUpdate">Spremi promjene</button>
                </form>
            </div>
        </div>
    </div>
</div>
