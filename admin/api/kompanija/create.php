<?php
require_once('../../class/Database.php'); 
require_once('../../class/Kompanija.php'); 

$db = new Database(); 
$con = $db->connect();
$kompanija = new Kompanija($con); 

$result = $kompanija->create($_POST);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_row($result)
    $kompanije[] = $row;
    print json_encode(array("data"=>$kompanije));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.'));
}
$db->close($con);
exit;
?>