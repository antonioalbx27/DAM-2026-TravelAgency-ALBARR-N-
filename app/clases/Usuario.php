<?php

class Usuario {
    private $conn;
    private $table = "usuarios";

    public $id_usuario;
    public $nombre;
    public $apellidos;
    public $correo;
    public $contraseña;
    public $admin;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($correo, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE correo = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        
        $correo = htmlspecialchars(strip_tags($correo));
        $stmt->bindParam(1, $correo);
        $stmt->execute();
        
        $user = $stmt->fetch();
        

        if ($user && password_verify($password, $user['contraseña'])) {
            return $user;
        }
        
        return false;
    }


    public function esAdmin() {
        return isset($_SESSION['usuario']) && $_SESSION['usuario']['admin'] === 'SI';
    }


    public function crear() {
        $query = "INSERT INTO " . $this->table . " (nombre, apellidos, correo, contraseña, admin) VALUES (:nombre, :apellidos, :correo, :password, :admin)";
        $stmt = $this->conn->prepare($query);
        

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellidos = htmlspecialchars(strip_tags($this->apellidos));
        $this->correo = htmlspecialchars(strip_tags($this->correo));
        $this->admin = htmlspecialchars(strip_tags($this->admin));
        
    
        $password_hash = password_hash($this->contraseña, PASSWORD_BCRYPT);
        
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellidos", $this->apellidos);
        $stmt->bindParam(":correo", $this->correo);
        $stmt->bindParam(":password", $password_hash);
        $stmt->bindParam(":admin", $this->admin);
        
        return $stmt->execute();
    }

    
    public function getAll() {
        $query = "SELECT id_usuario, nombre, apellidos, correo, admin FROM " . $this->table . " ORDER BY id_usuario DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

  
    public function getById($id) {
        $query = "SELECT id_usuario, nombre, apellidos, correo, admin FROM " . $this->table . " WHERE id_usuario = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>
