<?php
require_once('../../class/Database.php'); 
require_once('../../class/Stranica.php'); 

$db = new Database(); 
$con = $db->connect();
$stranica = new Stranica($con); 

$data = json_decode(file_get_contents('php://input'), true);

$result = $stranica->update($data);

if ($result) {
    print json_encode(array('message' => 'Izmjena uspješna.'));
} else {
    print json_encode(array('message' => 'Nema pronađenih rezultata.'));
}
$db->close($con);
exit;
?>