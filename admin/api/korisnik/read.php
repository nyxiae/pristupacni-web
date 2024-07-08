<?php
require_once('../../class/Database.php'); 
require_once('../../class/Korisnik.php'); 

$db = new Database(); 
$con = $db->connect();
$korisnik = new Korisnik($con); 

$result = $korisnik->read();

if ($result->num_rows > 0) {
    $korisnici = array();
    while ($row = mysqli_fetch_row($result)) {
        $korisnici[] = $row;
    }
    print json_encode(array("data"=>$korisnici));
} else {
    print json_encode(array('message' => 'Nema pronađenih rezultata.'));
}
$db->close($con);
exit;
?>