<?php
require_once('../../class/Database.php'); 
require_once('../../class/Novost.php'); 

$db = new Database(); 
$con = $db->connect();
$novost = new Novost($con); 

$id = $_POST["id_novost"];

$result = $novost->delete($id);

if ($result) {
    print json_encode(array("message"=>"Brisanje je uspješno.", 'icon'=>'success'));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.', 'icon'=>'error'));
}
$db->close($con);
exit;
?>