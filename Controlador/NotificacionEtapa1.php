
<?php
session_start();
require 'vendor/autoload.php';
require "../Modelo/ConexionBasesDatos.php";
require "../Modelo/Candidato.php";

$ced = $_GET['cedula'];

$clase = new Candidato;
$resultado=$clase->ConsultaCandidato($ced);
      while($registro=$resultado->fetch_object())
{
    $nom = $registro->nombre;
    $ape = $registro->apellido;
    $cor = $registro->correo;
}
  
  use \Mailjet\Resources;

  $mj = new \Mailjet\Client('bb461087bf1469650013311d20a8df93','eb613da67ce3824d05ec59526296ca9b',true,['version' => 'v3.1']);
  $body = [
    'Messages' => [
      [
        'From' => [
          'Email' => "lifagis212@terasd.com",
          'Name' => "Prueba Devco"
        ],
        'To' => [
          [
            'Email' => "$cor",
            'Name' => "$nom $ape"
          ]
        ],
        'Subject' => "Notificación Preseleccionado",
        'TextPart' => "¡FELICIDAES!",
        'HTMLPart' => "Nos complace informarle que tu hoja de vida llego a nuestra base de datos de candidatos y han sido preseleccionados para continuar con el proceso de selección para algunas vacantes que tenemos de Ingeniero de Desarrollo.<br/>Adjunto a este correo te enviamos una Prueba teórica y técnica la cual tienes un plazo de 5 dias apartir de la fecha para resolverlo y enviarlo como respuesta a este mismo correo.<br />Mucha suerte y quedamos pendientes de tu respuesta. ",
        'CustomID' => "AppGettingStartedTest"
      ]
    ]
  ];
  $response = $mj->post(Resources::$Email, ['body' => $body]);
  $response->success() && var_dump($response->getData());  
  header("location:../Vista/Admin/Consulta.php?msj=4");
?>