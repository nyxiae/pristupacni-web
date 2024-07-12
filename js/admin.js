$(function() {
    // SUMMERNOTE 
    $('#summernoteUpdate').summernote({
        height: 300 
    });
    
    $('#summernoteCreate').summernote({
        height: 300 
    });

    // Modal zatvori otovri
    $(".btn-create").on('click', function() {
        $("#createModal").modal('show');
    });
    $('#createModal .close').on('click', function() {
        $('#createModal').modal('hide');
    });
    $('#updateModal .close').on('click', function() {
        $('#updateModal').modal('hide');
    });

})