<?php
include ("../admin/class/Database.php"); 
include ("../admin/class/Stranica.php"); 
include ("../admin/class/Projekt.php"); 
include ("../admin/class/Novost.php"); 

$database = new Database();
$con = $database->connect();

$stranica = new Stranica($con); 
$data = array(); 
$result = $stranica->read_single(1); 
while($row = mysqli_fetch_assoc($result)){
    $data = $row;
}

$projekt = new Projekt($con); 
$projekti_data = array(); 
$result = $projekt->read_frontend(); 
while($row = mysqli_fetch_assoc($result)){
    $projekti_data[] = $row;
}

$novost = new Novost($con); 
$novosti_data = array(); 
$result = $novost->read_frontend(); 
while($row = mysqli_fetch_assoc($result)){
    $novosti_data[] = $row;
}

$database->close($con);

?>

<?php include("../elements/head.php"); ?>
<!-- Navigation -->
<?php include("../elements/header.php"); ?>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/hr_HR/sdk.js#xfbml=1&version=v20.0&appId=740446049969191" nonce="tiKcGCeE"></script>


    <div class="container str-box">
        <div class="row">
            <div class="col-md-12">
                <h2 class="naslov">Novosti</h2>
                <?php foreach($novosti_data as $nov){ ?>
                <div class="box">
                    <div class="fb"><?=$nov["embed"]?></div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
<?php include("../elements/footer.php"); ?>