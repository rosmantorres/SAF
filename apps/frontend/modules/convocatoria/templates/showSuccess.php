<h5 class="muted"><i class="icon-eye-open"></i> VISTA CONVOCATORIA </h5>

<br>
<i class="icon-info-sign"></i>
<small>
  <?php if ($convocatoria->getStatus() == 'ACTIVA'): ?>
    <?php echo "ESTA CONVOCATORIA ESTA ACTIVA" ?>
  <?php elseif ($convocatoria->getStatus() == 'EJECUCION'): ?>
    <?php echo "EN ESTOS MOMENTOS SE ESTA REALIZANDO EL COMITÉ DE ANÁLISIS DE FALLAS PARA DICHA CONVOCATORÍA" ?>
  <?php elseif ($convocatoria->getStatus() == 'TERMINADA'): ?>
    <?php echo "YA EL COMITÉ PARA ESTA CONVOCATORIA SE REALIZÓ" ?>
  <?php elseif ($convocatoria->getStatus() == 'SUSPENDIDA'): ?>
    <?php echo "CONVOCATORIA SUSPENDIDA. " . $convocatoria->getMotivoSuspencion() ?>
  <?php endif; ?>
</small>

<br><br>
<table width="100%">
  <tr valign="top" align="left">
    <td>
      <u><b>Asunto:</u></b>
      <?php echo $convocatoria->getAsunto() ?>
      <br>
      <u><b>Lugar:</u></b>&nbsp;&nbsp;
      <?php echo $convocatoria->getLugar() ?>
      <br>
      <u><b>Fecha:</u></b>&nbsp;
      <?php echo substr($convocatoria->getFecha(), 0, 10) . "  de " . 
              $convocatoria->getHoraIni(). " a " .$convocatoria->getHoraFin()?>
      <br><br>
      <u><b>Observaciones:</u></b><br>
      <?php echo $convocatoria->getObservacion() ?>
      <br>
    </td>
    <td width="260px">
      <small>        
        <u><b>Fecha de creación:</u></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo $convocatoria->getCreatedAt() ?>
        
        <u><b>Fecha de modificación:</u></b> &nbsp;
        <?php echo $convocatoria->getUpdatedAt() ?>
      </small>
    </td>
  </tr>
</table>

<br>
<?php include_partial('global/eventos', array('eventos' => $eventos, 'no_column_check' => true)) ?>

<br>
<i class="icon-arrow-left"></i> <a href="<?php echo url_for('@index_convocatoria') ?>">Regresar</a>
