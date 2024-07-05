<?php
session_start();
if (isset($_SESSION["id_korisnik"])) {
    //
} else {
    header("Location: login.php");
}

include("../../../elements/head.php");
include_once("../../class/Database.php");

$id_korisnik = $_SESSION["id_korisnik"];

$database = new Database();
$con = $database->connect();

$database->close($con);
?>

<body>
    <?php 
    include("../../menu.php");
    $active_menu == "kompanija";?>
    <div class="container">
        <h2>Employee Data</h2>
        <table id="dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
                    <th>E-mail</th>
                    <th>Telefon</th>
                </tr>
            </thead>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            const datatable = $('#datatable').DataTable({
                pageLength: 100,
                ajax: {
                    url: '/api/kompanija/read.php',
                    type: 'POST',
                },
                aaSorting: [],
                dom: 'fptB',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Croatian.json' // Update to the latest DataTables version (if needed)
                },
                columnDefs: [
                {
                    targets: -1,
                    orderable: false,
                    defaultContent: "<button class='btn-update'><i class='fa fa-pencil' aria-hidden='true'></i></button>"
                }
                ]
            });
        })
    </script>

<?php include("../../footer.php");?>