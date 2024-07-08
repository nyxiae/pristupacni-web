<?php
require_once('../../class/Database.php'); 
require_once('../../class/Korisnik.php'); 

$db = new Database(); 
$con = $db->connect();
$korisnik = new Korisnik($con); 

$result = $korisnik->create($_POST);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_row($result)
    print json_encode(array('message' => 'Korisnik kreiran.'));
} else {
    print json_encode(array('message' => 'Dodavanje nije uspjelo.'));
}
$db->close($con);
exit;
?>