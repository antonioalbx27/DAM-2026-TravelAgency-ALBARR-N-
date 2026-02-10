<?php
session_start();
require_once '../clases/Database.php';
require_once '../clases/Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['admin'] !== 'SI') {
    header('Location: login.php');
    exit;
}

require_once '../clases/Viaje.php';
$viaje = new Viaje($db);
$viajes = $viaje->getAll();

$page_title = "CRUD Viajes - Terra Nova";
include '../vistas/header.php';
include '../vistas/navigation.php';
?>

<style>
    table { 
        width: 100%; 
        border-collapse: collapse; 
        margin: 20px 0;
        background: white;
    }
    th, td { 
        padding: 12px; 
        text-align: left; 
        border-bottom: 1px solid #ddd; 
    }
    th { 
        background-color: #0066cc; 
        color: white;
        font-weight: bold; 
    }
    tr:hover { 
        background-color: #f5f5f5; 
    }
    .btn { 
        padding: 8px 16px; 
        margin: 5px; 
        text-decoration: none; 
        background: #007bff; 
        color: white; 
        border-radius: 4px; 
        display: inline-block; 
        border: none;
        cursor: pointer;
    }
    .btn-danger { 
        background: #dc3545; 
    }
    .btn-success { 
        background: #28a745; 
    }
    .crud-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
    }
</style>

<div id="asidemedio">
    <div class="crud-container">
        <a href="viaje_form.php" class="btn btn-success">+ Añadir Nuevo Viaje</a>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Planeta</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Destacado</th>
                    <th>Plazas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $viajes->fetch()): ?>
                    <tr>
                        <td><?php echo $row['id_viaje']; ?></td>
                        <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($row['planeta'] ?? $row['destino'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($row['tipo_viaje'] ?? ''); ?></td>
                        <td><?php echo number_format($row['precio'], 2); ?>€</td>
                        <td><?php echo $row['destacado'] ? 'Sí' : 'No'; ?></td>
                        <td><?php echo $row['plazas_disponibles'] ?? $row['plazas'] ?? ''; ?></td>
                        <td>
                            <a href="viaje_form.php?id=<?php echo $row['id_viaje']; ?>" class="btn">Editar</a>
                            <a href="viaje_delete.php?id=<?php echo $row['id_viaje']; ?>" 
                               class="btn btn-danger"
                               onclick="return confirm('¿Seguro que deseas eliminar este viaje?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../vistas/footer.php'; ?>
