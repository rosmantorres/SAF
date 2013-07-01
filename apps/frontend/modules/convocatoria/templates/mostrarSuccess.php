<?php use_javascript('convocatoria.js') ?>

<?php slot('title', 'SAF .::Vista Convocatoria::.') ?>
<?php slot('menu_activo_convocatoria','active') ?>

<h5 class="muted"><i class="icon-eye-open"></i> VISTA CONVOCATORIA  N° <?php echo $convocatoria->getId() ?> </h5>

<br>
<small><i class="icon-info-sign"></i> 
  <?php if ($convocatoria->getStatus() == 'ACTIVA'): ?>
    La convocatoria esta <b style="color: green">ACTIVA</b> para 
    <a href="<?php echo url_for('@cambiar_status_convocatoria?id=' . $convocatoria . '&status=EJECUCION') ?>" id="realizar_comite"> 
      <i class="icon-edit"></i> realizar el comité  
    </a> 
    en la fecha indicada.
  <?php elseif ($convocatoria->getStatus() == 'EJECUCION'): ?>
    La convocatoria esta en <b style="color: #149bdf">EJECUCIÓN</b>. Se esta realizando el comité.
  <?php elseif ($convocatoria->getStatus() == 'TERMINADA'): ?>
    La convocatoria esta <b>TERMINADA</b>. Comité realizado exitosamente.
  <?php elseif ($convocatoria->getStatus() == 'SUSPENDIDA'): ?>
    La convocatoria esta <b style="color: red">SUSPENDIDA</b>.
    <?php echo $convocatoria->getMotivoSuspencion() ?>
  <?php endif; ?>
</small>

<br><br>
<table width="100%">
  <tr valign="top">
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
    </td>
    <td width="260px">      
      <small>   
        <?php if ($convocatoria->getStatus() == 'ACTIVA') : ?> 
          <i class="icon-warning-sign"></i><b> Suspender </b>
          <input type="checkbox" id="suspender_convocatoria" value="<?php echo url_for('@cambiar_status_convocatoria?id=' . $convocatoria->getId() . '&status=SUSPENDIDA') ?>" />
          <br>
        <?php endif; ?>
        
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
<a href="<?php echo url_for('@index_convocatoria') ?>">
  <i class="icon-arrow-left"></i> Regresar
</a>
