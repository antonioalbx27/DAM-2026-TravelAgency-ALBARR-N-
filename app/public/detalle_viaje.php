<?php
session_start();
require_once '../clases/Database.php';
require_once '../clases/Viaje.php';

$database = new Database();
$db = $database->getConnection();
$viaje_obj = new Viaje($db);

$id = $_GET['id'] ?? 0;
$viaje = $viaje_obj->getById($id);

if (!$viaje) {
    header('Location: index.php');
    exit;
}

$page_title = $viaje['titulo'];
include '../vistas/header.php';
include '../vistas/navigation.php';
?>

<div id="asidemedio">
    <div id="textoproducto">
        <div id="medioderecha">
            <h1><?php echo htmlspecialchars($viaje['titulo']); ?></h1>
            
            <img src="<?php echo $viaje['imagen']; ?>" style="max-width: 600px; height: auto; margin: 20px 0;">
        
        <div id="texto">
            <p><strong>ID Viaje:</strong> #<?php echo $viaje['id_viaje'] ?? 'N/A'; ?></p>
            <p><strong>Destino:</strong> <?php echo htmlspecialchars($viaje['planeta']); ?></p>
            <p><strong>Fechas:</strong> 
                <?php echo date('d/m/Y', strtotime($viaje['fecha_inicio'])); ?> - 
                <?php echo date('d/m/Y', strtotime($viaje['fecha_fin'])); ?>
            <h3>Precio: <?php echo number_format($viaje['precio'], 2); ?>€</h3>
            
            <hr>
            <h2>Descripción</h2>
            <p><?php echo ($viaje['descripcion']); ?></p>
            
            <a href="index.php">
                <p><mark class="fondotexto">Volver al Inicio</mark></p>
            </a>
        </div>
    </div>
</div>

<?php include '../vistas/footer.php'; ?>
