<?php


include "../conexiones/conexion.php";
$conexion = conectar();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

$id_usuario = $_SESSION['usuario_id'];

if (isset($_POST['enviar-cita'])) {
    if (!empty($_POST['fecha']) && !empty($_POST['hora'])) {
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];

        $consulta = "INSERT INTO citas (`id`,`usuario_id`, `fecha`, `hora`) VALUES (NULL,'$id_usuario', '$fecha', '$hora')";
        
        if (mysqli_query($conexion, $consulta)) {
            $_SESSION['mensaje'] = "Cita registrada con éxito"; // Guarda el mensaje en la sesión
        } else {
            $_SESSION['mensaje'] = "Error al registrar la cita: " . mysqli_error($conexion);
        }
    } else {
        $_SESSION['mensaje'] = "Todos los campos son obligatorios.";
    }
    mysqli_close($conexion);


}
