<?php
// Conexión a la base de datos
include("conexion.php"); // aquí debes tener el archivo conexion.php con tu conexión

if (isset($_GET['nomina'])) {
    $nomina = $conn->real_escape_string($_GET['nomina']);
    $sql = "SELECT nombre, cliente, sexo, edad FROM afiliados WHERE nomina = '$nomina'";
    $resultado = $conn->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        echo json_encode($resultado->fetch_assoc());
    } else {
        echo json_encode(["error" => "No se encontró la nómina."]);
    }
} else {
    echo json_encode(["error" => "No se recibió la nómina."]);
}
?>
