<?php
require_once('../../class/Database.php'); 
require_once('../../class/Stranica.php'); 

$db = new Database(); 
$con = $db->connect();
$stranica = new Stranica($con); 

$id = $_POST["id_stranica"];

$result = $stranica->delete($id);

if ($result) {
    print json_encode(array("message"=>"Brisanje je uspješno.", 'icon'=>'success'));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.', 'icon'=>'error'));
}
$db->close($con);
exit;
?>