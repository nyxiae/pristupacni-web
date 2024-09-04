<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Uređivanje</h5>
                <button type="button" class="close-modal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateForm" class="modal-form">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="updateID" name="id_ponuda" readonly>
                    </div>
                    <div class="form-group">
                        <label for="updateNaziv">Naslov</label>
                        <input type="text" class="form-control" id="updateNaziv" name="naslov">
                    </div>
                    <div class="d-flex">
                        <div class="form-group w-50 pe-1">
                            <label for="updateKompanija">Kompanija</label>
                            <select class="form-control" id="updateKompanija" name="id_kompanija">
                                <?php foreach($kompanija_opcije as $option): ?>
                                    <option value="<?= $option[0] ?>"><?= $option[1] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                        <div class="form-group w-50 pe-1">
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
