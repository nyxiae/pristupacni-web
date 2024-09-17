<?php
session_start();
if (isset($_SESSION["id_korisnik"])) {
    //
} else {
    header("Location: /admin/login.php");
}

$id_ponuda = !empty($_GET["id_ponuda"]) ? $_GET["id_ponuda"] : 0;
if($id_ponuda==0){
    header("Location: ../../");
}
include("../../../elements/head.php");
include_once("../../class/Database.php");
include_once("../../class/Ponuda.php");

$id_korisnik = $_SESSION["id_korisnik"];

$database = new Database();
$con = $database->connect();

$ponuda = new Ponuda($con);
$ponuda_info = array(); 
$result = $ponuda->read_single_frontend($id_ponuda); 
while($row = mysqli_fetch_assoc($result)){
    $ponuda_info = $row;
}

$database->close($con);

$header_title = "Uređaji uključeni u ponudu <b>'" . $ponuda_info["naslov"] . "'</b> operatera <b>" . $ponuda_info["kompanija"] . "</b>";


?>

<body>
    <?php 
    $active_menu = "uredaj";
    include("../../menu.php");
    include("create.php");
    include("update.php");
    
    ?>
    <div class="cms-container">
        <div class="cms-naslov">
            <h2><?=$header_title?></h2>
        </div>
        <div class="mt-3">
            <button class="btn-create">NOVI UNOS</button>
        </div>
        <table id="dataTable" class="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
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
                    url: '/admin/api/uredaj/read.php',
                    type: 'POST',
                    data: {id_ponuda:<?=$id_ponuda?>}
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
                    url: "/admin/api/uredaj/read_single.php",
                    data: {id_uredaj: data[0]},
                    dataType: "json",
                    success: function(json) {
                        if (json.message) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pogreška',
                                text: json.message
                            });
                        } else {
                            $("#updateModal input[name=id_uredaj]").val(json.data.id_uredaj)
                            $("#updateModal input[name=naziv]").val(json.data.naziv)
                            $("#updateModal img[data-target=url_slika]").attr("src", json.data.url_slika)
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
                const formData = new FormData($('#updateForm')[0]); // Create FormData object from the form

                $.ajax({
                    url: '/admin/api/uredaj/update.php',
                    type: 'POST',
                    data: formData,
                    processData: false, // Don't process the data
                    contentType: false, // Set content type to false
                    success: function(json) {
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
                            title: 'Uspjeh',
                            text: "Došlo je do pogreške."
                        });
                    }
                });
            });
            $('#saveCreate').on('click', function() {
                const formData = new FormData($('#createForm')[0]); // Create FormData object from the form

                $.ajax({
                    url: '/admin/api/uredaj/create.php',
                    type: 'POST',
                    data: formData,
                    processData: false, // Don't process the data
                    contentType: false, // Set content type to false
                    success: function(json) {
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
                            title: 'Uspjeh',
                            text: "Došlo je do pogreške."
                        });
                    }
                });
            });
            $('#dataTable tbody').on('click', '.btn-delete', function() {
                const data = datatable.row($(this).parents('tr')).data();
                $.ajax({
                    type: "POST",
                    url: "/admin/api/uredaj/delete.php",
                    data: {id_uredaj: data[0]},
                    dataType: "json",
                    success: function(json) {
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