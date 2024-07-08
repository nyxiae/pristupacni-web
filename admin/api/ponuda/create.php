<?php
require_once('../../class/Database.php'); 
require_once('../../class/Ponuda.php'); 

$db = new Database(); 
$con = $db->connect();
$ponuda = new Ponuda($con); 

$result = $ponuda->create($_POST);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_row($result)
    print json_encode(array('message' => 'Ponuda je kreirana.'));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.'));
}
$db->close($con);
exit;
?>