<?php
require_once('../../class/Database.php'); 
require_once('../../class/Stranica.php'); 

$db = new Database(); 
$con = $db->connect();
$stranica = new Stranica($con); 

$data = json_decode(file_get_contents('php://input'), true);

$result = $stranica->create($data);

if ($result) {
    print json_encode(array('message' => 'Stranica je kreirana.'));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.'));
}
$db->close($con);
exit;
?>