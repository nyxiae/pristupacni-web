<?php
require_once('../../class/Database.php'); 
require_once('../../class/Kompanija.php'); 

$db = new Database(); 
$con = $db->connect();
$kompanija = new Kompanija($con); 

$result = $kompanija->read();

if ($result->num_rows > 0) {
    $kompanije = array();
    while ($row = mysqli_fetch_row($result)) {
        $kompanije[] = $row;
    }
    print json_encode(array("data"=>$kompanije));
} else {
    print json_encode(array('message' => 'Nema pronađenih rezultata.'));
}
$db->close($con);
exit;
?>