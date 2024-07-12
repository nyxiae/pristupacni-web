<?php
require_once('../../class/Database.php'); 
require_once('../../class/Projekt.php'); 

$db = new Database(); 
$con = $db->connect();
$projekt = new Projekt($con); 

$id = $_POST["id_projekt"];

$result = $projekt->delete($id);

if ($result) {
    print json_encode(array("message"=>"Brisanje je uspješno.", 'icon'=>'success'));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.', 'icon'=>'error'));
}
$db->close($con);
exit;
?>