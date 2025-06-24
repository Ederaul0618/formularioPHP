<?php
$host = "localhost";
$user = "root";
$pass = "abc.123.";
$dbname = "triage";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
