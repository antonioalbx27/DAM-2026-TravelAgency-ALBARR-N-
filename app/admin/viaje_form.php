<?php
session_start();
require_once '../clases/Database.php';
require_once '../clases/Usuario.php';
require_once '../clases/Viaje.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['admin'] !== 'SI') {
    header('Location: login.php');
    exit;
}

$viaje = new Viaje($db);
$mensaje = '';
$viaje_actual = null;

$id = $_GET['id'] ?? null;
if ($id) {
    $viaje_actual = $viaje->getById($id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $viaje->titulo = $_POST['titulo'];
    $viaje->destino = $_POST['planeta'];
    $viaje->descripcion = $_POST['descripcion'];
    $viaje->fecha_inicio = $_POST['fecha_inicio'];
    $viaje->fecha_fin = $_POST['fecha_fin'];
    $viaje->precio = $_POST['precio'];
    $viaje->destacado = isset($_POST['destacado']) ? 1 : 0;
    $viaje->plazas_disponibles = $_POST['plazas'];
    $viaje->imagen = $_POST['imagen'];
    
  
    $viaje->itinerario = $_POST['descripcion']; 
    $viaje->tipo_viaje = 'espacial'; 
    
    if ($id) {
        $viaje->id = $id;
        if ($viaje->actualizar()) {
            header('Location: crud.php');
            exit;
        } else {
            $mensaje = 'Error al actualizar el viaje';
        }
    } else {
        if ($viaje->crear()) {
            header('Location: crud.php');
            exit;
        } else {
            $mensaje = 'Error al crear el viaje';
        }
    }
}

$page_title = ($id ? 'Editar' : 'Crear') . " Viaje - Terra Nova";
include '../vistas/header.php';
include '../vistas/navigation.php';
?>

<style>
    .form-container { 
        max-width: 800px; 
        margin: 20px auto; 
        padding: 20px 0; 
    }
    .form-group { 
        margin-bottom: 20px; 
    }
    .form-group label { 
        display: block; 
        margin-bottom: 5px; 
        font-weight: bold; 
    }
    .form-group input, 
    .form-group select, 
    .form-group textarea { 
        width: 100%; 
        padding: 10px; 
        box-sizing: border-box; 
        border: 1px solid #ccc; 
    }
    .form-group textarea { 
        min-height: 150px; 
    }
    .btn { 
        padding: 12px 24px; 
        background: #007bff; 
        color: white; 
        border: none; 
        cursor: pointer; 
        text-decoration: none; 
        display: inline-block; 
        margin-right: 10px; 
    }
    .btn-secondary { 
        background: #6c757d; 
    }
    .checkbox-label {
        display: flex;
        align-items: center;
        font-weight: normal;
    }
    .checkbox-label input {
        width: auto;
        margin-right: 10px;
    }
</style>

<div id="asidemedio">
    <div class="form-container">
        <h1><?php echo $id ? 'Editar' : 'Crear Nuevo'; ?> Viaje</h1>
        
        <?php if ($mensaje): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 20px;">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label>Título del Viaje</label>
                <input type="text" name="titulo" value="<?php echo $viaje_actual['titulo'] ?? ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Planeta</label>
                <input type="text" name="planeta" value="<?php echo $viaje_actual['planeta'] ?? $viaje_actual['destino'] ?? ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion"><?php echo $viaje_actual['descripcion'] ?? ''; ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Fecha Inicio</label>
                <input type="date" name="fecha_inicio" value="<?php echo $viaje_actual['fecha_inicio'] ?? ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Fecha Fin</label>
                <input type="date" name="fecha_fin" value="<?php echo $viaje_actual['fecha_fin'] ?? ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Precio (€)</label>
                <input type="number" name="precio" value="<?php echo $viaje_actual['precio'] ?? ''; ?>">
            </div>
            
            <div class="form-group">
                <label>Plazas Disponibles</label>
                <input type="number" name="plazas" value="<?php echo $viaje_actual['plazas_disponibles'] ?? $viaje_actual['plazas'] ?? 20; ?>">
            </div>
            
            <div class="form-group">
                <label>Imagen (nombre de archivo)</label>
                <input type="text" name="imagen" value="<?php echo $viaje_actual['imagen'] ?? ''; ?>" placeholder="ej: tatooine.jpg">
            </div>
            
            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="destacado" <?php echo ($viaje_actual['destacado'] ?? 0) ? 'checked' : ''; ?>>
                    Marcar como destacado
                </label>
            </div>
            
            <button type="submit" class="btn"><?php echo $id ? 'Actualizar' : 'Crear'; ?> Viaje</button>
            <a href="crud.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<?php include '../vistas/footer.php'; ?>
