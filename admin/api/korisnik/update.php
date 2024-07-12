<?php
require_once('../../class/Database.php'); 
require_once('../../class/Korisnik.php'); 

$db = new Database(); 
$con = $db->connect();
$korisnik = new Korisnik($con); 

$data = json_decode(file_get_contents('php://input'), true);

$result = $korisnik->update($data);

if ($result) {
    print json_encode(array('message' => 'Izmjena uspješna.', 'icon'=>'success'));
} else {
    print json_encode(array('message' => 'Nema pronađenih rezultata.', 'icon'=>'error'));
}
$db->close($con);
exit;
?>