<?php
require_once('../../class/Database.php'); 
require_once('../../class/Stranica.php'); 

$db = new Database(); 
$con = $db->connect();
$stranica = new Stranica($con); 

$id_stranica = $_POST["id_stranica"]; 

$result = $stranica->read_single($id_stranica);

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