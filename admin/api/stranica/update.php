<?php
require_once('../../class/Database.php'); 
require_once('../../class/Stranica.php'); 

$db = new Database(); 
$con = $db->connect();
$stranica = new Stranica($con); 

$result = $stranica->update($_POST);

if ($result->num_rows > 0) {
    print json_encode(array('message' => 'Izmjena uspješna.'));
} else {
    print json_encode(array('message' => 'Nema pronađenih rezultata.'));
}
$db->close($con);
exit;
?>