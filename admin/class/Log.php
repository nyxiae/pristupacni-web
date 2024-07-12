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
        $sql = "SELECT l.id_log, k.korisnicko_ime, l.upit, l.vrijeme
                FROM log l
                JOIN korisnik k ON k.id_korisnik = l.id_korisnik
                ORDER BY l.vrijeme DESC";

        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result;
    }

    public function read_korisnik($id) {
        $sql = "SELECT l.upit, l.vrijeme
                FROM log l
                WHERE l.id_korisnik = ?
                ORDER BY l.vrijeme DESC LIMIT 10";
    
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $upit = $row['upit'];
            $table_name = $this->extract_table_name($upit);
            $data[] = array('table_name' => $table_name, 'vrijeme' => $row['vrijeme']);
        }
        
        return $data;
    }
    
    private function extract_table_name($upit) {
        if (preg_match('/UPDATE\s+(\w+)/i', $upit, $matches)) {
            return $matches[1];
        } elseif (preg_match('/INSERT\s+INTO\s+(\w+)/i', $upit, $matches)) {
            return $matches[1];
        }
        return null; // Or return some default value if the pattern is not matched
    }

    public function create($upit, $opis) {
        $id_korisnik = isset($_SESSION["id_korisnik"]) ? $_SESSION["id_korisnik"] : 0;
        $IP = $_SERVER["REMOTE_ADDR"];
        $upit = trim(preg_replace('/\s+/', ' ', $upit));
        
        $sql = "INSERT INTO log (id_korisnik, upit, opis, ip_adresa) VALUES (?, ?, ?, ?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('isss', $id_korisnik, $upit, $opis, $IP);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>