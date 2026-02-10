<?php
session_start();
require_once '../clases/Database.php';
require_once '../clases/Usuario.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    $usuario = new Usuario($db);
    
    if ($_POST['password'] !== $_POST['password_confirm']) {
        $error = 'Las contraseñas no coinciden';
    } else {
        $usuario->nombre = $_POST['nombre'];
        $usuario->apellidos = $_POST['apellidos'];
        $usuario->correo = $_POST['correo'];
        $usuario->contraseña = $_POST['password'];
        $usuario->admin = isset($_POST['admin']) ? 'SI' : 'NO';
        
        try {
            if ($usuario->crear()) {
                header('Location: ../admin/login.php');
                exit;
            } else {
                $error = 'Error al crear la cuenta.';
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = 'El correo ya está registrado. Por favor, usa otro correo.';
            } else {
                $error = 'Error al crear la cuenta. Inténtalo de nuevo.';
            }
        }
    }
}

$page_title = "Registro - Terra Nova";
include '../vistas/header.php';
include '../vistas/navigation.php';
?>

<div id="asidemedio">
    <div id="medioderecha" style="max-width: 600px; margin: 0 auto;">
        <h1>REGISTRATE A ESTA GRAN WEB</h1>
        <hr>
        
        <?php if ($error): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 15px; margin: 15px 0; border: 1px solid #f5c6cb; border-radius: 4px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" style="margin: 20px 0;">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;"><strong>Nombre:</strong></label>
                <input type="text" name="nombre" style="width: 100%; padding: 10px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;"><strong>Apellidos:</strong></label>
                <input type="text" name="apellidos" style="width: 100%; padding: 10px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;"><strong>Correo Electrónico:</strong></label>
                <input type="email" name="correo" style="width: 100%; padding: 10px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;"><strong>Contraseña:</strong></label>
                <input type="password" name="password" style="width: 100%; padding: 10px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;"><strong>Confirmar Contraseña:</strong></label>
                <input type="password" name="password_confirm" style="width: 100%; padding: 10px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 20px; padding: 15px; background: #f9f9f9; border: 1px solid #ddd;">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="checkbox" name="admin" style="margin-right: 10px; width: 18px; height: 18px;">
                    <span><strong>Registrarse como Administrador</strong></span>
                </label>
            </div>
            
            <button type="submit" style="width: 100%; padding: 12px; background: #007bff; color: white; border: none; cursor: pointer; font-size: 16px;">
                Registrarse
            </button>
        </form>
    </div>
</div>

<?php include '../vistas/footer.php'; ?>
