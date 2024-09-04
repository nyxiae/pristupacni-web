<?php
include ("../admin/class/Database.php"); 
include ("../admin/class/Stranica.php"); 
include ("../admin/class/Ponuda.php"); 

$database = new Database();
$con = $database->connect();

$stranica = new Stranica($con); 
$data = array(); 
$result = $stranica->read_single(5); 
while($row = mysqli_fetch_assoc($result)){
    $data = $row;
}

$ponuda = new Ponuda($con); 
$data_ponude = array(); 
$result = $ponuda->read_frontend(5); 
while($row = mysqli_fetch_assoc($result)){
    $data_ponude[] = $row;
}

?>

<?php include("../elements/head.php"); ?>
<!-- Navigation -->
<?php include("../elements/header.php"); ?>


    <div class="container str-box">
        <div class="row">
            <div class="col-md-12">
                <h2 class="naslov">Seniori</h2>
                <?php if($data["tekst"] != ''){ ?>
                    <div class="box">
                        <?=$data["tekst"]?>
                    </div>
                <?php } ?>
                <?php if (!empty($data_ponude )) { 
                    foreach($data_ponude as $pon){ ?>
                    <div class="box mb-5">
                        <h2 class="kompanija"><?=$pon["naziv"]?></h2>
                        <h3 class="naziv-ponude"><?=$pon["naslov"]?></h3>
                        <?=$pon["tekst"]?>
                    </div>
                <?php } } ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
<?php include("../elements/footer.php"); ?>