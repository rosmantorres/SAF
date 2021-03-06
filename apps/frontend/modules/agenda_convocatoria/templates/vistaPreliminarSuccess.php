<?php use_javascript('agenda_convocatoria.js') ?>

<?php slot('title', 'SAF .::Nueva agenda::.') ?>
<?php slot('menu_activo_agenda','active') ?>

<h5 class="muted">
  <i class="icon-user"></i> EVENTOS AGREGADOS A LA AGENDA
</h5>

<?php if (count($eventos) > 0) : ?>

  <form id="form_agenda_guardar" action="<?php echo url_for('@guardar_agenda') ?>" method="POST">
    
    Observaciones para la agenda:
    <textarea name="observacion" class="input-block-level" rows="4">AGENDA PARA LA CONVOCATORIA DE FECHA ???</textarea>
    
    <?php include_partial('global/eventos', array('eventos' => $eventos)) ?>
    
    <button class="btn btn-small btn-primary" type="submit">
      <i class="icon-briefcase"></i> GUARDAR AGENDA
    </button>
    
    <br><br>    
    <a href="<?php echo url_for('@nueva_agenda') ?>">
      <i class="icon-arrow-left"></i> Regresar
    </a>
    
  </form>

<?php else : ?>

  <i class="icon-info-sign"></i> Hasta ahora no has agregado ningún evento a la agenda!
  <a href="<?php echo url_for('@nueva_agenda') ?>">regresar</a>
  
<?php endif; ?>

