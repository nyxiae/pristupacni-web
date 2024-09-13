<?php
require_once('../../class/Database.php'); 
require_once('../../class/Novost.php'); 

$db = new Database(); 
$con = $db->connect();
$novost = new Novost($con); 

$id_novost = $_POST["id_novost"]; 

$result = $novost->read_single($id_novost);

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