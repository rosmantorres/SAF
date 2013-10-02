<!-- 
 Elemento parcial que se encarga de mostrar un evento con los datos secundarios. 
 Este se dispara con un <a href="#id_modal" data-toggle="modal">
-->

<!-- Modal -->
<div id="<?php echo $resultset[$i]['ID_COMP'] ?>" class="modal hide fade" 
     tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>    
    <h6>          
      <p align="center">      
        <?php echo 'RI. ' . $resultset[$i]['RI'] . '. ' . $resultset[$i]['CIRCUITO'] . '. ' . strftime("%A, %d de %B de %Y", strtotime($resultset[$i]['FECHA_CASO'])) ?> 
        <br>
      <u>(Estimación para cumplir con el compromiso:</u>
      <?php echo utf8_encode(strftime("%A, %d de %B de %Y", strtotime($resultset[$i]['F_DURACION_EST']))) ?>)
      <br><br>
      <?php echo $resultset[$i]['DESC_COMP'] ?>
      </p>
    </h6>           
  </div>

  <form id="" action="<?php echo url_for('@registrar_acciones_compromisos?id_comp=' . $resultset[$i]['ID_COMP']) ?>" method="POST">
    <div class="modal-body"> 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
      <?php if ($resultset[$i]['STATUS_COMP'] != 'PENDIENTE' && $sf_user->hasCompromiso($resultset[$i]['ID_COMP'])): ?>
        <textarea name="acciones" rows="10" class="span5" disabled><?php echo $resultset[$i]['ACCIONES'] ?></textarea>         
      <?php elseif ($resultset[$i]['STATUS_COMP'] == 'PENDIENTE' && $sf_user->hasCompromiso($resultset[$i]['ID_COMP'])): ?>
        <textarea name="acciones" rows="10" class="span5" placeholder="... indique las acciones" ><?php echo $resultset[$i]['ACCIONES'] ?></textarea> 
        <abbr title="Se termina el proceso de edición y se espera respuesta de IO">
          <label class="checkbox">
            <input type="checkbox" name="confirmar_comp"><h6> Por confirmar</h6>
          </label>
        </abbr>
      <?php elseif ($resultset[$i]['STATUS_COMP'] == 'CONFIRMACION' && !$sf_user->hasCompromiso($resultset[$i]['ID_COMP'])): ?>
        <textarea name="acciones" rows="10" class="span5" placeholder="... indique las acciones" ><?php echo $resultset[$i]['ACCIONES'] ?></textarea>         
        <label class="radio">
          <input type="radio" name="confirmar_comp" id="aprobar_comp" value="aprobado"><h6>Aprobado</h6>
        </label>
        <label class="radio">
          <input type="radio" name="confirmar_comp" id="desaprobar_comp" value="desaprobado"><h6>Volver a Análizar</h6>
        </label>
      <?php elseif ($resultset[$i]['STATUS_COMP'] != 'CONFIRMACION' && !$sf_user->hasCompromiso($resultset[$i]['ID_COMP'])): ?>
        <textarea name="acciones" rows="10" class="span5" disabled><?php echo $resultset[$i]['ACCIONES'] ?></textarea>         
      <?php endif; ?>      
    </div>  

    <div class="modal-footer">      
      <button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button> 
      <?php if ($resultset[$i]['STATUS_COMP'] == 'PENDIENTE' && $sf_user->hasCompromiso($resultset[$i]['ID_COMP'])): ?>
        <button class="btn btn-primary" type="submit">Guardar cambios</button> 
      <?php elseif ($resultset[$i]['STATUS_COMP'] == 'CONFIRMACION' && !$sf_user->hasCompromiso($resultset[$i]['ID_COMP'])): ?>
        <button class="btn btn-primary" type="submit">Guardar cambios</button> 
      <?php endif; ?>
    </div>
  </form>
</div>