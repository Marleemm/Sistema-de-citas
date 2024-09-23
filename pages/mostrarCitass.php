<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link rel="shortcut icon" href="../assets/icono.webp" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Karla:ital,wght@0,200..800;1,200..800&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Overpass:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+FR+Moderne&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Karla:ital,wght@0,200..800;1,200..800&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Overpass:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+FR+Moderne&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="../styles/styleC.css">
    
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg  fixed-top" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand roboto-mono" href="#"><img src="../assets/Huma.svg" height="55px" alt="huma"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                       
                        <li class="nav-item roboto-mono ">
                            <a class="nav-link disabled text-dark" aria-disabled="true">¡Bienvenid@!</a>
                        </li>
                        <li class="nav-item roboto-mono ">
                            <a class="nav-link text-dark" href="mostrarCitass.php">Mostrar citas</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
    <section class="intro py-5 text-center container-fluid">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light text-white playwrite-fr-moderne">Citas registradas</h1>
                </div>
            </div>
        </section>
<!-- Tabla de citas -->
        <table >
        <thead>
            <tr>

                <th>Fecha</th>
                <th>Hora</th>
                <th>TIempo Restante</th>

            </tr>
        </thead>
        <br>
        <tbody>
            <?php

            include("../conexiones/conexion.php");
            session_start();

            $conexion = conectar();
            echo "<h3>Bienvenido, " . htmlspecialchars($_SESSION['nombre']) . "!</h3>";

            // echo  $_SESSION['nombre'];
            $consulta = "SELECT * FROM citas WHERE usuario_id = " . $_SESSION['usuario_id'];
            $resultado = mysqli_query($conexion, $consulta);
            // Asegúrate de establecer la zona horaria de tu sistema
            date_default_timezone_set('America/Mexico_City'); // Ajusta esto según tu zona horaria

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['fecha'] . "</td>";
                echo "<td>" . $fila['hora'] . "</td>";

                // Concatenar la fecha y hora de la cita
                $fechaHoraCita = $fila['fecha'] . ' ' . $fila['hora'];

                // Convertir la fecha y hora de la cita al formato DateTime, usando la zona horaria establecida
                $fechaHoraCita = DateTime::createFromFormat('Y-m-d H:i:s', $fechaHoraCita);

                // Obtener la fecha y hora actual en la misma zona horaria
                $fechaHoraActual = new DateTime('now', new DateTimeZone(date_default_timezone_get()));

                // Calcular la diferencia de tiempo entre la cita y la fecha actual
                if ($fechaHoraCita !== false) {
                    $intervalo = $fechaHoraActual->diff($fechaHoraCita);

                    // Mostrar tiempo restante en formato "Xh Ym"
                    if ($fechaHoraCita > $fechaHoraActual) {
                        echo "<td>" . $intervalo->format('%h') . "h " . $intervalo->format('%i') . "m</td>";
                    } else {
                        echo "<td>La cita ha pasado</td>";
                    }
                } else {
                    //echo "<td>Error en la fecha/hora</td>";
                }

                echo "</tr>";
            }

            ?>
        </tbody>
    </table>
    <a href="pagina.php" class="btn-volver">Volver</a>
    </main>
    
    <footer id="contacto">
        
        <h4 class="text-center text-body-secondary mt-5 mb-3">"San Andrés Cholula es un tesoro cultural lleno de historia y
            vida local."</h4>
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">

            <li class="nav-item">
                <a href="https://github.com/Marleemm" target="_blank" class="nav-link px-2 text-body-secondary">
                    <i class="bi bi-github fs-2"></i>
                </a>
            </li>

            <li class="nav-item">
                <a href="mailto:marlemmartinezc@gmail.com" target="_blank"
                    class="nav-link px-2 text-body-secondary fs-2">
                    <i class="bi bi-envelope"></i>
                </a>
            </li>


            <li class="nav-item">
                <a href="https://github.com/Hugo-Jesus-G" target="_blank" class="nav-link px-2 text-body-secondary">
                    <i class="bi bi-github fs-2 text-white"></i>
                </a>
            </li>

            <li class="nav-item">
                <a href="mailto:hugogcc19@gmail.com" target="_blank" class="nav-link px-2 text-body-secondary fs-2">
                    <i class="bi bi-envelope-open text-white"></i>
                </a>
            </li>

        </ul>

        <p class="text-center text-body-secondary ">©2024, HuMa</p>

    </footer>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>