<h5 class="muted"><i class="icon-eye-open"></i> VISTA AGENDA </h5>

<br>
<table width="100%">
  <tr valign="top" align="left">
    <td>
      <u><b>Observacion:</u></b><br>
      <?php echo $agenda->getObservacion() ?>
    </td>
    <td width="28%">
      <small>
        <u><b>Fechas de creación:</u></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <?php echo $agenda->getCreatedAt() ?>
        
        <u><b>Fecha de modificación:</u></b> &nbsp;
        <?php echo $agenda->getUpdatedAt() ?>
      </small>
    </td>
  </tr>
</table>

<br>
<?php include_partial('eventos', array('eventos' => $eventos, 'no_column_check' => true)) ?>

<br>
<i class="icon-arrow-left"></i> <a href="<?php echo url_for('@index_agenda') ?>">Regresar</a>
