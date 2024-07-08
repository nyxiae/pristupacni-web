<?php
require_once('../../class/Database.php'); 
require_once('../../class/Stranica.php'); 

$db = new Database(); 
$con = $db->connect();
$stranica = new Stranica($con); 

$result = $stranica->create($_POST);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_row($result)
    print json_encode(array('message' => 'Stranica je kreirana.'));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.'));
}
$db->close($con);
exit;
?>