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
    $active_menu = "kompanija";
    include("../../menu.php");
    include("create.php");
    include("update.php");
    
    ?>
    <div class="cms-container">
        <div class="cms-naslov">
            <h2>Kompanija</h2>
        </div>
        <div class="mt-3">
            <button class="btn-create">NOVI UNOS</button>
        </div>
        <table id="dataTable" class="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
                    <th>E-mail</th>
                    <th>Telefon</th>
                    <th>Uredi</th>
                </tr>
            </thead>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            const datatable = $('#dataTable').DataTable({
                pageLength: 100,
                ajax: {
                    url: '/admin/api/kompanija/read.php',
                    type: 'POST',
                },
                aaSorting: [],
                dom: 'fpt',
                columnDefs: [
                    {
                        targets: -1,
                        orderable: false,
                        defaultContent: "<button class='btn-update'><i class='fa fa-pencil' aria-hidden='true'></i></button>"
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
                    url: "/admin/api/kompanija/read_single.php",
                    data: {id_kompanija: data[0]},
                    dataType: "json",
                    success: function(json) {
                        if (json.message) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pogreška',
                                text: json.message
                            });
                        } else {
                            $("#updateModal input[name=id_kompanija]").val(json.data.id_kompanija)
                            $("#updateModal input[name=naziv]").val(json.data.naziv)
                            $("#updateModal input[name=email]").val(json.data.mail)
                            $("#updateModal input[name=telefon]").val(json.data.telefon)
                            $('#summernoteUpdate').summernote('code', json.data.tekst);
                            $('#updateModal').modal('show');
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                                icon: 'error',
                                title: 'Pogreška',
                                text: response.message
                        });
                    }
                })
            });
            $('#saveUpdate').on('click', function() {
                const updatedData = {
                    id_kompanija: $('#updateID').val(),
                    naziv: $('#updateNaziv').val(),
                    mail: $('#updateEmail').val(),
                    telefon: $('#updateTelefon').val(),
                    tekst: $('#summernoteUpdate').val()
                };

                $.ajax({
                    url: '/admin/api/kompanija/update.php', 
                    type: 'POST',
                    data: JSON.stringify(updatedData),
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
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
                                icon: 'success',
                                title: 'Uspjeh',
                                text: "Došlo je do pogreške."
                        });
                    }
                });
            });
            $('#saveCreate').on('click', function() {
                const createdData = {
                    naziv: $('#createNaziv').val(),
                    mail: $('#createEmail').val(),
                    telefon: $('#createTelefon').val(),
                    tekst: $('#summernoteCreate').val()
                };

                $.ajax({
                    url: '/admin/api/kompanija/create.php', 
                    type: 'POST',
                    data: JSON.stringify(createdData),
                    contentType: 'application/json; charset=utf-8',
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
                                icon: 'success',
                                title: 'Uspjeh',
                                text: "Došlo je do pogreške."
                        });
                    }
                });
            });
        })
           
    </script>

<?php include("../../footer.php");?>