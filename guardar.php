<?php
require_once 'conexion.php'; // Conecta con la base de datos
require_once 'dompdf/autoload.inc.php'; // Carga la librería Dompdf

use Dompdf\Dompdf;

// 1. Recibir los datos del formulario enviados por POST
$nomina = $_POST['nomina'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$cliente = $_POST['cliente'] ?? '';
$sexo = $_POST['sexo'] ?? '';
$edad = $_POST['edad'] ?? '';
$medico = $_POST['medico'] ?? '';
$fecha = $_POST ['fecha'] ??'';
$Ingreso = $_POST['Ingreso'] ?? '';
$hospital = $_POST['hospital'] ?? '';
$observaciones = $_POST['observaciones'] ?? '';
$observacion_q2 = $_POST['observacion_q2'] ?? '';


// 2. Leer las preguntas desde el archivo JSON
$preguntas = json_decode(file_get_contents("preguntas.json"), true);

// 3. Calcular el puntaje total y preparar las respuestas individuales
$puntaje = 0;
$respuestas = [];           // Para mostrar en el PDF
$valores_preguntas = [];    // Para guardar en MySQL por columna

$observaciones_4 = '';
$observaciones_7 = '';

foreach ($preguntas as $pregunta) {
    $id = $pregunta["id"];
    $key = "pregunta_$id";
    
    // *** CAMBIO AQUÍ: NEUTRALIZA -1 PARA EL PUNTAJE ***
     // Asegurarse de que el valor sea un entero. Puede ser 3, 0 o -1.
    $valor = isset($_POST[$key]) ? intval($_POST[$key]) : 0;
    
    // Si el valor es 11 (Incierto), súmale 0 al puntaje. De lo contrario, súmale el valor original.
    $puntaje += ($valor == 11) ? 0 : $valor;    
    //$puntaje += $valor;

     // ✅ Guardamos observaciones específicas
    $observacion = "";
    if ($id == 4) {
        $observaciones_4 = $_POST["observacion_4"] ?? "";
        $observacion = $observaciones_4;
    } elseif ($id == 7) {
        $observaciones_7 = $_POST["observacion_7"] ?? "";
        $observacion = $observaciones_7;
    }

    //Guardamos tanto el texto como la respuesta para el PDF
   // Guardamos tanto el texto como la respuesta para el PDF
    $respuesta_texto = "N/A"; // Default
    if ($valor == 3) {
        $respuesta_texto = "Sí";
    } elseif ($valor == 0) {
        $respuesta_texto = "No";
    } elseif ($valor == 11) { // New condition for Incierto
        $respuesta_texto = "Incierto";
    }

    $respuestas[] = [
        "pregunta" => $pregunta["texto"],
        "respuesta" => $respuesta_texto,
        "observacion" => $observacion
 
    /*$respuestas[] = [
        "pregunta" => $pregunta["texto"],
        "respuesta" => ($valor == 3) ? "Sí" : (($valor == 0) ? "No o Incierto" : "N/A"),
        "observacion" => $observacion*/
    ];
    // Guardamos el valor numérico para cada pregunta (3, 0 o -1) en la base de datos
    // Este valor sí será -1 en la BD para Incierto, lo cual es útil si alguna vez
    // necesitas un reporte que distinga entre "No" e "Incierto" directamente de la BD.
    $valores_preguntas[] = $valor;
}

// 4. Guardar todo en la tabla 'registros', incluyendo las 9 respuestas individuales
$stmt = $conn->prepare("INSERT INTO registros 
    (nomina, nombre, cliente, sexo, edad, medico, puntaje, fecha, Ingreso, hospital, observaciones, observaciones_4, observaciones_7,
     pregunta_1, pregunta_2, pregunta_3, pregunta_4, pregunta_5,
     pregunta_6, pregunta_7, pregunta_8, pregunta_9)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// 5. Asociar las variables al statement
$stmt->bind_param(
    "ssssssissssssiiiiiiiii",
    $nomina,
    $nombre,
    $cliente,
    $sexo,
    $edad,
    $medico,
    $puntaje,
    $fecha,
    $Ingreso,
    $hospital,
    $observaciones,
    $observaciones_4,
    $observaciones_7,
    $valores_preguntas[0],
    $valores_preguntas[1],
    $valores_preguntas[2],
    $valores_preguntas[3],
    $valores_preguntas[4],
    $valores_preguntas[5],
    $valores_preguntas[6],
    $valores_preguntas[7],
    $valores_preguntas[8]
);
$stmt->execute();
$stmt->close();

// 6. Generar el HTML del PDF a partir de la plantilla
ob_start();
include 'pdf_template.php';
$html = ob_get_clean();

// 7. Crear el PDF con Dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// NUEVO: Guardar PDF en el servidor (máquina local con XAMPP)
$output = $dompdf->output();
$nombreArchivo = "triage_$nomina.pdf";
$rutaArchivo = __DIR__ . "/pdfs/$nombreArchivo"; // Guarda en la carpeta 'pdfs'

// Crear la carpeta si no existe
if (!file_exists(__DIR__ . "/pdfs")) {
    mkdir(__DIR__ . "/pdfs", 0777, true);
}

// Guardar archivo localmente
file_put_contents($rutaArchivo, $output);

// 8. Descargar el PDF en la máquina del usuario
$dompdf->stream($nombreArchivo, ["Attachment" => true]);
exit;

// 8. Forzar la descarga del PDF generado
/*$dompdf->stream("triage_$nomina.pdf", ["Attachment" => true]);
exit; */
?>