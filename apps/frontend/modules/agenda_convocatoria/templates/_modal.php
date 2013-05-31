<!-- Accion para disparar el modal -->
<!-- <a href="#id_modal" data-toggle="modal"> -->

<!-- Modal -->
<div id="<?php echo $evento->getCEventoD() ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">
      Interrupción <?php echo $evento->getCEventoD() ?>
    </h3>
  </div>
  <div class="modal-body">    
    <b><u>Fecha y hora de reparación: </u></b><?php echo $evento->getFHoraRep() ?>
    <hr> 
    <b>Nivel de sistema:<b><?php echo $evento->getCodNivel() ?>
    <h5>Kva Interrumpidos:</h5><?php echo $evento->getKvaInt() ?>    
    <h5>Operador:</h5><?php echo $evento->getOperador() ?>
    <h5>Cuadrilla</h5><?php echo $evento->getCuadrilla() ?>
    <h5>Climatología</h5><?php echo $evento->getClimatologia() ?>
    <h5>Numero de reporte operacional</h5><?php echo $evento->getNumRoe() ?>
    <h5>Programador Parada</h5><?php echo $evento->getProgramador() ?>
    <h5>Operador Responsable Parada</h5><?php echo $evento->getOperadorResp() ?>
    <hr>
    <h5>Averia:</h5><?php echo $evento->getNumAveria() ?>
    <p><?php echo $evento->getDescAveria() ?></p>            
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>