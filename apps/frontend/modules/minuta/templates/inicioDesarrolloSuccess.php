<div class="accordion" id="accordion">
  <?php $cont = 0 ?>
  <?php foreach ($eventos as $evento) : ?>
    <?php $cabecera = "(" . ++$cont . ") RI. " . $evento->getCEventoD() . " en circuito " . $evento->getCircuito() . " con " . $evento->getMvaMin() . " MVAmin" ?>
    <?php include_partial('global/acordeon', array('id_acordeon' => $cont, 'cabecera' => $cabecera, 'contenido' => $evento, 'sin_incluir_partial' => true)) ?>
  <?php endforeach; ?>
</div>