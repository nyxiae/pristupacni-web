<?php
session_start();
if (isset($_SESSION["id_korisnik"])) {
    //
} else {
    header("Location: login.php");
}

include("../elements/head.php");
include_once("class/Database.php");

$id_korisnik = $_SESSION["id_korisnik"];

$database = new Database();
$con = $database->connect();


$database->close($con);
?>

<body>
    <?php $active_menu = "pocetna";
    include("menu.php");?>
    <div class="cms-container">
        <div class="cms-naslov">
            <h2>Vaše zadnje aktivnosti:</h2>
        </div>
        <table id="dataTable" class="datatable">
            <thead>
                <tr>
                    <th>Tablica</th>
                    <th>Vrijeme</th>                
                </tr>
            </thead>
        </table>
    <script>
        $(document).ready(function() {
            var id = <?=$_SESSION["id_korisnik"]?>;
            $('#dataTable').DataTable({
                pageLength: 10,
                ajax: {
                    url: '/admin/api/log/read_korisnik.php',
                    data: { id_korisnik: id },
                    type: 'POST',
                    dataType: "json",
                    dataSrc: 'data' 
                },
                columns: [
                    { data: 'table_name', title: 'Tablica' },
                    { data: 'vrijeme', title: 'Vrijeme' }
                ],
                aaSorting: [],
                dom: 'ft'
            });
        });
    </script>

<?php include("footer.php");?>