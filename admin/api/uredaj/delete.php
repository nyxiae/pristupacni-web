<?php
require_once('../../class/Database.php'); 
require_once('../../class/Uredaj.php'); 

$db = new Database(); 
$con = $db->connect();
$uredaj = new Uredaj($con); 

$id = $_POST["id_uredaj"];

$result = $uredaj->delete($id);

if ($result) {
    print json_encode(array("message"=>"Brisanje je uspješno.", 'icon'=>'success'));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.', 'icon'=>'error'));
}
$db->close($con);
exit;
?>