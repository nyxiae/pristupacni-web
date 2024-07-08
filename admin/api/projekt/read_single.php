<?php
require_once('../../class/Database.php'); 
require_once('../../class/Projekt.php'); 

$db = new Database(); 
$con = $db->connect();
$projekt = new Projekt($con); 

$id_projekt = $_POST["id_projekt"]; 

$result = $projekt->read_single($id_projekt);

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