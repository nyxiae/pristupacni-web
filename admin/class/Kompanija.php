<?php
require_once("Log.php");

class Kompanija{
	private $con;
    private $log;

	public function __construct($db){
		$this->con = $db;
        $this->log = new Log($this->con);
	}

    public function read(){
        $sql = "SELECT id_kompanija, naziv, mail, telefon
                FROM kompanija";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_frontend(){
        $sql = "SELECT id_kompanija, naziv, mail, telefon, tekst
                FROM kompanija";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_single($id){
        $sql = "SELECT * FROM kompanija WHERE id_kompanija = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function create($data){
        $sql = "INSERT INTO kompanija (naziv, mail, telefon, tekst) VALUES (?, ?, ?, ?)";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssss", $data["naziv"], $data["mail"], $data["telefon"], $data["tekst"]);
        $result = $stmt->execute();

        if ($result) {
            $this->log->create($sql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

    public function update($data){
        $sql = "UPDATE kompanija SET naziv = ?, mail = ?, telefon = ?, tekst = ? WHERE id_kompanija = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssssi", $data["naziv"], $data["mail"], $data["telefon"], $data["tekst"], $data["id_kompanija"]);
        $result = $stmt->execute();

        if ($result) {
            $this->log->create($sql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

    public function read_options(){
        $sql = "SELECT id_kompanija, naziv FROM kompanija";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;    
    }
}


?>
