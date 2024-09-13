<?php
require_once('../../class/Database.php'); 
require_once('../../class/Novost.php'); 

$db = new Database(); 
$con = $db->connect();
$novost = new Novost($con); 

$result = $novost->read();

if ($result->num_rows > 0) {
    $stranice = array();
    while ($row = mysqli_fetch_row($result)) {
        $stranice[] = $row;
    }
    print json_encode(array("data"=>$stranice));
} else {
    print json_encode(array('message' => 'Nema pronađenih rezultata.'));
}
$db->close($con);
exit;
?>