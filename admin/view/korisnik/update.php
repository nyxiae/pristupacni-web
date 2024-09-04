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
                        <input type="hidden" class="form-control" id="updateID" name="id_korisnik" readonly>
                    </div>
                    <div class="d-flex">
                        <div class="form-group w-50 pe-1">
                            <label for="updateKorisnickoIme">Korisničko ime</label>
                            <input type="text" class="form-control" id="updateKorisnickoIme" name="korisnicko_ime">
                        </div>
                        <div class="form-group w-50">
                            <label for="updateLozinka">Lozinka</label>
                            <input type="password" class="form-control" id="updateLozinka" name="lozinka">
                        </div>
                    </div>
                    <div class="form-group w-50 pe-1">
                        <label for="updateUloga">Uloga</label>
                        <select class="form-control" id="updateUloga" name="uloga">
                            <option value="superadmin">Superadmin</option>
                            <option value="admin">Admin</option>
                            <option value="moderator">Moderator</option>
                        </select>
                    </div> 
                    <button type="button" class="btn btn-primary save" id="saveUpdate">Spremi promjene</button>
                </form>
            </div>
        </div>
    </div>
</div>