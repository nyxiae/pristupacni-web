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
    $active_menu = "korisnik";
    include("../../menu.php");
    include("update.php");
    include("create.php");
    ?>
    <div class="cms-container">
        <div class="cms-naslov">
            <h2>Korisnik</h2>
        </div>
        <div class="mt-3">
            <button class="btn-create <?=($_SESSION["uloga"] != "superadmin") ? "d-none" : ""?>">NOVI UNOS</button>
        </div>
        <table id="dataTable" class="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Korisničko ime</th>
                    <th>Uloga</th>
                    <th>Zadnja prijava</th>
                    <th <?=($_SESSION["uloga"] != "superadmin") ? "class='d-none'" : ""?>>Uredi</th>
                </tr>
            </thead>
        </table>
    </div>
    <script>
        $(function() {
            const isAdmin = <?= json_encode($_SESSION["uloga"] == "superadmin") ?>;

            const datatable = $('#dataTable').DataTable({
                pageLength: 100,
                ajax: {
                    url: '/admin/api/korisnik/read.php',
                    type: 'POST',
                },
                aaSorting: [],
                dom: 'fpt',
                columnDefs: [
                    {
                        targets: -1,
                        orderable: false,
                        defaultContent: "<button class='btn-update'><i class='fa fa-pencil' aria-hidden='true'></i></button>",
                        visible: isAdmin
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
                    url: "/admin/api/korisnik/read_single.php",
                    data: {id_korisnik: data[0]},
                    dataType: "json",
                    success: function(json) {
                        $("#updateModal input[name=id_korisnik]").val(json.data.id_korisnik)
                        $("#updateModal input[name=korisnicko_ime]").val(json.data.korisnicko_ime)
                        $("#updateModal input[name=lozinka]").val(json.data.lozinka)
                        $("#updateModal select[name=uloga]").val(json.data.uloga)
                        $('#updateModal').modal('show');
                    },
                    error: function(response) {
                        Swal.fire({
                                icon: 'error',
                                title: 'Pogreška',
                                text: 'Pogreška u čitanju podataka.'
                        });
                    }
                })
            });
            $('#saveUpdate').on('click', function() {
                const updatedData = {
                    id_korisnik: $('#updateID').val(),
                    korisnicko_ime: $('#updateKorisnickoIme').val(),
                    lozinka: $('#updateLozinka').val(),
                    uloga: $('#updateUloga').val(),
                };

                $.ajax({
                    url: '/admin/api/korisnik/update.php', 
                    type: 'POST',
                    data: JSON.stringify(updatedData),
                    dataType: "json",
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
                        console.error('Update failed:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Greška',
                            text: 'Izmjene nisu spremljene.'
                        });
                    }
                });
            });
            $('#saveCreate').on('click', function() {
                const createdData = {
                    korisnicko_ime: $('#createKorisnickoIme').val(),
                    lozinka: $('#createLozinka').val(),
                    uloga: $('#createUloga').val()
                };
                console.log(createdData);
                $.ajax({
                    url: '/admin/api/korisnik/create.php', 
                    type: 'POST',
                    data: JSON.stringify(createdData),
                    dataType: "json",
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
                        console.error('Update failed:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Greška',
                            text: 'Korisnik nije dodan.'
                        });
                    }
                });
            });
        })
    </script>

<?php include("../../footer.php");?>