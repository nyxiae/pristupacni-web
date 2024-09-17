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
                <form id="createForm" class="modal-form" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="createPonuda" name="id_ponuda" value="<?=$id_ponuda?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="createNaziv">Naziv</label>
                        <input type="text" class="form-control" id="createNaziv" name="naziv">
                    </div>
                    <div class="form-group">
                        <label for="createSlika">Slika</label>
                        <input type="file" class="form-control" id="createSlika" name="slika" accept="image/*" onchange="previewImage(event)">
                        <div class="mt-2">
                            <img id="imagePreview" src="#" alt="Preview" style="display:none; width: 100px; height: 100px; object-fit: cover;">
                        </div>
                    </div> 
                    <button type="button" class="btn btn-primary" id="saveCreate">Spremi unos</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const image = document.getElementById('createSlika').files[0];
    const imagePreview = document.getElementById('imagePreview');

    if (image) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = "block";
        }
        reader.readAsDataURL(image);
    } else {
        imagePreview.style.display = "none";
        imagePreview.src = "#";
    }
}
</script>