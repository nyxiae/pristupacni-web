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

	public function read_single($data){
		$sql = "SELECT * from korisnik where id_korisnik = '{$data["id_korisnik"]}'";
		$result=mysqli_query($this->con,$sql);
		return $result;	
	}

	public function create($data){

		$sql = "SELECT count(*) from korisnik where korisnicko_ime = '{$data["korisnicko_ime"]}' and aktivan = 1";
		$result_provjera = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_row($result_provjera);
		if(!$row[0]){
			$sql = "INSERT into korisnik set 
			korisnicko_ime = '{$data["korisnicko_ime"]}', 
			lozinka = '{$data["lozinka"]}'";
			
			$result = mysqli_query($this->con,$sql);
		}else{
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
		$sql = "SELECT count(*) from korisnik where korisnicko_ime = '{$data["korisnicko_ime"]}' and aktivan = 1 and id_korisnik <> '{$data["id_korisnik"]}'";
		$result = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_row($result);
		if(!$row[0]){
			$sql = "UPDATE korisnik set 
			korisnicko_ime = '{$data["korisnicko_ime"]}'"; 
			if($data["lozinka"]!==null){
				$sql.=",lozinka = '{$data["lozinka"]}'";
			}else{
				$sql.="";
			}
			$sql.=" where id_korisnik = '{$data["id_korisnik"]}'";
			$result=mysqli_query($this->con,$sql);
		}else{
			$result = false;
		}
        $this->log->create($sql, basename(__FILE__, ".php") . " " . __FUNCTION__);
		return $result;	
	}

	public function read_options(){
		$sql = "SELECT id_korisnik, korisnicko_ime 
		FROM korisnik";

		$result=mysqli_query($this->con,$sql);
		return $result;	

	}

}