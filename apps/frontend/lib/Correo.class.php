<?php

class Correo extends Swift_Message
{
  public function __construct($asunto, $msj)
  {
    parent::__construct($asunto, $msj);
 
    $this
      ->setFrom(array(sfConfig::get('app_correo_envio') => 'SISTEMA DE ANALISIS DE FALLAS (SAF)'));
  }
  
  public function enviarATodos()
  {
    $usuarios = Doctrine_Core::getTable('SAF_UNIDAD_EQUIPO')->findAll();
    
    $lista_de_correos = array();
    
    foreach ($usuarios as $usuario)
    {
      array_push($lista_de_correos, $usuario->getCorreo());
    }
    
    $this->setTo($lista_de_correos);
  }
  
  public function enviarA($unidad)
  {
    $und = Doctrine_Core::getTable('SAF_UNIDAD_EQUIPO')->findOneByNombre($unidad);
    $this->setTo($und->getCorreo());
  }
  
}