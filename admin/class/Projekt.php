<?php
require_once("Log.php");

class Projekt{
	private $con;
    private $log;

	public function __construct($db){
		$this->con = $db;
        $this->log = new Log($this->con);
	}

    public function read(){
        $sql = "SELECT id_projekt, naziv 
                FROM projekti";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_frontend(){
        $sql = "SELECT id_projekt, id_stanica, naslov, tekst 
                FROM projekti WHERE aktivan = ?";
        
        $aktivan = 1; 
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $aktivan);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_single($id){
        $sql = "SELECT * FROM projekti WHERE id_projekt = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function create($data){
        $sql = "INSERT INTO projekti (id_projekt, id_stranica, naslov, tekst) VALUES (?, ?, ?, ?)";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssss", $data["id_projekt"], $data["id_stranica"], $data["naslov"], $data["tekst"]);
        $result = $stmt->execute();

        if ($result) {
            $this->log->create($sql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

    public function update($data){
        $sql = "UPDATE projekti SET id_stranica = ?, naslov = ?, tekst = ? WHERE id_projekt = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sssi", $data["id_stranica"], $data["naslov"], $data["tekst"], $data["id_projekt"],);
        $result = $stmt->execute();

        if ($result) {
            $this->log->create($sql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

    public function read_options(){
        $sql = "SELECT id_projekt, naslov FROM projekti WHERE aktivan = ?";
        
        $aktivan = 1;
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $aktivan);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }
}


?>
