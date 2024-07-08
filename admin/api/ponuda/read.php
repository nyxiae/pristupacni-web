<?php
require_once('../../class/Database.php'); 
require_once('../../class/Ponuda.php'); 

$db = new Database(); 
$con = $db->connect();
$ponuda = new Ponuda($con); 

$result = $ponuda->read();

if ($result->num_rows > 0) {
    $ponude = array();
    while ($row = mysqli_fetch_row($result)) {
        $ponude[] = $row;
    }
    print json_encode(array("data"=>$ponude));
} else {
    print json_encode(array('message' => 'Nema pronađenih rezultata.'));
}
$db->close($con);
exit;
?>