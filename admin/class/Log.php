<?php
if(!isset($_SESSION)) {
session_start();
}

class Log {
    private $con;

    public function __construct($db) {
        $this->con = $db;
    }

    public function read() {
        $sql = "SELECT l.id_log, CONCAT(k.korisnicko_ime) AS ime, l.upit, l.vrijeme
                FROM log l
                JOIN korisnik k ON k.id_korisnik = l.id_korisnik
                ORDER BY l.datum_vrijeme DESC";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result;
    }

    public function create($upit, $opis) {
        $id_korisnik = isset($_SESSION["id_korisnik"]) ? $_SESSION["id_korisnik"] : 0;
        $IP = $_SERVER["REMOTE_ADDR"];
        $upit = trim(preg_replace('/\s+/', ' ', $upit));
        
        $sql = "INSERT INTO log (id_korisnik, upit, opis, IP) VALUES (?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('isss', $id_korisnik, $upit, $opis, $IP);
        
        if ($stmt->execute()) {
            return true;
        } else {
            // Handle error if needed
            return false;
        }
    }
}
?>