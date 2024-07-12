<?php
require_once('../../class/Database.php'); 
require_once('../../class/Projekt.php'); 

$db = new Database(); 
$con = $db->connect();
$projekt = new Projekt($con); 

$data = json_decode(file_get_contents('php://input'), true);

$result = $projekt->create($data);

if ($result) {
    print json_encode(array('message' => 'Dodavanje uspješno.', 'icon'=>'success'));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.', 'icon'=>'error'));
}
$db->close($con);
exit;
?>