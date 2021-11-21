<?php
session_start();
require 'vendor/autoload.php';
require "../Modelo/ConexionBasesDatos.php";
require "../Modelo/Candidato.php";

$clase = new Candidato;
$resultado=$clase->ConsultaCandidato($_GET['cedula']);
      while($registro=$resultado->fetch_object())
{
    $nom = $registro->nombre;
    $ape = $registro->apellido;
    $cor = $registro->correo;
}
  
  use \Mailjet\Resources;

  $mj = new \Mailjet\Client('9a488e483468e294f5f4f5c3dc020463','5b1112471f222cf35c0255d394d95f88',true,['version' => 'v3.1']);
  $body = [
    'Messages' => [
      [
        'From' => [
          'Email' => "witicof691@nefacility.com",
          'Name' => "Prueva Devco"
        ],
        'To' => [
          [
            'Email' => "$cor",
            'Name' => "$nom $ape"
          ]
        ],
        'Subject' => "Notificación de selección",
        'TextPart' => "¡FELICIDAES!",
        'HTMLPart' => "<h3>Nos complace informarte que has superado satisfactoriamente el proceso de selección.</h3><br/>Adjunto a este correo te enviamos copia del contrato el cual debe imprimir en formato carta, firmarlo y enviarlo escaneado en formato PDF mas tardar el dia de mañana.",
        'CustomID' => "AppGettingStartedTest"
      ]
    ]
  ];
  $response = $mj->post(Resources::$Email, ['body' => $body]);
  $response->success() && var_dump($response->getData());
  header("location:../Vista/Admin/Consulta.php?msj=1");
?>