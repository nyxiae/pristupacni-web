<?php
require_once('../../class/Database.php'); 
require_once('../../class/Kompanija.php'); 

$db = new Database(); 
$con = $db->connect();
$kompanija = new Kompanija($con); 

$id = mysqli_real_escape_string($_POST["id_kompanija"]);

$result = $kompanija->delete($id);

if ($result) {
    print json_encode(array("message"=>"Brisanje je uspješno.", 'icon'=>'success'));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.', 'icon'=>'error'));
}
$db->close($con);
exit;
?>