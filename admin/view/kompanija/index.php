<?php
session_start();
if (isset($_SESSION["id_korisnik"])) {
    //
} else {
    header("Location: login.php");
}

include("../../../elements/head.php");

$id_korisnik = $_SESSION["id_korisnik"];

?>

<body>
    <?php 
    $active_menu = "kompanija";
    include("../../menu.php");
    include("update.php");
    ?>
    <div class="container">
        <div class="cms-naslov">
            <h2>Kompanija</h2>
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
                        if (json.status === "fail") {
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
        })
    </script>

<?php include("../../footer.php");?>