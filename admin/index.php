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
    


<?php include("footer.php");?>