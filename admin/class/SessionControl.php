<?php
session_start();
include("Database.php");

class SessionControl {

    private $db;

    public function login($korisnicko_ime, $lozinka) {
        $this->db = new Database();
        $con = $this->db->connect();
        if (!$con) {
            echo("Database connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('s', $korisnicko_ime);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($lozinka, $row['lozinka'])) {
                $_SESSION['godina'] = date('Y');
                $_SESSION['start_time'] = time();
                $_SESSION['korisnicko_ime'] = $row['korisnicko_ime'];
                $_SESSION['id_korisnik'] = $row['id_korisnik'];
                $_SESSION['uloga'] = $row['uloga'];
                
                $update_sql = "UPDATE korisnik SET datum_vrijeme_zadnja_prijava = NOW() WHERE id_korisnik = ?";
                $update_stmt = $con->prepare($update_sql);
                $update_stmt->bind_param('i', $row['id_korisnik']);
                $update_stmt->execute();

                $this->db->close($con);
                return 1;
            } else {
                $this->db->close($con);
                return "Pogrešna lozinka.";
            }
        } else {
            $this->db->close($con);
            return "Pogrešno korisničko ime ili/i lozinka.";
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ../login.php');
        exit();
    }

    public function setSession($session_key, $value) {
        $_SESSION[$session_key] = $value;
    }
}

$action = $_POST['action'] ?? null;
$SessionControl = new SessionControl();

if ($action === 'login') {
    if (isset($_POST['korisnicko_ime']) && isset($_POST['lozinka'])) {
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $lozinka = $_POST['lozinka'];
        $return = $SessionControl->login($korisnicko_ime, $lozinka);
        echo $return;
    } else {
        echo 0;
    }
} elseif ($action === 'logout') {
    $SessionControl->logout();
} elseif ($action === 'setSession') {
    if (isset($_POST['session_key']) && isset($_POST['value'])) {
        $SessionControl->setSession($_POST['session_key'], $_POST['value']);
    }
}
?>
