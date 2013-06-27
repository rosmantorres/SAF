<h5 class="muted"><i class="icon-edit"></i> DESARROLLO DEL COMITÉ DE ANALISIS DE FALLAS </h5>

<br>
<div class="accordion" id="accordion">
  <?php $cont = 0 ?>
  <?php foreach ($eventos as $evento) : ?>
  
    <a href="desarrollarEvento?id=<?php echo $evento ?>"><i class="icon-pencil"></i> <small><b>Desarrollar</b></small></a>  <p></p>
    <?php $cabecera = "(" . ++$cont . ") RI. " . $evento->getCEventoD() . " en circuito " . $evento->getCircuito() . " con " . $evento->getMvaMin() . " MVAmin" ?>    
    <?php include_partial('global/acordeon', array('id_acordeon' => $cont, 'cabecera' => $cabecera, 'contenido' => $evento, 'sin_incluir_partial' => true)) ?>
    <br>
    
  <?php endforeach; ?>
</div>