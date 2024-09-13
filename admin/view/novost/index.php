<?php
session_start();
if (isset($_SESSION["id_korisnik"])) {
    //
} else {
    header("Location: /admin/login.php");
}

include("../../../elements/head.php");

$id_korisnik = $_SESSION["id_korisnik"];

?>

<body>
    <?php 
    $active_menu = "novost";
    include("../../menu.php");
    include("update.php");
    include("create.php");
    ?>
    <div class="cms-container">
        <div class="cms-naslov">
            <h2>Stranice</h2>
        </div>
        <div class="mt-3">
            <button class="btn-create">NOVI UNOS</button>
        </div>
        <table id="dataTable" class="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naslov</th>
                    <th class="minify">Uredi</th>
                </tr>
            </thead>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            const datatable = $('#dataTable').DataTable({
                pageLength: 100,
                ajax: {
                    url: '/admin/api/novost/read.php',
                    type: 'POST',
                },
                aaSorting: [],
                dom: 'fpt',
                columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    defaultContent: "<button class='btn-update'><i class='fa fa-pencil' aria-hidden='true'></i></button><button class='btn-delete'><i class='fa fa-trash' aria-hidden='true'></i></button>"
                }
                ]
            });

            $('#dataTable tbody').on('click', '.btn-update', function() {
                const data = datatable.row($(this).parents('tr')).data();
                $.ajax({
                    type: "POST",
                    url: "/admin/api/novost/read_single.php",
                    data: {id_novost: data[0]},
                    dataType: "json",
                    success: function(json) {
                        if (json.message) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pogreška',
                                text: json.message
                            });
                        } else {
                            $("#updateModal input[name=id_novost]").val(json.data.id_novost)
                            $("#updateModal input[name=naslov]").val(json.data.naslov)
                            $('#summernoteUpdate').summernote('code', json.data.embed);
                            $('#updateModal').modal('show');
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                                icon: 'error',
                                title: 'Pogreška',
                                text: "Došlo je do pogreške."
                        });
                    }
                })
            });
            $('#saveUpdate').on('click', function() {
                const updatedData = {
                    id_novost: $('#updateID').val(),
                    naslov: $('#updateNaslov').val(),
                    embed: $('#summernoteUpdate').val()
                };
                $.ajax({
                    url: '/admin/api/novost/update.php', 
                    type: 'POST',
                    data: JSON.stringify(updatedData),
                    contentType: 'application/json; charset=utf-8',
                    dataType: "json",
                    success: function(response) {
                        $('#updateModal').modal('hide');
                        datatable.ajax.reload(); 
                        Swal.fire({
                                icon: response.icon,
                                text: response.message
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                                icon: 'error',
                                title: 'Pogreška',
                                text: "Došlo je do pogreške."
                        });
                    }
                });
            });
            $('#saveCreate').on('click', function() {
                const createdData = {
                    naslov: $('#createNaslov').val(),
                    embed: $('#summernoteCreate').val()
                };

                $.ajax({
                    url: '/admin/api/novost/create.php', 
                    type: 'POST',
                    data: JSON.stringify(createdData),
                    dataType: 'json',
                    success: function(response) {
                        $('#createModal').modal('hide');
                        datatable.ajax.reload(); 
                        Swal.fire({
                                icon: response.icon,
                                text: response.message
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                                icon: 'error',
                                title: 'Pogreška',
                                text: "Došlo je do pogreške."
                        });
                    }
                });
            });
            $('#dataTable tbody').on('click', '.btn-delete', function() {
                const data = datatable.row($(this).parents('tr')).data();
                $.ajax({
                    type: "POST",
                    url: "/admin/api/novost/delete.php",
                    data: {id_novost: data[0]},
                    dataType: "json",
                    success: function(response) {
                        datatable.ajax.reload(); 
                        Swal.fire({
                            icon: response.icon,
                            text: response.message
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                                icon: 'error',
                                title: 'Pogreška',
                                text: "Došlo je do pogreške."
                        });
                    }
                });
            });
        })
    </script>

<?php include("../../footer.php");?>