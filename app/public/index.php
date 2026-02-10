<?php
session_start();
require_once '../clases/Database.php';
require_once '../clases/Viaje.php';

$database = new Database();
$db = $database->getConnection();
$viaje = new Viaje($db);

$todos_viajes = $viaje->getAll();

$page_title = "Terra Nova - Inicio";
include '../vistas/header.php';
include '../vistas/navigation.php';
?>

<div id="asidemedio">
    <h1>BIENVENIDOS A TERRA NOVA</h1>
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 20px;">
        <?php while ($row = $todos_viajes->fetch()): ?>
            <div style="border: 1px solid #ccc; padding: 15px; background: #f9f9f9; word-wrap: break-word; overflow-wrap: break-word; min-width: 0;">
                <h3 style="margin-bottom: 10px; color: #0066cc; word-wrap: break-word;"><?php echo htmlspecialchars($row['titulo']); ?></h3>
                <p style="word-wrap: break-word;"><strong>Fechas:</strong> 
                    <?php echo date('d/m/Y', strtotime($row['fecha_inicio'])); ?> - 
                    <?php echo date('d/m/Y', strtotime($row['fecha_fin'])); ?>
                    
                </p>
                <img src="<?php echo $row['imagen']; ?>">
                <p style="word-wrap: break-word;"><strong>Precio:</strong> <?php echo number_format($row['precio'], 2); ?>€</p>
                <a href="detalle_viaje.php?id=<?php echo $row['id_viaje']; ?>" style="text-decoration: none; color: white;">
                    <p style="background: #0066cc; color: white; padding: 8px; text-align: center; margin-top: 10px;">Ver Detalles</p>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include '../vistas/footer.php'; ?>
