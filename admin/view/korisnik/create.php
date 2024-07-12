<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Novi korisnik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createForm" class="modal-form">
                    <div class="d-flex">
                        <div class="form-group w-50 pe-1">
                            <label for="createKorisnickoIme">Korisničko ime</label>
                            <input type="text" class="form-control" id="createKorisnickoIme" name="korisnicko_ime">
                        </div>
                        <div class="form-group w-50">
                            <label for="createLozinka">Lozinka</label>
                            <input type="password" class="form-control" id="createLozinka" name="lozinka">
                        </div>
                    </div>
                    <div class="form-group w-50 pe-1">
                        <label for="createUloga">Uloga</label>
                        <select class="form-control" id="createUloga" name="uloga">
                            <option value="superadmin">Superadmin</option>
                            <option value="admin">Admin</option>
                            <option value="moderator">Moderator</option>
                        </select>
                    </div> 
                    <button type="button" class="btn btn-primary save" id="saveCreate">Spremi unos</button>
                </form>
            </div>
        </div>
    </div>
</div>
