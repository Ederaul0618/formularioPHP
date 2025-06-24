<?php
$host = "localhost";
$user = "root";       # Cambia si usas otro usuario
$pass = "abc.123.";   # Agrega tu contraseña si aplica
$dbname = "triage";   # Asegúrate que esta base exista


$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
