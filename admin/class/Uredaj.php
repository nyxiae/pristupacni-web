<?php
require_once("Log.php");

class Uredaj{
	private $con;
    private $log;

	public function __construct($db){
		$this->con = $db;
        $this->log = new Log($this->con);
	}

    public function read($id){
        $sql = "SELECT id_uredaj, naziv 
                FROM uredaj WHERE aktivan = ? AND id_ponuda = ?";
        
        $aktivan = 1; 
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ii", $aktivan, $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_frontend(){
        $sql = "SELECT id_uredaj, naziv, url_slika 
                FROM uredaj WHERE aktivan = ?";
        
        $aktivan = 1; 
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $aktivan);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function read_single($id){
        $sql = "SELECT * FROM uredaj WHERE id_uredaj = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;    
    }

    public function create($data){
        if (isset($data['slika'])) {
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/photo/";
            $fileName = uniqid() . basename($data['slika']['name']);
            $targetFilePath = $targetDir . $fileName; 
            $savedDir = "/photo/" . $fileName;
            if (move_uploaded_file($data['slika']['tmp_name'], $targetFilePath)) {
                $data['url_slika'] = $savedDir;
            } else {
                return false;
            }
        } else {
            $data['url_slika'] = '';
        }

        $sql = "INSERT INTO uredaj (id_ponuda, naziv, url_slika) VALUES (?, ?, ?)";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("iss", $data["id_ponuda"], $data["naziv"], $data["url_slika"]);
        $result = $stmt->execute();

        $logSql = "INSERT INTO uredaj (id_ponuda, naziv, url_slika) VALUES ('{$data["id_ponuda"]}', '{$data["naziv"]}', '{$data["url_slika"]}')";
        
        if ($result) {
            $this->log->create($logSql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }
        return $result; 
    }

    public function update($data){
       if (isset($data['slika'])) {
           $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/photo/";
           $fileName = uniqid() . basename($data['slika']['name']);
           $targetFilePath = $targetDir . $fileName;
           if (move_uploaded_file($data['slika']['tmp_name'], $targetFilePath)) {
               $data['url_slika'] = $targetFilePath;
            } else {
               return false;
            }

            $sql = "UPDATE uredaj SET naziv = ?, url_slika = ? WHERE id_uredaj = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("ssi", $data["naziv"], $data["url_slika"], $data["id_uredaj"]);
            $result = $stmt->execute();
            $logSql = "UPDATE uredaj SET naziv = '{$data["naziv"]}', url_slika = '{$data["url_slika"]}' WHERE id_uredaj = '{$data["id_uredaj"]}'";
        
        } else {
            $sql = "UPDATE uredaj SET naziv = ? WHERE id_uredaj = ?";
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("ss", $data["naziv"], $data["id_uredaj"]);
            $result = $stmt->execute();
            $logSql = "UPDATE uredaj SET naziv = '{$data["naziv"]}' WHERE id_uredaj = '{$data["id_uredaj"]}'";
        }

        if ($result) {
            $this->log->create($logSql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }
        return $result; 

    }

    
    public function delete($id) {
        $sql = "UPDATE uredaj SET aktivan = 0 WHERE id_uredaj = ?";

        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        
        $logSql = "UPDATE uredaj SET aktivan = 0 WHERE id_uredaj = $id";

        if ($result) {
            $this->log->create($logSql, basename(__FILE__, ".php") . " " . __FUNCTION__);
        }
        
        return $result;
    }
}
?>
