<?php
session_start();
extract ($_REQUEST);
if (!isset($_SESSION['user'])){
  header("location:../../index.php?x=1");//x=1 significa que no han iniciado sesión
}
require "../../Modelo/ConexionBasesDatos.php";
require "../../Modelo/Candidato.php";
$ced=$_GET['cedula'];

$clase = new Candidato;
$resultado=$clase->ConsultaCandidato($ced);             
    while($registro=$resultado->fetch_object())
{
    $nom = $registro->nombre;
    $ape = $registro->apellido;
    $cor = $registro->correo;
}
?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../Css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="../Css/Style.css">
    <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.css"> <!--Iconos-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="../Script/script.js" ></script>
    <title>Etapa 1</title>
  </head>
  <body background="../img/2.jpg">
    <header>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 mx-auto">
            <a class=" float-left" href="Consulta.php"><i class="n fas fa-arrow-circle-left fa-4x"></i></a>
            <a class=" float-right" href="../salir.php"><i class="n fas fa-sign-out-alt fa-4x"></i></a>
            <h1 class="text-center m-3" style="color:white;">Resultados Etapa 1</h1>            
          </div>
        </div>
      </div>
    </header>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-4">
          </div>
          <div class="col-4 tf" style="margin-bottom: 60px;">
                      <form action="../../Controlador/RegistrarEtapa1.php" method="POST">
                      <label>Nombre:</label>
                      <input type="Text" value="<?php echo $nom,'&nbsp;',$ape;?>" class="form-control" name="nombre" id="nombre" disabled>
                      <label>Correo:</label>
                      <input type="Text" value="<?php echo $cor;?>" class="form-control" name="correo" id="correo" disabled>
                      <label for="pteo">Calificación prueba teórica:</label>
                      <output id="outpteo" name="outpteo" for="pteo">0</output>
                      <input type="range" class="form-control" id="pteo" name="pteo" min="0" max="10" step="0.5" value="0" onchange="document.getElementById('outpteo').value=value">
                      <label for="ptec">Calificación prueba técnica:</label>
                      <output id="outptec" name="outptec" for="ptec">0</output>
                      <input type="range" class="form-control" id="ptec" name="ptec" min="0" max="10" step="0.5" value="0" onchange="document.getElementById('outptec').value=value">                    
                      <label>Comentarios:</label>
                      <textarea type="Text" class="form-control" name="com" id="com"></textarea>
                      <label>Nombre del evaluador:</label>
                      <input type="Text" class="form-control" id="nom_eva" name="nom_eva" required><br>
                      <button type="submint" class="btn btn-info btn-block" style="">Guardar</button>
                      <input type="text" value="<?php echo $ced;?>" class="form-control d-none" id="cedula" name="cedula">
        </div>
    </section>
    <footer>
      <div class="fixed-bottom bg-dark">
        <h5 class="tb">Todos los derechos reservados &copy. Prueba Para Devco (Nov-2021)</h5>
       </div>
    </footer>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>