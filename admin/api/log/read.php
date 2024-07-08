<?php
require_once('../../class/Database.php'); 
require_once('../../class/Log.php'); 

$db = new Database(); 
$con = $db->connect();
$log = new Log($con); 

$result = $log->read();

if ($result->num_rows > 0) {
    $logs = array();
    while ($row = mysqli_fetch_row($result)) {
        $logs[] = $row;
    }
    print json_encode(array("data"=>$logs));
} else {
    print json_encode(array('message' => 'Nema pronađenih rezultata.'));
}
$db->close($con);
exit;
?>