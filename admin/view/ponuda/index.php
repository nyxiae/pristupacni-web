<?php
session_start();
if (isset($_SESSION["id_korisnik"])) {
    //
} else {
    header("Location: login.php");
}

include("../../../elements/head.php");
include_once("../../class/Database.php");
include_once("../../class/Kompanija.php");

$id_korisnik = $_SESSION["id_korisnik"];

$database = new Database();
$con = $database->connect();

$kompanija = new Kompanija($con); 
$kompanija_opcije = array(); 
$results = $kompanija->read_options();
while($row = mysqli_fetch_row($results)){
    $kompanija_opcije[] = $row;
}

$database->close($con);
?>

<body>
    <?php 
    include("../../menu.php");
    $active_menu == "ponuda";?>
    <div class="container">
        <div class="cms-naslov">
            <h2>Kompanija -> Ponuda</h2>
        </div>
        <table id="dataTable" class="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
                    <th>Kompanija</th>
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
                    url: '/admin/api/ponuda/read.php',
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
            $('#summernote').summernote();
            $('#dataTable tbody').on('click', '.btn-update', function() {
                const data = datatable.row($(this).parents('tr')).data();
                $.ajax({
                    type: "POST",
                    url: "/admin/api/kompanija/read_single.php",
                    data: {id_kompanija: data[0]},
                    dataType: "json",
                    success: function(json) {
                        if (json.message != "") {
                            sweetAlert("Neuspješni dohvat podataka. ")
                        } else {
                            $("#updateModal input[name=id_kompanija]").val(json.data.id_kompanija)
                            $("#updateModal input[name=naziv]").val(json.data.naziv)
                            $("#updateModal input[name=email]").val(json.data.mail)
                            $("#updateModal input[name=telefon]").val(json.data.telefon)

                            $('#updateModal').modal('show');
                        }
                    },
                    error: function(response) {
                        sweetAlert("Neuspješni dohvat podataka. ")
                    }
                })
            });
            /*$('#dataTable tbody').on('click', '.btn-delete', function() {
                const data = datatable.row($(this).parents('tr')).data();
                $.ajax({
                    type: "POST",
                    url: "/admin/api/kompanija/read_single.php",
                    data: {id_kompanija: data[0]},
                    dataType: "json",
                    success: function(json) {

                    }*/
        })
    </script>

<?php include("../../footer.php");?>