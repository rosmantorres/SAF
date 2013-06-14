<?php use_javascript('convocatoria.js') ?>

<?php slot('title', 'SAF .::Nueva convocatoria::.') ?>
<?php slot('menu_activo_convocatoria','active') ?>

<h5 class="muted">
  <i class="icon-user"></i> EVENTOS AGREGADOS EN LA CONVOCATORIA
</h5>

<br>
<?php if (count($eventos) > 0) : ?>

  <form id="form_guardar_convocatoria" action="<?php echo url_for('@guardar_convocatoria') ?>" method="POST">    
    Fecha de la convocatoria:<br>
    <input name="f_convoca" class="input-medium" type="date" required />
    <input name="h_ini_convoca" class="input-medium" type="time" value="09:00" required />
    <input name="h_fin_convoca" class="input-medium" type="time" value="11:59" required />

    <br>
    Asunto:<br>
    <input name="asunto_convoca" class="input-xxlarge" type="text" 
           value="Convocatoria de Reunión de Análisis de Fallas en la Red de Distribución" required />

    <br>
    Lugar:<br>
    <input name="lugar_convoca" class="input-xxlarge" type="text" 
           value="Centro de Operaciones Santa Rosa. Piso 3. Ala Oeste" required />

    <br>
    Observacion:<br>
    <textarea name="observacion_convoca" class="input-block-level" rows="4" 
              placeholder="...indique aquí las observaciones de la convocatoria"></textarea>
    
    <br>
    <?php include_partial('global/eventos', array('eventos' => $eventos)) ?>
    
    <button class="btn btn-small btn-primary" type="submit">
      <i class="icon-briefcase"></i> GUARDAR CONVOCATORIA
    </button>
    
    <br><br>
    <i class="icon-arrow-left"></i> 
    <a href="<?php echo url_for('@nueva_convocatoria') ?>">
      Regresar
    </a>    
  </form>

<?php else : ?>

  <i class="icon-info-sign"></i> Hasta ahora no has agregado ningún evento a la convocatoria!
  <a href="<?php echo url_for('@nueva_convocatoria') ?>">regresar</a>
  
<?php endif; ?>