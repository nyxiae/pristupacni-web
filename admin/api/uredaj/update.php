<?php
require_once('../../class/Database.php'); 
require_once('../../class/Uredaj.php'); 

$db = new Database(); 
$con = $db->connect();
$uredaj = new Uredaj($con); 

$data = $_POST;

if (isset($_FILES['slika']) && $_FILES['slika']['error'] == 0) {
    $data['slika'] = $_FILES['slika'];
}

$result = $uredaj->update($data);

if ($result) {
    print json_encode(array('message' => 'Izmjena uspješna.', 'icon'=>'success'));
}else {
    print json_encode(array('message' => 'Nema pronađenih rezultata.', 'icon'=>'error'));
}
$db->close($con);
exit;
?>