<!-- 
 Elemento parcial que se encarga de mostrar un evento con los datos secundarios. 
 Este se dispara con un <a href="#id_modal" data-toggle="modal">
-->

<!-- Modal -->
<div id="<?php echo $evento->getCEventoD() ?>" class="modal hide fade" 
     tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Interrupción <?php echo $evento->getCEventoD() ?></h3>    
  </div>

  <div class="modal-body">
    <pre>
Fecha de reparación: <?php echo $evento->getFHoraRep() ?>
    </pre>    

    <pre>
Número de ROE: <?php echo $evento->getNumRoe() ?>                Climatologia: <?php echo $evento->getClimatologia() ?> 
Nivel de sistema: <?php echo $evento->getCodNivel() ?>             Operador:     <?php echo $evento->getOperador() ?> 
Kva Interrumpidos: <?php echo $evento->getKvaInt() ?>         Cuadrilla:    <?php echo $evento->getCuadrilla() ?>
    </pre>          

    <pre>
Programador Parada:   <?php echo $evento->getProgramador() ?> 
Operador resp Parada: <?php echo $evento->getOperadorResp() ?>
    </pre>

    <pre>
Averia: <?php echo $evento->getNumAveria() ?>
    </pre>

    <pre>
<?php echo $evento->getDescAveria() ?>
    </pre>                 
  </div>  

  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
  </div>

</div>