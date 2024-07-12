<?php
session_start();
if (isset($_SESSION["id_korisnik"])) {
    //
} else {
    header("Location: /admin/login.php");
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
    $active_menu == "log";?>
    <div class="cms-container">
        <div class="cms-naslov">
            <h2>Zapisi</h2>
        </div>
        <table id="dataTable" class="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Korisnik</th>
                    <th>Upit</th>
                    <th>Vrijeme</th>                
                </tr>
            </thead>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            const datatable = $('#dataTable').DataTable({
                pageLength: 100,
                ajax: {
                    url: '/admin/api/log/read.php',
                    type: 'POST',
                },
                aaSorting: [],
                dom: 'fpt'
            });
        })
    </script>

<?php include("../../footer.php");?>