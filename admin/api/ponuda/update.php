<?php
require_once('../../class/Database.php'); 
require_once('../../class/Ponuda.php'); 

$db = new Database(); 
$con = $db->connect();
$ponuda = new Ponuda($con); 

$data = json_decode(file_get_contents('php://input'), true);

$result = $ponuda->update($data);

if ($result) {
    print json_encode(array('message' => 'Ažuriranje uspješno.', 'icon'=>'success'));
} else {
    print json_encode(array('message' => 'Ažuriranje nije uspjelo.', 'icon'=>'error'));
}
$db->close($con);
exit;
?>