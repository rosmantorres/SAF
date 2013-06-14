<?php use_javascript('agenda_convocatoria.js') ?>

<?php slot('title', 'SAF .::Vista Agenda::.') ?>
<?php slot('menu_activo_agenda','active') ?>

<h5 class="muted">
  <i class="icon-eye-open"></i> VISTA AGENDA N° <?php echo $agenda->getId() ?>
</h5>

<br>
<table width="100%">
  <tr valign="top" align="left">
    <td>
      <u><b>Observaciones:</u></b><br>
      <?php echo $agenda->getObservacion() ?>
    </td>
    <td width="260px">
      <small>
        <i class="icon-flag"></i><b> Agenda Pendiente </b>
        <input type="checkbox" id="agenda_pendiente" value="<?php echo url_for('@colocar_pendiente_agenda?id='.$agenda->getId()) ?>" />
        
        <br>
        <u><b>Fecha de creación:</u></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <?php echo $agenda->getCreatedAt() ?>
        
        <u><b>Fecha de modificación:</u></b> &nbsp;
        <?php echo $agenda->getUpdatedAt() ?>
      </small>
    </td>
  </tr>
</table>

<br>
<?php include_partial('global/eventos', array('eventos' => $eventos, 'no_column_check' => true)) ?>

<br>
<i class="icon-arrow-left"></i> <a href="<?php echo url_for('@index_agenda') ?>">Regresar</a>
