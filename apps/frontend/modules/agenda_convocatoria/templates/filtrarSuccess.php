<?php if ((count($eventos_imp) == 0) && (count($eventos_pro) == 0) && (count($eventos_500) == 0)): ?>
  <label>Ningun resultado encontrado en la busqueda!</label>
<?php else: ?>
  <label>Resultados encontrados:</label>
  <form id="form_agregar" action="guardarHistEventosChecked" method="POST">
    <div class="accordion" id="accordion">
      <?php if (count($eventos_imp) > 0) : ?>
        <?php include_partial('acordeon', array('id_acordeon' => '1', 'cabecera' => 'INTERRUPCIONES IMPREVISTAS', 'contenido' => $eventos_imp)) ?>
      <?php endif; ?>
      <?php if (count($eventos_pro) > 0) : ?>
        <?php include_partial('acordeon', array('id_acordeon' => '2', 'cabecera' => 'INTERRUPCIONES PROGRAMADAS', 'contenido' => $eventos_pro)) ?>
      <?php endif; ?>
      <?php if (count($eventos_500) > 0) : ?>
        <?php include_partial('acordeon', array('id_acordeon' => '3', 'cabecera' => 'INTERRUPCIONES CAUSAS 500', 'contenido' => $eventos_500)) ?>
      <?php endif; ?>
    </div>
    <button class="btn btn-small btn-primary" type="submit">Agregar eventos a mi sesión</button>
  </form>
<?php endif; ?>