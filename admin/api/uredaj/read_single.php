<?php
require_once('../../class/Database.php'); 
require_once('../../class/Uredaj.php'); 

$db = new Database(); 
$con = $db->connect();
$uredaj = new Uredaj($con); 

$id_uredaj = $_POST["id_uredaj"]; 

$result = $uredaj->read_single($id_uredaj);

if ($result->num_rows > 0) {
    $data = array();
    while($row = mysqli_fetch_assoc($result)){
        $data = $row;
    }

    print json_encode(array("data"=>$data));
} else {
    print json_encode(array('message' => 'Nema pronađenih rezultata.'));
}
$db->close($con);
exit;
?>