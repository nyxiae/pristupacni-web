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
                <form id="updateForm" class="modal-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="updateID" name="id_uredaj" readonly>
                    </div>
                    <div class="form-group">
                        <label for="updateNaziv">Naziv</label>
                        <input type="text" class="form-control" id="updateNaziv" name="naziv">
                    </div>
                    <div class="form-group">
                        <label for="updateSlika">Slika</label>
                        <input type="file" class="form-control" id="updateSlika" name="slika" accept="image/*" onchange="previewUpdateImage(event)">
                        <div class="mt-2">
                            <img id="updateImagePreview" data-target="url_slika" src="#" alt="Preview" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                    </div> 
                    <button type="button" class="btn btn-primary" id="saveUpdate">Spremi promjene</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewUpdateImage(event) {
    const image = document.getElementById('updateSlika').files[0];
    const imagePreview = document.getElementById('updateImagePreview');

    if (image) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
        }
        reader.readAsDataURL(image);
    }
}
</script>
