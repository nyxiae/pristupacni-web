<?php

class Kompanija {
    private $conn;
    private $id_kompanija;
    private $naziv;
    private $mail;
    private $telefon;
    private $tekst;

    // Constructor
    public function __construct($conn, $data) {
        $this->conn = $conn;
        $this->id_kompanija = $data['id_kompanija'] ?? null;
        $this->naziv = $data['naziv'] ?? '';
        $this->mail = $data['mail'] ?? '';
        $this->telefon = $data['telefon'] ?? '';
        $this->tekst = $data['tekst'] ?? '';
    }

    // Save method
    public function save() {
        $stmt = $this->conn->prepare("INSERT INTO kompanija (naziv, mail, telefon, tekst) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $this->naziv, $this->mail, $this->telefon, $this->tekst);
        $stmt->execute();
        $this->id_kompanija = $this->conn->insert_id;
        $stmt->close();
    }

    // Update method
    public function update() {
        if ($this->id_kompanija == null) {
            throw new Exception("ID is required for update.");
        }
        $stmt = $this->conn->prepare("UPDATE kompanija SET naziv = ?, mail = ?, telefon = ?, tekst = ? WHERE id_kompanija = ?");
        $stmt->bind_param("ssssi", $this->naziv, $this->mail, $this->telefon, $this->tekst, $this->id_kompanija);
        $stmt->execute();
        $stmt->close();
    }

    // Delete method
    public function delete() {
        if ($this->id_kompanija == null) {
            throw new Exception("ID is required for delete.");
        }
        $stmt = $this->conn->prepare("DELETE FROM kompanija WHERE id_kompanija = ?");
        $stmt->bind_param("i", $this->id_kompanija);
        $stmt->execute();
        $stmt->close();
    }

    // Static method to get all records
    public static function getAll($conn) {
        $result = $conn->query("SELECT * FROM kompanija");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Static method to get a single record by ID
    public static function getById($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM kompanija WHERE id_kompanija = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
        return $data;
    }
}

?>
