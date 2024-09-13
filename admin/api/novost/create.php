<?php
require_once('../../class/Database.php'); 
require_once('../../class/Novost.php'); 

$db = new Database(); 
$con = $db->connect();
$novost = new Novost($con); 

$data = json_decode(file_get_contents('php://input'), true);

$result = $novost->create($data);

if ($result) {
    print json_encode(array('message' => 'Novost je kreirana.', 'icon'=>'success'));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.', 'icon'=>'error'));
}
$db->close($con);
exit;
?>