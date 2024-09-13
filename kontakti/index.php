<?php
include ("../admin/class/Database.php"); 
include ("../admin/class/Stranica.php"); 
include ("../admin/class/Projekt.php"); 
include ("../admin/class/Kompanija.php"); 

$database = new Database();
$con = $database->connect();

$stranica = new Stranica($con); 
$data = array(); 
$result = $stranica->read_single(8); 
while($row = mysqli_fetch_assoc($result)){
    $data = $row;
}

$projekt = new Projekt($con); 
$projekti_data = array(); 
$result = $projekt->read_frontend(); 
while($row = mysqli_fetch_assoc($result)){
    $projekti_data[] = $row;
}

$kompanija = new Kompanija($con); 
$kompanija_data = array(); 
$result = $kompanija->read_frontend(); 
while($row = mysqli_fetch_assoc($result)){
    $kompanija_data[] = $row;
}

?>

<?php include("../elements/head.php"); ?>
<!-- Navigation -->
<?php include("../elements/header.php"); ?>


    <div class="container str-box">
        <div class="row">
            <div class="col-md-12">
                <h2 class="naslov">Kontakti</h2>
                <?php if(($data["tekst"] != '') && (strlen($data["tekst"]) > 5)){ ?>
                    <div class="box">
                        <?=$data["tekst"]?>
                    </div>
                <?php } ?>
                <?php if (!empty($kompanija_data)) {
                foreach ($kompanija_data as $komp) { ?>
                    <div class="box mb-5">
                        <h2 class="kompanija"><?=$komp["naziv"]?></h2>
                            <div class="ponuda">
                                <?=$komp["tekst"]?>
                            </div>
                    </div>
                <?php } 
            } ?>
                <div class="box mb-5">
                    <h2 class="kompanija">Pitanja i prijedlozi</h2>
                    <div class="ponuda">
                        <ul>
                            <li><p>E-mail adresa za kontakt je: <a href="mailto:ict-aac@fer.hr">ict-aac@fer.hr</a>.</p></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
<?php include("../elements/footer.php"); ?>