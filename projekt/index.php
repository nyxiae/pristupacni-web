<?php
include ("../admin/class/Database.php"); 
include ("../admin/class/Stranica.php"); 
include ("../admin/class/Projekt.php"); 


if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location: ../index.php');
    exit();
}

$database = new Database();
$con = $database->connect();

$stranica = new Stranica($con); 
$data = array(); 
$result = $stranica->read_single(5); 
while($row = mysqli_fetch_assoc($result)){
    $data = $row;
}

$projekt = new Projekt($con); 
$projekti_data = array(); 
$result = $projekt->read_frontend(); 
while($row = mysqli_fetch_assoc($result)){
    $projekti_data[] = $row;
}

$projekt_pod = array(); 
$result = $projekt->read_single($id); 
while($row = mysqli_fetch_assoc($result)){
    $projekt_pod = $row;
}

?>

<?php include("../elements/head.php"); ?>
<!-- Navigation -->
<?php include("../elements/header.php"); ?>

    <div class="container str-box">
        <div class="row">
            <div class="col-md-12">
            <?php if (!empty($projekt_pod)) {  ?>
                <h2 class="naslov"><?=$projekt_pod["naziv"]?></h2>
                    <div class="box">
                        <?=$projekt_pod["tekst"]?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
<?php include("../elements/footer.php"); ?>