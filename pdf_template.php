<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>PDF Triaje</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    .titulo { color: #0066CC; font-size: 24px; text-align: center; }
    .seccion { margin-bottom: 20px; }
    .pregunta { margin-top: 10px; }
    label { margin-right: 15px; }
    input[type="radio"] { pointer-events: none; }
  </style>
</head>

<body>
 <h1>Sistema de Triaje Médico</h1>
<div class="seccion">
  <p><strong>Nombre del paciente:</strong> <?= htmlspecialchars($nombre) ?></p>
  <p><strong>Nombre del cliente:</strong> <?= htmlspecialchars($cliente) ?></p>
  <p><strong>Nómina:</strong> <?= htmlspecialchars($nomina) ?></p>
  <p><strong>Sexo:</strong> <?= htmlspecialchars($sexo) ?> | <strong>Edad:</strong> <?= htmlspecialchars($edad) ?></p>
  <p><strong>Médico:</strong> <?= htmlspecialchars($medico) ?></p>

      <?php
     // Establecer la zona horaria correcta
     date_default_timezone_set('America/Mexico_City');
     ?>
  <p><strong>Fecha:</strong> <?= date('Y-m-d h:i a', strtotime($fecha)) ?></p>
</div>

<div class="seccion">
  <h3>Respuestas del cuestionario</h3>
  <?php foreach ($respuestas as $i => $r): ?>
    <div class="pregunta">
      <p><?= ($i + 1) . ". " . htmlspecialchars($r["pregunta"]) ?></p>

      <label>
        <input type="radio" name="respuesta_<?= $i ?>" value="Sí" <?= (trim(strtolower($r["respuesta"])) == "sí") ? "checked" : "" ?>> Sí
      </label>

      <label>
        <input type="radio" name="respuesta_<?= $i ?>" value="No" <?= (trim(strtolower($r["respuesta"])) == "no") ? "checked" : "" ?>> No
      </label>

      <label>
        <input type="radio" name="respuesta_<?= $i ?>" value="Incierto" <?= (trim(strtolower($r["respuesta"])) == "incierto") ? "checked" : "" ?>> Incierto

      </label>
      <?php
      // Mostrar observaciones solo para preguntas 4 (índice 3) y 7 (índice 6)
      if (($i === 3 || $i === 6) && isset($r['observacion']) && trim($r['observacion']) !== ''):
    ?>
      <p><strong>Observación:</strong> <?= nl2br(htmlspecialchars($r['observacion'])) ?></p>
    <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div>

<div class="seccion">
  <h3>Observaciones del médico</h3>
  <p><?= ($observaciones && trim($observaciones) !== "") ? nl2br(htmlspecialchars($observaciones)) : "Sin observaciones registradas." ?></p>

  <p><strong>Ingreso:</strong> <?= htmlspecialchars($Ingreso) ?></p>
  
  <p><strong>hospital:</strong> <?= htmlspecialchars($hospital) ?></p>  

</div>


<?php
  # Recomendación Final
  if ($puntaje >= 20) {
    $colorFondo = '#FF0000';
    $colorTexto = '#FFFFFF';
    $texto = 'RECOMENDACIÓN FINAL:ATENCIÓN MÉDICA URGENTE. RIESGO ALTO (ROJO).';
  } elseif ($puntaje <= 13) {
    $colorFondo = '#008000';
    $colorTexto = '#FFFFFF';
    $texto = 'RECOMENDACIÓN FINAL:MONITOREO EN CASA. RIESGO BAJO (VERDE).';
  } else {
    $colorFondo = '#FFFF00';
    $colorTexto = '#000000';
    $texto = 'RECOMENDACIÓN FINAL:EVALUACIÓN MÉDICA RECOMENDADA. RIESGO MODERADO (AMARILLO).';
  }
?>

<!-- Recuadro visual para la recomendación final -->
<div style="
  background-color: <?= $colorFondo ?>;
  color: <?= $colorTexto ?>;
  padding: 15px 25px;
  font-size: 18px;
  font-weight: bold;
  border-radius: 8px;
  margin-bottom: 20px;
  text-align: center;
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
">
  <?= $texto ?>
</div>

<p style="text-align:center; font-size:10px; color:gray;">
  Este reporte es confidencial y forma parte del expediente médico.
</p>
<p style="text-align:center; font-size:10px; color:gray;">
  Secretaría de Salud. (2018). MODELO DE ATENCION EN SALUD A DISTANCIA POR MEDIO DE UN CENTRO DE CONTACTO.
  En Secretaría de Salud pag.26. https://cenetec-difusion.com/observatorio-telesalud/wp-content/uploads/2019/02/ContactCenter.pdf
</p>

</body>
</html>