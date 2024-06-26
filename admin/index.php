<?php
session_start();
if (isset($_SESSION["id_korisnik"]) && isset($_SESSION['id_korisnik_vrsta']) && $_SESSION['id_korisnik_vrsta']) {
    //
} else {
    header("Location: login.php");
} 

include("/elements/head.php");
include_once("class/Database.php");

$id_korisnik = $_SESSION["id_korisnik"];

$database = new Database();
$con = $database->connect();

// ......... kod

$database->close($con);
?>

<body>


<?php include("footer.php");?>