<?php if ((count($eventos_imp) == 0) && (count($eventos_pro) == 0) && (count($eventos_500) == 0)): ?>
  <label>Ningun resultado encontrado en la busqueda!</label>
<?php else: ?>
  
  <label>Resultados encontrados:</label>

  <?php if (count($eventos_imp) > 0) : ?>
    <div class="accordion" id="accordion">
      <?php include_partial('acordeon', array('id_acordeon' => '1', 'cabecera' => 'INTERRUPCIONES IMPREVISTAS', 'contenido' => $eventos_imp)) ?>  
    </div>
  <?php endif; ?>
  
  <?php if (count($eventos_pro) > 0) : ?>
    <div class="accordion" id="accordion">
      <?php include_partial('acordeon', array('id_acordeon' => '2', 'cabecera' => 'INTERRUPCIONES PROGRAMADAS', 'contenido' => $eventos_pro)) ?>
    </div>
  <?php endif; ?>
  
  <?php if (count($eventos_500) > 0) : ?>
    <div class="accordion" id="accordion">
      <?php include_partial('acordeon', array('id_acordeon' => '3', 'cabecera' => 'INTERRUPCIONES CAUSAS 500', 'contenido' => $eventos_500)) ?>  
    </div>
  <?php endif; ?>
  
<?php endif; ?>