<!DOCTYPE html> <!-- Declara el tipo de documento y el estándar HTML que se está utilizando -->
<html lang="es"> <!-- inicia  html> Contenedor principal del documento HTML y tienen un atributo de lang que es el idioma princial del docuemto -->
<head> <!--  inicia  el contiene información de todos los metodos ,como el título, el estilo, enlaces y metodos. -->
  <meta charset="UTF-8">
  <title>Sistema de Triaje Médico</title> <!-- metodo que que sirve para nombrar a la pestaña del navegador  -->
  <style> /* inicia y define el diseño visual de los elementos css */
    /** el body , h1 from, label , input, select, textarea*/
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      background: #f0f0f0;
    }
    h1 {
      color: #333;
      text-align: center;
    }
    form {
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      max-width: 700px;
      margin: auto;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    /*todo lo que comience con un punto (.) al incial es una clase se usa para aplicar el mismo estilo a muchos elementos  estilo a partes específicas del HTML*/
    .pregunta {
      margin-top: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid #ddd;
    }
    .respuestas {
      display: flex;
      gap: 20px;
      margin-top: 10px;
    }
    .respuestas label {
      font-weight: normal;
    }
    .btn-submit {
      margin-top: 25px;
      background: #28a745;
      color: white;
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
    }
    .btn-submit:hover {
      background: #218838;
    }
    /*todo lo que comience con un gato (#) al incial es para aplicar estilo a un solo elemento Es un ID CSS usado para un único elemento especial */
    #recomendacionFinal {
      margin-top: 25px;
      padding: 15px;
      font-size: 18px;
      font-weight: bold;
      border-radius: 8px;
      color: white;
      text-align: center;
      background-color: gray;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    small {
      display: block;
      text-align: center;
      margin-top: 10px;
      font-size: 11px;
      color: gray;
    }
  </style> <!-- termina y define el diseño visual de los elementos css -->

    <!-- Script con una función (método) -->
  <script>
    function mostrarMensaje() {
      alert("PDF Guardado correctamente.");
    }
  </script>

</head> <!-- Termina  el contiene información de todos los metodos ,como el título, el estilo, enlaces y metodos. -->

  <script>  //esta es una funcion combinando Javascript donde se hace un checkMedico con un logica de if 
    function checkMedico() {
    const medicoSelect = document.getElementById('medico');
    const otroMedicoInput = document.getElementById('otroMedico');

    if (medicoSelect.value === 'otro') {
      otroMedicoInput.style.display = 'block'; // Show the input field
      otroMedicoInput.setAttribute('required', 'required'); // Make it required
    } else {
      otroMedicoInput.style.display = 'none'; // Hide the input field
      otroMedicoInput.removeAttribute('required'); // Remove required attribute
      otroMedicoInput.value = ''; // Clear the input field
    }
  }
  
  </script>


<body> <!-- inicia el cuerpo del documento todo lo que el usuario va ver en la web es un elemento de html-->

  <h1>Sistema de Triaje Médico</h1> <!-- titulo principal -->

   <!-- FORMULARIO PRINCIPAL -->
  <form action="guardar.php" method="POST"> <!-- inicia el form: fromulario que son los campos que se enviaran al servidor -->

    <label for="nomina">Nómina</label> <!--label:Es una etiqueta de texto que describe el campo del formulario.
                                            for: Se enlaza con el campo <input> cuyo id sea nomina. Esto ayuda a la accesibilidad y usabilidad 
                                                 (al hacer clic en el texto, se selecciona el campo). -->

    <input type="text" id="nomina" name="nomina" required /> <!-- input: Crea un campo para que el usuario escriba  
                                                                   type: define que el campo de tipo texto
                                                                   id:Le da un identificador único al campo (relacionado con el label).
                                                                   name: Este es el nombre del dato que se enviará al servidor. En PHP lo recibes como $_POST['nomina']
                                                                   required: atributo booleano que marca el campo obligatoiro  -->

    <!-- Botón para buscar nomina en la base de afiliados -->
    <button type="button" id="btnBuscarNomina">Buscar</button>                                                               

    <label for="nombre">Nombre del paciente</label>
    <input type="text" id="nombre" name="nombre" required />

    <label for="cliente">Nombre del cliente</label>
    <input type="text" id="cliente" name="cliente" required />

    <label for="sexo">Sexo</label>
    <select id="sexo" name="sexo" required>
      <option value="">Seleccione...</option>
      <option value="Masculino">Masculino</option>
      <option value="Femenino">Femenino</option>
      <option value="Otro">Otro</option>
    </select>

    <label for="edad">Edad</label>
    <input type="number" id="edad" name="edad" required min="0" />

    <label for="medico">Médico que atendió</label>
    <input list="medicosList" id="medico" name="medico" required placeholder="Seleccione o escriba el nombre del médico">

    <datalist id="medicosList">
      <option value="KARLA GRACIELA ALVAREZ LOERA"></option>
      <option value="DIANA SOFIA RAMIREZ MARTINEZ"></option>
      <option value="PAULINA BANDA VERA"></option>
      <option value="AIDEE LOPEZ MARTINEZ"></option>
      <option value="MARTIN ROMUALDO OSNAYA"></option>
      <option value="SEBASTIAN BARRETO HERNANDEZ"></option>
    </datalist>

   <!-- <label for="medico">Médico que atendió</label>
    <select id="medico" name="medico" required onchange="checkMedico()">
      <option value="">Seleccione...</option>
      <option value="KARLA GRACIELA ALVAREZ LOERA">KARLA GRACIELA ALVAREZ LOERA</option>
      <option value="DIANA SOFIA RAMIREZ MARTINEZ">DIANA SOFIA RAMIREZ MARTINEZ</option>
      <option value="PAULINA BANDA VERA">PAULINA BANDA VERA</option>
      <option value="AIDEE LOPEZ MARTINEZ">AIDEE LOPEZ MARTINEZ</option>
      <option value="MARTIN ROMUALDO OSNAYA">MARTIN ROMUALDO OSNAYA</option>
      <option value="SEBASTIAN BARRETO HERNANDEZ">SEBASTIAN BARRETO HERNANDEZ</option>
      <option value="otro">Otro (especifique)</option>     
    </select>
    <input type="text" id="otroMedico" name="otro_medico" style="display: none;" placeholder="Ingrese el nombre del médico">  -->


<!--<label for="medico">Médico que atendió</label>
<input list="medicosList" id="medico" name="medico" required placeholder="Seleccione o escriba el nombre del médico">

<datalist id="medicosList">
  <option value="KARLA GRACIELA ALVAREZ LOERA"></option>
  <option value="DIANA SOFIA RAMIREZ MARTINEZ"></option>
  <option value="PAULINA BANDA VERA"></option>
  <option value="AIDEE LOPEZ MARTINEZ"></option>
  <option value="MARTIN ROMUALDO OSNAYA"></option>
  <option value="SEBASTIAN BARRETO HERNANDEZ"></option>
</datalist> "método proporciona una lista de sugerencias y permite al usuario escribir su propia entrada si ninguna coincide. Suele ser más intuitivo." -->


<!--<input type="text" id="medico" name="medico" required /> "este codigo es para igresar el nombre manual"-->

    <?php
     // Establecer la zona horaria correcta
     date_default_timezone_set('America/Mexico_City');

     // Obtener la fecha y hora actual
     $fecha_actual = date('Y-m-d\TH:i');
     ?>

    <label for="fecha">Fecha_hora</label>
    <input type="datetime-local" id="fecha" name="fecha" 
       value="<?php echo date('Y-m-d\TH:i'); ?>" readonly>
   
    
    <hr style="margin: 30px 0;" />

    <?php
      $preguntas = json_decode(file_get_contents("preguntas.json"), true);
      foreach ($preguntas as $i => $p) {
        echo '<div class="pregunta">';
        echo '<strong>' . ($i + 1) . '. ' . htmlspecialchars($p["texto"]) . '</strong>';
        echo '<div class="respuestas">';
        echo '<label><input type="radio" name="pregunta_' . $p["id"] . '" value="3" required> Sí</label>';
        echo '<label><input type="radio" name="pregunta_' . $p["id"] . '" value="0" required> No</label>';
        echo '<label><input type="radio" name="pregunta_' . $p["id"] . '" value="11" required> Incierto</label>';
        echo '</div></div>';

      // Mostrar campo de observaciones para preguntas 4 y 7 (índices 1 y 6)
      if ($i === 3 || $i === 6) {
       echo '<label for="observacion_' . $p["id"] . '">Observaciones para esta pregunta:</label>';
       echo '<textarea id="observacion_' . $p["id"] . '" name="observacion_' . $p["id"] . '" rows="2" placeholder="Ingrese detalles adicionales si es necesario..."></textarea>';
     }

       echo '</div>';
    }  
    ?>

    <label for="observaciones">Observaciones adicionales</label>
    <textarea id="observaciones" name="observaciones" rows="4" placeholder="Escriba aquí cualquier comentario sobre el paciente..."></textarea>

    <label for="Ingreso">Ingreso Hospitalario</label>
    <select id="Ingreso" name="Ingreso" required>
      <option value="">Seleccione...</option>
      <option value="Si">Si</option>
      <option value="NO">No</option>
    </select>

    <label for="hospital">Hospital que ingresa</label>
    <textarea id="hospital" name="hospital" rows="4" placeholder="Escriba aquí cualquier el hopsital donde ingresa paciente..."></textarea>


    <div id="recomendacionFinal">Recomendación Final</div>

    <button onclick= "mostrarMensaje()" class="btn-submit" type="submit" >Guardar y Descargar PDF</button>

    <small>Este reporte es confidencial y forma parte del expediente médico.</small>
    <small>Secretaría de Salud. (2018). Modelo de atención en salud a distancia... <br> https://cenetec-difusion.com/observatorio-telesalud/wp-content/uploads/2019/02/ContactCenter.pdf</small>
  
  </form> <!-- termina el form: fromulario que son los campos que se enviaran al servidor -->

  <script> /* inicia funcion o metodo que agrega un script en javascript*/
  
    const form = document.querySelector("form");
    const recomendacion = document.getElementById("recomendacionFinal");

    function actualizarMensaje(puntaje) {
      if (puntaje >= 20) {
        recomendacion.style.backgroundColor = "red";
        recomendacion.style.color = "white";
        recomendacion.innerText = "RECOMENDACIÓN FINAL: ATENCIÓN MÉDICA URGENTE. RIESGO ALTO (ROJO).";
      } else if (puntaje <= 13) {
        recomendacion.style.backgroundColor = "green";
        recomendacion.style.color = "white";
        recomendacion.innerText = "RECOMENDACIÓN FINAL: MONITOREO EN CASA. RIESGO BAJO (VERDE).";
      } else {
        recomendacion.style.backgroundColor = "yellow";
        recomendacion.style.color = "black";
        recomendacion.innerText = "RECOMENDACIÓN FINAL: EVALUACIÓN MÉDICA RECOMENDADA. RIESGO MODERADO (AMARILLO).";
      }
    }

    form.addEventListener("change", () => {
      let puntaje = 0;
      const respuestas = form.querySelectorAll("input[type=radio]:checked");
      respuestas.forEach(input => {
        
      // Si el valor es '11' (Incierto), suma 0 al puntaje. De lo contrario, suma el valor original.
      const valor = parseInt(input.value);
        //puntaje += parseInt(input.value);
        puntaje += (valor === 11) ? 0 : valor;
      });
      actualizarMensaje(puntaje);
    });
  </script> <!-- /* intermina funcion o metodo que agrega un script en javascript*/ -->

  <script> /* inicia funcion o metodo que agrega un script en javascript donde busca la nomina y se  hace un autocompletar vincualdo con mysqul*/

  function buscarNomina() {
    const nomina = document.getElementById("nomina").value.trim();
    if (nomina === "") {
      alert("Por favor, ingresa una nómina.");
      return;
    }

    fetch(`buscar_nomina.php?nomina=${encodeURIComponent(nomina)}`)
      .then(res => res.json())
      .then(data => {
        if (data.error) {
          alert(data.error);
          document.getElementById("nombre").value = "";
          document.getElementById("cliente").value = "";
          document.getElementById("sexo").value = "";
          document.getElementById("edad").value = "";
        } else {
          document.getElementById("nombre").value = data.nombre || "";
          document.getElementById("cliente").value = data.cliente || "";
          document.getElementById("sexo").value = data.sexo || "";
          document.getElementById("edad").value = data.edad || "";
        }
      })
      .catch(error => {
        console.error("Error al buscar nómina:", error);
        alert("Hubo un error al buscar la nómina.");
      });
  }

  // Ejecutar al salir del campo
  document.getElementById("nomina").addEventListener("blur", buscarNomina);

  // Ejecutar al dar clic en el botón
  document.getElementById("btnBuscarNomina").addEventListener("click", buscarNomina);
</script>

</body> <!-- termina el cuerpo del documento todo lo que el usuario va ver en la web -->


</html> <!-- termina el html> Contenedor principal del documento HTML -->