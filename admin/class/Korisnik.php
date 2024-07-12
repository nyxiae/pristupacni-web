<?php
require_once("Log.php");

class Korisnik{
	private $con;
	private $log;

	public function __construct($db){
		$this->con = $db;
        $this->log = new Log($this->con);
	}

	public function read(){

		$sql = "SELECT id_korisnik, 
		korisnicko_ime, 
		uloga,
		datum_vrijeme_zadnja_prijava
		from korisnik";
		
		$result=mysqli_query($this->con,$sql);
		return $result;	
	}

	public function read_single($id){
		$sql = "SELECT * FROM korisnik WHERE id_korisnik = ?";
		$stmt = $this->con->prepare($sql);
		
		if ($stmt === false) {
			die('Prepare failed: ' . $this->con->error);
		}
	
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$result = $stmt->get_result();
	
		return $result;
	}

	public function create($data) {
		$sql = "SELECT count(*) FROM korisnik WHERE korisnicko_ime = '{$data["korisnicko_ime"]}'";
		$result_provjera = mysqli_query($this->con, $sql);
		$row = mysqli_fetch_row($result_provjera);
	
		if (!$row[0]) {
			$hashed_password = password_hash($data["lozinka"], PASSWORD_DEFAULT);
	
			$sql = "INSERT INTO korisnik (korisnicko_ime, lozinka, uloga) VALUES ('{$data["korisnicko_ime"]}', '{$hashed_password}', '{$data["uloga"]}')";
			$result = mysqli_query($this->con, $sql);
		} else {
			$result = false; 
		}
	
		$this->log->create($sql, basename(__FILE__, ".php") . " " . __FUNCTION__);
	
		return ($result && $result_provjera);
	}
	

	public function delete($data){
		$sql = "DELETE FROM korisnik VALUES id_korisnik'";
		$result=mysqli_query($this->con,$sql);
        $this->log->create($sql, basename(__FILE__, ".php") . " " . __FUNCTION__);
		return $result;	
	}

	public function update($data){
		$sql = "SELECT count(*) FROM korisnik WHERE korisnicko_ime = ? AND id_korisnik <> ?";
		$stmt = $this->con->prepare($sql);
		$stmt->bind_param('si', $data["korisnicko_ime"], $data["id_korisnik"]);
		$stmt->execute();
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->close();
	
		if ($count == 0) {
			$sql = "UPDATE korisnik SET korisnicko_ime = ?";
			$params = [$data["korisnicko_ime"]];
			$types = 's'; 
	
			if (!empty($data["lozinka"])) {
				$hashedPassword = password_hash($data["lozinka"], PASSWORD_DEFAULT);
				$sql .= ", lozinka = ?";
				$params[] = $hashedPassword;
				$types .= 's';
			}
	
			$sql .= " WHERE id_korisnik = ?";
			$params[] = $data["id_korisnik"];
			$types .= 'i'; 
	
			$stmt = $this->con->prepare($sql);
			$stmt->bind_param($types, ...$params);
			$result = $stmt->execute();
			$stmt->close();
			
			$this->log->create($sql, basename(__FILE__, ".php") . " " . __FUNCTION__);
			return $result;
		} else {
			return false;
		}
	}

	public function read_options(){
		$sql = "SELECT id_korisnik, korisnicko_ime 
		FROM korisnik";

		$result=mysqli_query($this->con,$sql);
		return $result;	

	}

}