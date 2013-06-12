<?php slot('title', 'SAF .::Nueva agenda::.') ?>

<?php if ((count($eventos_imp) == 0) && (count($eventos_pro) == 0) && (count($eventos_500) == 0)): ?>
  <i class="icon-info-sign"></i> Ningun resultado encontrado en la busqueda!
<?php else: ?>
  Resultados encontrados:
  <form id="form_agregar_eventos_sesion" action="<?php echo url_for('@agregar_eventos_agenda') ?>" method="POST">
    <div class="accordion" id="accordion">
      <?php if (count($eventos_imp) > 0) : ?>
        <?php include_partial('global/acordeon', array('id_acordeon' => '1', 'cabecera' => 'INTERRUPCIONES IMPREVISTAS', 'contenido' => $eventos_imp)) ?>
      <?php endif; ?>
      <?php if (count($eventos_pro) > 0) : ?>
        <?php include_partial('global/acordeon', array('id_acordeon' => '2', 'cabecera' => 'INTERRUPCIONES PROGRAMADAS', 'contenido' => $eventos_pro)) ?>
      <?php endif; ?>
      <?php if (count($eventos_500) > 0) : ?>
        <?php include_partial('global/acordeon', array('id_acordeon' => '3', 'cabecera' => 'INTERRUPCIONES CAUSAS 500', 'contenido' => $eventos_500)) ?>
      <?php endif; ?>
    </div>
    <button class="btn btn-small btn-primary" type="submit">
      <i class="icon-plus"></i> Agregar eventos a la agenda
    </button>
  </form>
<?php endif; ?>