<?php
require_once('../../class/Database.php'); 
require_once('../../class/Projekt.php'); 

$db = new Database(); 
$con = $db->connect();
$projekt = new Projekt($con); 

$result = $projekt->read();

if ($result->num_rows > 0) {
    $projekti = array();
    while ($row = mysqli_fetch_row($result)) {
        $projekti[] = $row;
    }
    print json_encode(array("data"=>$projekti));
} else {
    print json_encode(array('message' => 'Nema pronađenih rezultata.'));
}
$db->close($con);
exit;
?>