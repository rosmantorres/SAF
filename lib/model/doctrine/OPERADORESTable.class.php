<?php

/**
 * OPERADORESTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class OPERADORESTable extends Doctrine_Table
{

  /**
   * Returns an instance of this class.
   *
   * @return object OPERADORESTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('OPERADORES');
  }

  /**
   * Método que retorna un array de operadores (programador y operador_responsable)
   * 
   * @param integer $num_proposicion
   * @return array
   */
  public function getOperadores($num_proposicion)
  {
    $hist_proposicion = Doctrine_Core::getTable('HIST_PROPOSICIONES')
            ->getHistProposicion($num_proposicion);

    $operadores = array();

    if ($hist_proposicion)
    {
      array_push($operadores, $this->find($hist_proposicion->getOperCodOperadorAsig()));
      array_push($operadores, $this->find($hist_proposicion->getOperCodOperadorResp()));
    }

    return $operadores;
  }

}