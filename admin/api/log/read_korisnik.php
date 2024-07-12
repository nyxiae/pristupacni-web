<?php
require_once('../../class/Database.php'); 
require_once('../../class/Log.php'); 

$db = new Database(); 
$con = $db->connect();
$log = new Log($con); 

$id = $_POST["id_korisnik"];


$data = $log->read_korisnik($id);

if (isset($data)) {
    print json_encode(array("data"=>$data));
} else {
    print json_encode(array('message' => 'Nema pronađenih rezultata.'));
}
$db->close($con);
exit;
?>