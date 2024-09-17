$(function() {

    // SUMMERNOTE 
    $('#summernoteUpdate').summernote({
        height: 300, 
        toolbar: [
            // Specify the toolbar options you want to include
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['picture', 'link', 'video', 'table', 'hr']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        fontNames: ['Roboto Slab', 'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
        fontNamesIgnoreCheck: ['Roboto Slab'],  // Add to ignore check to always show in font dropdown
        callbacks: {
            onInit: function() {
                // Set the default font family and size after initialization
                $('.note-editable').css('font-family', 'Roboto Slab');
                $('.note-editable').css('font-size', '16px');
            },
            onPaste: function(e) {
                e.preventDefault();
                        
                // Get the pasted content
                var clipboardData = (e.originalEvent || e).clipboardData;
                var html = clipboardData.getData('text/html');
                var text = clipboardData.getData('text/plain');

                // Insert HTML if available, otherwise insert plain text
                var content = html || text;

                // Insert the content into Summernote
                document.execCommand('insertHTML', false, content);

                // Apply the desired font and size to the inserted content
                setTimeout(function() {
                    $('.note-editable').find('*').each(function() {
                        $(this).css({
                            'font-family': 'Roboto Slab',
                            'font-size': '16px'
                        });
                    });
                }, 0);
            }
        }
    });
    
    $('#summernoteCreate').summernote({
        height: 300, 
        toolbar: [
            // Specify the toolbar options you want to include
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['insert', ['picture', 'link', 'video', 'table', 'hr']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        fontNames: ['Roboto Slab', 'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
        fontNamesIgnoreCheck: ['Roboto Slab'],  // Add to ignore check to always show in font dropdown
        callbacks: {
            onInit: function() {
                // Set the default font family and size after initialization
                $('.note-editable').css('font-family', 'Roboto Slab');
                $('.note-editable').css('font-size', '16px');
            },
            onPaste: function(e) {
                e.preventDefault();
                        
                // Get the pasted content
                var clipboardData = (e.originalEvent || e).clipboardData;
                var html = clipboardData.getData('text/html');
                var text = clipboardData.getData('text/plain');

                // Insert HTML if available, otherwise insert plain text
                var content = html || text;

                // Insert the content into Summernote
                document.execCommand('insertHTML', false, content);

                // Apply the desired font and size to the inserted content
                setTimeout(function() {
                    $('.note-editable').find('*').each(function() {
                        $(this).css({
                            'font-family': 'Roboto Slab',
                            'font-size': '16px'
                        });
                    });
                }, 0);
            }
        }
    });

    // Ensure dropdowns are working
    function reinitializeDropdowns() {
        $('.dropdown-toggle').dropdown();
    }

    // Reinitialize dropdowns after Summernote initialization
    $('#summernoteUpdate, #summernoteCreate').on('summernote.init', function() {
        reinitializeDropdowns();
    });

    // Optionally reinitialize dropdowns on document click
    $(document).on('click', function() {
        reinitializeDropdowns();
    });

    // Modal zatvori otovri
    $(".btn-create").on('click', function() {
        $("#createModal").modal('show');
    });
    $('#createModal .close-modal').on('click', function() {
        $('#createModal').modal('hide');
    });
    $('#updateModal .close-modal').on('click', function() {
        $('#updateModal').modal('hide');
    });

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

})