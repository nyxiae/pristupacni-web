<?php
require_once("Log.php");

class Novost{
	private $con;
    private $log;

	public function __construct($db){
		$this->con = $db;
        $this->log = new Log($this->con);
	}

    public function read(){
        $sql = "SELECT id_novost, naslov 
                FROM novost WHERE aktivan = ?";
        
        $aktivan = 1; 
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $aktivan);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_frontend(){
        $sql = "SELECT id_novost, naslov, embed 
                FROM novost WHERE aktivan = ?";
        
        $aktivan = 1; 
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $aktivan);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_single($id){
        $sql = "SELECT * FROM novost WHERE id_novost = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function create($data){
        $sql = "INSERT INTO novost (naslov, embed) VALUES (?, ?)";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ss", $data["naslov"], $data["embed"]);
        $result = $stmt->execute();

        $logSql = "INSERT INTO novost (naslov, embed) VALUES ('{$data["naslov"]}', '{$data["embed"]}')";
       
        if ($result) {
            $this->log->create($logSql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

    public function update($data){
        $sql = "UPDATE novost SET naslov = ?, embed = ? WHERE id_novost = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssi", $data["naslov"], $data["embed"], $data["id_novost"]);
        $result = $stmt->execute();

        $logSql = "UPDATE novost SET naslov = '{$data["naslov"]}', embed = '{$data["embed"]}' WHERE id_novost = '{$data["id_novost"]}'";

        if ($result) {
            $this->log->create($logSql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

    
    public function delete($id) {
        $sql = "UPDATE novost SET aktivan = 0 WHERE id_novost = ?";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        
        $logSql = "UPDATE novost SET aktivan = 0 WHERE id_novost = $id";

        if ($result) {
            $this->log->create($logSql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }
        
        return $result;
    }

}


?>
