<?php
require_once("Log.php");

class Stranica{
	private $con;
    private $log;

	public function __construct($db){
		$this->con = $db;
        $this->log = new Log($this->con);
	}

    public function read(){
        $sql = "SELECT id_stranica, naziv
                FROM stranica WHERE aktivan = ?";
        
        $aktivan = 1;
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $aktivan);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_frontend(){
        $sql = "SELECT id_stranica, tekst
                FROM stranica WHERE aktivan = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", 1);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_single($id){
        $sql = "SELECT * FROM stranica WHERE id_stranica = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function create($data){
        $sql = "INSERT INTO stranica (naziv, tekst) VALUES (?, ?)";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ss", $data["naziv"], $data["tekst"]);
        $result = $stmt->execute();

        if ($result) {
            $this->log->create($sql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

    public function update($data){
        $sql = "UPDATE stranica SET naziv = ?, tekst = ? WHERE id_stranica = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssssi", $data["naziv"], $data["tekst"], $data["id_stranica"]);
        $result = $stmt->execute();

        if ($result) {
            $this->log->create($sql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

}
?>
