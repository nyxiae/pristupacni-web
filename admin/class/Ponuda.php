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
        $sql = "SELECT p.id_ponuda, p.naslov,
                concat('<a href=\'/admin/view/uredaj/index.php?id_ponuda=',
                    p.id_ponuda,
                    '\'>stavke (',
                    (select count(*) from uredaj where id_ponuda=p.id_ponuda and aktivan = 1),
                    ')</a>') as uredaji,
                    '',
                k.naziv, s.naziv
                FROM ponuda p 
                JOIN kompanija k ON p.id_kompanija = k.id_kompanija
                JOIN stranica s ON p.id_stranica = s.id_stranica
                WHERE p.aktivan = 1";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_frontend($id_str){

        $sql = "SELECT p.id_ponuda, k.naziv, p.naslov, p.tekst 
                FROM ponuda  p 
                JOIN kompanija k on p.id_kompanija = k.id_kompanija 
                WHERE p.aktivan = 1 AND p.id_stranica = $id_str";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_single_frontend($ponuda){

        $sql = "SELECT k.naziv as kompanija, p.naslov, p.tekst 
                FROM ponuda  p 
                JOIN kompanija k on p.id_kompanija = k.id_kompanija 
                WHERE p.aktivan = 1 AND p.id_ponuda = $ponuda";
        
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

    public function delete($id) {
        $sql = "UPDATE ponuda SET aktivan = 0 WHERE id_ponuda = ?";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        
        $logSql = "UPDATE ponuda SET aktivan = 0 WHERE id_ponuda = '{$id}'";

        if ($result) {
            $this->log->create($logSql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }
        
        return $result;
    }

    public function create($data){
        $sql = "INSERT INTO ponuda (id_kompanija, id_stranica, naslov, tekst) VALUES (?, ?, ?, ?)";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("iiss", $data["id_kompanija"], $data["id_stranica"], $data["naslov"], $data["tekst"]);
        $result = $stmt->execute();

        $logSql = "INSERT INTO ponuda (id_kompanija, id_stranica, naslov, tekst) VALUES ('{$data["id_kompanija"]}', '{$data["id_stranica"]}', '{$data["naslov"]}','{$data["tekst"]}')";
        if ($result) {
            $this->log->create($logSql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

    public function update($data){
        $sql = "UPDATE ponuda SET id_kompanija = ?, id_stranica = ?, naslov = ?, tekst = ? WHERE id_ponuda = ?";
        
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssssi", $data["id_kompanija"], $data["id_stranica"], $data["naslov"], $data["tekst"], $data["id_ponuda"]);
        $result = $stmt->execute();

        $logSql = "UPDATE ponuda SET id_kompanija = '{$data["id_kompanija"]}', id_stranica = '{$data["id_stranica"]}', naslov = '{$data["naslov"]}', tekst = '{$data["tekst"]}' WHERE id_ponuda = '{$data["id_ponuda"]}'";

        if ($result) {
            $this->log->create($logSql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }

        return $result;    
    }

    public function read_options(){
        $sql = "SELECT id_ponuda, naslov FROM ponuda WHERE aktivan = 1";
        
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }
}


?>
