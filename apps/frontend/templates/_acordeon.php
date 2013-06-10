<!-- 
 Elemento parcial - Acordeón Interno, el cual lleva el contenido
 Este acordeon interno se debe incluir en un cuerpo de acordeon, 
 <div class="accordion" id="accordion">
-->

<!-- ACORDEON INTERNO -->
<div class="accordion-group">
  
  <!-- CABECERA DEL ACORDEON -->
  <div class="accordion-heading">
    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $id_acordeon ?>">
      <?php echo $cabecera ?>
    </a>
  </div>
  
  <!-- CONTENIDO DEL ACORDEON -->
  <div id="<?php echo $id_acordeon ?>" class="accordion-body collapse">
    <div class="accordion-inner">
      <?php include_partial('global/eventos',array('eventos' => $contenido)) ?>
    </div>
  </div>
  
</div>