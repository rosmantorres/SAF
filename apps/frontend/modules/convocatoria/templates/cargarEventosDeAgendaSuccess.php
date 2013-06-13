<?php if (count($agenda) > 0) :?>

  <table width="100%">
    <tr valign="top" align="left">
      <td>
        <u><b>Observaciones:</u></b><br>
        <?php echo $agenda->getObservacion() ?>
      </td>
      <td width="260px">
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
  <form id="form_agregar_eventos_convocatoria" action="<?php echo url_for('@agregar_eventos_convocatoria') ?>" method="POST">
    
    <?php include_partial('global/eventos', array('eventos' => $eventos)) ?>
    
    <button class="btn btn-small btn-primary" type="submit">
      <i class="icon-plus"></i> Agregar eventos a la convocatoria
    </button>
    
  </form>  
  
<?php endif; ?>