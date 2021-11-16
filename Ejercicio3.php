<?php
//Datos de conexion
$servidor = 'localhost';
$usuario = 'root';
$clave = 'root';
$baseDeDatos = 'dws';

date_default_timezone_set('Europe/Madrid');
//Preàramos la coneccion y miramos si funciona.
$conexion = new mysqli($servidor, $usuario, $clave, $baseDeDatos);
if (mysqli_connect_error()) {
    die('Error de Conexion (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}
//Comprobamos si vienen datos por get
if (isset($_GET['idAlumno']) || isset($_GET['nombre']) || isset($_GET['nota'])) {
    //Recojemos los datos que vienen por get
    $idAlumno = filter_input(INPUT_GET, 'idAlumno', FILTER_SANITIZE_STRING);
    $nombre = filter_input(INPUT_GET, 'nombre', FILTER_SANITIZE_STRING);
    $nota = filter_input(INPUT_GET, 'nota', FILTER_SANITIZE_STRING);

    if ($idAlumno > 0) {
        if ($nombre != null) {
            if ($nota != null) {
                $sql_select = "SELECT * FROM alumnos 
                where idAlumno =" . $idAlumno . " and nombre='" . $nombre . "' and nota='" . $nota . "'";
            } else {
                $sql_select = "SELECT * FROM alumnos 
                where idAlumno =" . $idAlumno . " and nombre='" . $nombre . "'";
            }
        } else {
            if ($nota != null) {
                $sql_select = "SELECT * FROM alumnos 
                where idAlumno =" . $idAlumno . " and nota='" . $nota . "'";
            } else {
                $sql_select = "SELECT * FROM alumnos where idAlumno =" . $idAlumno;
            }
        }
    } else if ($idAlumno == 0) {
        if ($nombre != null) {
            if ($nota != null) {
                $sql_select = "SELECT * FROM alumnos 
                where nombre='" . $nombre . "' and nota='" . $nota . "'";
            } else {
                $sql_select = "SELECT * FROM alumnos 
                where nombre='" . $nombre . "'";
            }
        } else {
            if ($nota != null) {
                $sql_select = "SELECT * FROM alumnos 
                where nota='" . $nota . "'";
            } else {
                $sql_select = "SELECT * FROM alumnos";
            }
        }
    }
    $alumnos = $conexion->query($sql_select);
}

$conexion->close();
?>
<!doctype html>
<html lang="es">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <form action="Ejercicio3.php" method="get" name="alumnos">
        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    <label for="idAlumno">ID</label>
                    <input type="text" name="idAlumno" id="idAlumno" class="form-control">
                </div>
                <div class="col-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>
                <div class="col-6">
                    <label for="nota">Nota</label>
                    <input type="text" name="nota" id="nota" class="form-control">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-info">
                        Enviar
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <div class="row">
            <div class="col-12">
                
                        <?php
                        if ($alumnos->num_rows > 0) {
                            echo "<h1>Listado de alumnos</h1>";
                            echo '<table border="1" class="w-100">';
                            while ($alumno = $alumnos->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$alumno['idAlumno']."</td>";
                                echo "<td>".$alumno['nombre']."</td>";
                                echo "<td>". $alumno['nota']."</td>";
                                echo "</tr>";
                            }
                            echo '</table>';
                        }
                        ?>
                
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>