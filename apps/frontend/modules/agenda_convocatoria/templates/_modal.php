<!-- Accion para disparar el modal -->
<!-- <a href="#id_modal" data-toggle="modal"> -->

<!-- Modal -->
<div id="<?php echo $evento->getCEventoD() ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Interrupción <?php echo $evento->getCEventoD() ?></h3>    
  </div>

  <div class="modal-body">
    <table class="table table-bordered" width="100%">
      <tr><td colspan="2"><b>Fecha de reparación:</b> <?php echo $evento->getFHoraRep() ?></td></tr>
      <tr>
        <td>          
          <b><u>Número de ROE:</u></b> <?php echo $evento->getNumRoe() ?><br>
          <b><u>Nivel de sistema:</u></b> <?php echo $evento->getCodNivel() ?><br>
          <b><u>Kva Interrumpidos:</u></b> <?php echo $evento->getKvaInt() ?></td>
        <td>
          <b><u>Climatologia:</u></b> <?php echo $evento->getClimatologia() ?><br>
          <b><u>Operador:</u></b> <?php echo $evento->getOperador() ?><br>          
          <b><u>Cuadrilla:</u></b> &nbsp;<?php echo $evento->getCuadrilla() ?><br>          
        </td>
      </tr>
    </table>
    <hr>
    <b><u>Programador Parada:</u></b> &nbsp;&nbsp;&nbsp;<?php echo $evento->getProgramador() ?><br>
    <b><u>Operador resp Parada:</u></b> <?php echo $evento->getOperadorResp() ?>
    <hr>
    <b><u>Averia:</u></b> <?php echo $evento->getNumAveria() ?>
    <p><?php echo $evento->getDescAveria() ?></p>            
  </div>  

  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
  </div>

</div>