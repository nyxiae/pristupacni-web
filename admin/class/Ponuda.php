<?php
require_once("Log.php");

class Ponuda{
	private $con;
    private $log;

	public function __construct($db){
		$this->con = $db;
        $this->log = new Log($this->con);
	}

    public function read(){
        $sql = "SELECT p.id_ponuda, p.naslov, k.naziv
                FROM ponuda p 
                JOIN kompanija k ON p.id_kompanija = k.id_kompanija";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_frontend(){
        $sql = "SELECT id_ponuda, id_kompanija, id_stanica, naslov, tekst 
                FROM ponuda";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_single($id){
        $sql = "SELECT * FROM ponuda WHERE id_ponuda = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function create($data){
        $sql = "INSERT INTO ponuda (id_kompanija, id_stranica, naslov, tekst) VALUES (?, ?, ?, ?)";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssss", $data["id_kompanija"], $data["id_stranica"], $data["naslov"], $data["tekst"]);
        $result = $stmt->execute();

        if ($result) {
            $this->log->create($sql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

    public function update($data){
        $sql = "UPDATE ponuda SET id_kompanija = ?, id_stranica = ?, naslov = ?, tekst = ? WHERE id_ponuda = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssssi", $data["id_kompanija"], $data["id_stranica"], $data["naslov"], $data["tekst"], $data["id_ponuda"]);
        $result = $stmt->execute();

        if ($result) {
            $this->log->create($sql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

    public function read_options(){
        $sql = "SELECT id_ponuda, naslov FROM ponuda";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }
}


?>
