<?php
require_once('../../class/Database.php'); 
require_once('../../class/Korisnik.php'); 

$db = new Database(); 
$con = $db->connect();
$korisnik = new Korisnik($con); 

$data = json_decode(file_get_contents('php://input'), true);

$result = $korisnik->create($data);

if ($result) {
    print json_encode(array('message' => 'Korisnik kreiran.', 'icon'=>'success'));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.', 'icon'=>'error'));
}
$db->close($con);
exit;
?>