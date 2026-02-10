<?php
session_start();
require_once '../clases/Database.php';
require_once '../clases/Usuario.php';


if (isset($_SESSION['usuario']) && $_SESSION['usuario']['admin'] === 'SI') {
    header('Location: crud.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    $usuario = new Usuario($db);
    
    $user = $usuario->login($_POST['correo'], $_POST['password']);
    
    if ($user) {
        $_SESSION['usuario'] = $user;
        
        if ($user['admin'] === 'SI') {
            header('Location: crud.php');
        } else {
            header('Location: ../public/index.php');
        }
        exit;
    } else {
        $error = 'Credenciales incorrectas';
    }
}

$page_title = "Iniciar sesión - Terra Nova";
include '../vistas/header.php';
include '../vistas/navigation.php';
?>

<div id="asidemedio">
    <div style="max-width: 400px; margin: 0 auto; padding: 20px;">
        <h1>Iniciar sesión</h1>
        <hr>
        
        <?php if ($error): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 10px; margin: 10px 0; border: 1px solid #f5c6cb;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" style="margin-top: 20px;">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;"><strong>Correo:</strong></label>
                <input type="email" name="correo" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px;"><strong>Contraseña:</strong></label>
                <input type="password" name="password" style="width: 100%; padding: 8px; box-sizing: border-box;">
            </div>
            
            <button type="submit" style="width: 100%; padding: 10px; background: #007bff; color: white; border: none; cursor: pointer; font-size: 16px;">
                Iniciar Sesión
            </button>
        </form>
    </div>
</div>

<?php include '../vistas/footer.php'; ?>
