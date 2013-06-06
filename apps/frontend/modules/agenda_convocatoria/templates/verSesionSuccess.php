<?php use_javascript('agenda_convocatoria.js') ?>

<h5 class="muted">
  <i class="icon-user"></i> EVENTOS EN MI SESIÓN .:: AGENDA ::.
</h5>

<?php if (count($eventos) > 0) : ?>
  <form id="form_agenda_guardar" action="<?php echo url_for('@guardar_agenda') ?>" method="POST">
    <label>Observaciones para la agenda:</label>
    <textarea name="observacion" class="input-block-level" rows="4"></textarea>
    <?php include_partial('eventos', array('eventos' => $eventos)) ?>
    <button class="btn btn-small btn-primary" type="submit">
      <i class="icon-briefcase"></i> GUARDAR AGENDA PARA LA CONVOCATORIA
    </button>
    <br><br>
    <i class="icon-arrow-left"></i> 
    <a href="<?php echo url_for('@nueva_agenda') ?>">
      Regresar
    </a>
  </form>
<?php else : ?>
  <i class="icon-info-sign"></i> 
  Hasta ahora no has guardado eventos a tu sesión!
  <a href="<?php echo url_for('@nueva_agenda') ?>">regresar</a>
<?php endif; ?>

