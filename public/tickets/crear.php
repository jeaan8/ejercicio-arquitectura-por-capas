<?php
require_once __DIR__ . '/../../negocio/Ticket.php';
require_once __DIR__ . '/../../datos/TicketRepository.php';

session_start();

$_SESSION['token'] = $_SESSION['token'] ?? bin2hex(random_bytes(32));
$mensaje = $_SESSION['mensaje'] ?? '';
$tipoMensaje = 'exito';
unset($_SESSION['mensaje']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipoMensaje = 'error';
    try {
        if (!is_string($_POST['token'] ?? null) || !hash_equals($_SESSION['token'], $_POST['token'])) {
            throw new InvalidArgumentException('Recarga la pagina y proba de nuevo.');
        }
        $titulo = is_string($_POST['titulo'] ?? null) ? $_POST['titulo'] : '';
        $descripcion = is_string($_POST['descripcion'] ?? null) ? $_POST['descripcion'] : '';

        $ticket = new Ticket($titulo, $descripcion);
        $repo = new TicketRepository();
        $repo->guardar($ticket);

        $_SESSION['mensaje'] = 'Listo, tu ticket quedo guardado como pendiente.';
        header('Location: crear.php', true, 303);
        exit;
    } catch (InvalidArgumentException $e) {
        $mensaje = $e->getMessage();
    } catch (PDOException $e) {
        $mensaje = 'No se pudo guardar. Revisa la conexion a la base de datos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo ticket</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <main>
        <h1>Nuevo ticket</h1>
        <p>Conta que paso y te damos una mano.</p>
        <?php if ($mensaje !== ''): ?>
            <p class="mensaje <?= $tipoMensaje ?>" role="status"><?= htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
        <form method="post">
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
            <label for="titulo">Titulo</label>
            <input id="titulo" name="titulo" maxlength="150" required>
            <label for="descripcion">Descripcion</label>
            <textarea id="descripcion" name="descripcion" rows="5" maxlength="5000" required></textarea>
            <button type="submit">Guardar ticket</button>
        </form>
    </main>
</body>
</html>
