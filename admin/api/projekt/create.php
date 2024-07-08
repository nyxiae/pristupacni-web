<?php
require_once('../../class/Database.php'); 
require_once('../../class/Projekt.php'); 

$db = new Database(); 
$con = $db->connect();
$projekt = new Projekt($con); 

$result = $projekt->create($_POST);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_row($result)
    print json_encode(array('message' => 'Projekt je kreiran.'));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.'));
}
$db->close($con);
exit;
?>