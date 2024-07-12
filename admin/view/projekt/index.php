<?php
session_start();
if (isset($_SESSION["id_korisnik"])) {
    //
} else {
    header("Location: login.php");
}

include("../../../elements/head.php");
include_once("../../class/Database.php");
include_once("../../class/Stranica.php");

$id_korisnik = $_SESSION["id_korisnik"];

$database = new Database();
$con = $database->connect();

$stranica = new Stranica($con); 
$stranica_opcije = array(); 
$results = $stranica->read_options();
while($row = mysqli_fetch_row($results)){
    $stranica_opcije[] = $row;
}

$database->close($con);
?>

<body>
    <?php 
    $active_menu = "projekt";
    include("../../menu.php");
    include("update.php");
    include("create.php");
    ?>
    <div class="cms-container">
        <div class="cms-naslov">
            <h2>Projekti</h2>
        </div>
        <div class="mt-3">
            <button class="btn-create">NOVI UNOS</button>
        </div>
        <table id="dataTable" class="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
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
                    url: '/admin/api/projekt/read.php',
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
                ],
                language: {
                    emptyTable: "Nema podataka",
                    loadingRecords: "Nema pronađenih rezultata",
                    zeroRecords: "Nema pronađenih rezultata",
                    search: "Pretraga",
                    paginate: {
                        first: "Prva",
                        last: "Zadnja",
                        next: "Sljedeća",
                        previous: "Prethodna"
                    }
                }
            });

            $('#dataTable tbody').on('click', '.btn-update', function() {
                const data = datatable.row($(this).parents('tr')).data();
                $.ajax({
                    type: "POST",
                    url: "/admin/api/projekt/read_single.php",
                    data: {id_projekt: data[0]},
                    dataType: "json",
                    success: function(json) {
                        if (json.message) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pogreška',
                                text: json.message
                            });
                        } else {
                            $("#updateModal input[name=id_projekt]").val(json.data.id_projekt)
                            $("#updateModal input[name=naziv]").val(json.data.naziv)
                            $("#updateModal select[name=id_stranica]").val(json.data.id_stranica)
                            $('#summernoteUpdate').summernote('code', json.data.tekst);
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
                    id_projekt: $('#updateID').val(),
                    id_stranica: $('#updateStranica').val(),
                    naziv: $('#updateNaziv').val(),
                    tekst: $('#summernoteUpdate').val()
                };
                $.ajax({
                    url: '/admin/api/projekt/update.php', 
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
                    id_stranica: $('#createStranica').val(),
                    naziv: $('#createNaziv').val(),
                    tekst: $('#summernoteCreate').val()
                };

                $.ajax({
                    url: '/admin/api/projekt/create.php', 
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
                    url: "/admin/api/projekt/delete.php",
                    data: {id_projekt: data[0]},
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