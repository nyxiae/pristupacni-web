<?php
require_once('../../class/Database.php'); 
require_once('../../class/Ponuda.php'); 

$db = new Database(); 
$con = $db->connect();
$ponuda = new Ponuda($con); 

$id = mysqli_real_escape_string($_POST["id_ponuda"]);

$result = $ponuda->delete($id);

if ($result->num_rows > 0) {
    print json_encode(array("message"=>"Brisanje je uspješno."));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.'));
}
$db->close($con);
exit;
?>