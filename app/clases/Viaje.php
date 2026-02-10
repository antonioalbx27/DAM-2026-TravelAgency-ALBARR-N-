<?php

class Viaje {
    private $conn;
    private $table = "viajes";

    public $id;
    public $titulo;
    public $destino;
    public $descripcion;
    public $fecha_inicio;
    public $fecha_fin;
    public $itinerario;
    public $precio;
    public $destacado;
    public $tipo_viaje;
    public $plazas_disponibles;
    public $imagen;


    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id_viaje ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getDestacados() {
        $query = "SELECT * FROM " . $this->table . " WHERE destacado = 1 ORDER BY id_viaje DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function buscar($destino = '') {
        $query = "SELECT * FROM " . $this->table . " WHERE 1=1";
        
        if (!empty($destino)) {
            $query .= " AND (planeta LIKE :destino OR titulo LIKE :destino)";
        }
        
        $query .= " ORDER BY id_viaje DESC";
        
        $stmt = $this->conn->prepare($query);
        
        if (!empty($destino)) {
            $destino_param = "%{$destino}%";
            $stmt->bindParam(":destino", $destino_param);
        }
        
        $stmt->execute();
        return $stmt;
    }


    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_viaje = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch();
    }


    public function crear() {
        $query = "INSERT INTO " . $this->table . " 
                  (titulo, planeta, descripcion, fecha_inicio, fecha_fin, precio, destacado, plazas, imagen)
                  VALUES (:titulo, :destino, :descripcion, :fecha_inicio, :fecha_fin, :precio, :destacado, :plazas, :imagen)";
        
        $stmt = $this->conn->prepare($query);
        
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->destino = htmlspecialchars(strip_tags($this->destino));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":destino", $this->destino);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":fecha_inicio", $this->fecha_inicio);
        $stmt->bindParam(":fecha_fin", $this->fecha_fin);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":destacado", $this->destacado);
        $stmt->bindParam(":plazas", $this->plazas_disponibles);
        $stmt->bindParam(":imagen", $this->imagen);
        
        return $stmt->execute();
    }


    public function actualizar() {
        $query = "UPDATE " . $this->table . " 
                  SET titulo = :titulo, planeta = :destino, descripcion = :descripcion,
                      fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin,
                      precio = :precio, destacado = :destacado, 
                      plazas = :plazas, imagen = :imagen
                  WHERE id_viaje = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->destino = htmlspecialchars(strip_tags($this->destino));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":destino", $this->destino);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":fecha_inicio", $this->fecha_inicio);
        $stmt->bindParam(":fecha_fin", $this->fecha_fin);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":destacado", $this->destacado);
        $stmt->bindParam(":plazas", $this->plazas_disponibles);
        $stmt->bindParam(":imagen", $this->imagen);
        
        return $stmt->execute();
    }

    public function eliminar() {
        $query = "DELETE FROM " . $this->table . " WHERE id_viaje = ?";
        $stmt = $this->conn->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        
        return $stmt->execute();
    }
}
?>
