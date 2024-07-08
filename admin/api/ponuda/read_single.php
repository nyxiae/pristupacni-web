<?php
require_once('../../class/Database.php'); 
require_once('../../class/Ponuda.php'); 

$db = new Database(); 
$con = $db->connect();
$ponuda = new Ponuda($con); 

$id_ponuda = $_POST["id_ponuda"]; 

$result = $ponuda->read_single($id_ponuda);

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