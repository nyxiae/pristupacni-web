<?php
require_once('../../class/Database.php'); 
require_once('../../class/Kompanija.php'); 

$db = new Database(); 
$con = $db->connect();
$kompanija = new Kompanija($con); 

$data = json_decode(file_get_contents('php://input'), true);

$result = $kompanija->update($data);

if ($result) {
    print json_encode(array('message' => 'Ažuriranje uspješno.', 'icon'=>'success'));
} else {
    print json_encode(array('message' => 'Ažuriranje nije uspjelo.', 'icon'=>'error'));
}
$db->close($con);
exit;
?>