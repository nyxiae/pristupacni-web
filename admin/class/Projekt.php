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
                FROM projekti WHERE aktivan = ?";
        
        $aktivan = 1; 
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $aktivan);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_frontend(){
        $sql = "SELECT id_projekt, naziv, tekst 
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
        $sql = "INSERT INTO projekti (id_stranica, naziv, tekst) VALUES (?, ?, ?)";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("iss", $data["id_stranica"], $data["naziv"], $data["tekst"]);
        $result = $stmt->execute();

        $logSql = "INSERT INTO projekti (id_stranica, naziv, tekst) VALUES ('{$data["id_stranica"]}', '{$data["naziv"]}', '{$data["tekst"]}')";
       
        if ($result) {
            $this->log->create($logSql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

    public function update($data){
        $sql = "UPDATE projekti SET id_stranica = ?, naziv = ?, tekst = ? WHERE id_projekt = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("issi", $data["id_stranica"], $data["naziv"], $data["tekst"], $data["id_projekt"]);
        $result = $stmt->execute();

        $logSql = "UPDATE projekti SET id_stranica = '{$data["id_stranica"]}', naziv = '{$data["naziv"]}', tekst = '{$data["tekst"]}' WHERE id_projekt = '{$data["id_projekt"]}'";

        if ($result) {
            $this->log->create($logSql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

    
    public function delete($id) {
        $sql = "UPDATE projekti SET aktivan = 0 WHERE id_projekt = ?";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        
        $logSql = "UPDATE projekti SET aktivan = 0 WHERE id_projekt = $id";

        if ($result) {
            $this->log->create($logSql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }
        
        return $result;
    }

    public function read_options(){
        $sql = "SELECT id_projekt, naziv FROM projekti WHERE aktivan = ?";
        
        $aktivan = 1;
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $aktivan);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }
}


?>
