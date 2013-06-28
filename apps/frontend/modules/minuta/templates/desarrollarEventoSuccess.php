<?php slot('title', 'SAF .::Desarrollo del Evento::.') ?>
<?php slot('menu_activo_minuta', 'active') ?>

<?php use_javascript('minuta') ?>

<?php $cabecera = "RI. " . $evento->getCEventoD() . " - Circuito " . $evento->getCircuito() . " con " . $evento->getMvaMin() . " MVAmin" ?>

<table width="100%" border="0">
  <tr valign="top" align="center">
    <td width="25%">
      <h4 class="muted"><u>MENÚ DE OPCIONES</u></h4>
      <h6 class="muted"><i class="icon-edit"></i> DESARROLLO DEL EVENTO </h6>
    </td>
    <td width="75%"><h3 class="muted"><?php echo $cabecera ?></h3></td>
  </tr>
  <tr valign="top">
    <td>
      <h6 class="muted">
        <a href="" id="agregar_imagen">
          <i class="icon-plus-sign"></i> Agregar Imagén
        </a> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="" id="remover_imagen" style="display: none">
          <i class="icon-minus-sign"></i> Remover Última Imagén <br>
        </a>

        <br>
        <a href="" id="agregar_razon">
          <i class="icon-plus-sign"></i> Agregar Razón
        </a> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="" id="remover_razon" style="display: none">
          <i class="icon-minus-sign"></i> Remover Última Razón <br>
        </a>

        <br>
        <a href="" id="agregar_acciones">
          <i class="icon-plus-sign"></i> Agregar Acciones y Recomendaciones
        </a>
        <a href="" id="remover_acciones" style="display: none">
          <i class="icon-minus-sign"></i> Remover Acciones y Recomendaciones
        </a>

        <br><br>
        <a href="" id="agregar_compromiso">
          <i class="icon-plus-sign"></i> Agregar Compromiso
        </a> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="" id="remover_compromiso" style="display: none">
          <i class="icon-minus-sign"></i> Remover Último Compromiso
        </a>
      </h6>
    </td>
    <td>
      <form id="guardar_desarrollo_evento" action="<?php echo url_for('minuta/procesarEvento?id=' . $evento->getId()) ?>" method="POST" enctype="multipart/form-data">        

        <pre><i class="icon-tag"></i> IMÁGENES: (Formatos válidos gif, jpeg, jpg, png)</pre>
        <div style="margin: 15px;" id="imagenes"> 

          <!-- Este input es solo para obtener su valor desde minuta.js -->
          <input type="text" id="cant_fotos" value="<?php echo count($fotos) ?>" style="display: none"/>
          <!-- Si existen fotos ya agregadas por el usuario -->
          <?php if (count($fotos) > 0) : ?> 
            <?php $i = 0 ?>
            <?php foreach ($fotos as $foto): ?>
              <?php $i++ ?>
              <div id="imagen_agregada">
                <table width="95%"> 
                  <tr valign="top">
                    <td>
                      <input type="text" name="id_foto<?php echo $i ?>" value="<?php echo $foto->getDir() ?>" style="display: none"/>
                      <input type="text" class="span5" name="titulo_foto<?php echo $i ?>" value="<?php echo $foto->getTitulo() ?>" placeholder="Indique el titulo" required /><br>
                      <input type="text" class="span6" name="sub_titulo_foto<?php echo $i ?>" value="<?php echo $foto->getSubTitulo() ?>" placeholder="Indique el sub-titulo" /><br>                
                      <input type="file" name="foto<?php echo $i ?>" accept="image/png, image/gif, image/jpeg, image/jpg" />
                    </td>
                    <td align="center">
                      <?php echo image_tag('/' . $foto->getDir(), 'size=120x120') ?><br>
                      <?php echo $foto->getDir() ?>
                    </td>
                  </tr>
                </table>                
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

        </div>

        <pre><i class="icon-tag"></i> RAZONES POR LA QUE SUPERA LOS 999 MVA-MIN: </pre> 
        <div style="margin: 15px;" id="razones">

          <!-- Este input es solo para obtener su valor desde minuta.js -->
          <input type="text" id="cant_razones" value="<?php echo count($razones) ?>" style="display: none"/>
          <!-- Si existen razones ya agregadas por el usuario -->
          <?php if (count($razones) > 0) : ?> 
            <?php $i = 0 ?>
            <?php foreach ($razones as $razon): ?>
              <?php $i++ ?>
              <div id="razon_agregada">
                <input type="text" class="span3" name="razon<?php echo $i ?>" value="<?php echo $razon->getSAFRAZONMVAMIN() ?>" data-provide="typeahead" data-items="3" data-source=[<?php echo $data_razones ?>] autocomplete="off" placeholder="Indique razón" required />
                <input type="number" class="span1" name="mva_razon<?php echo $i ?>" value="<?php echo $razon->getMvaMin() ?>" placeholder="Cant" required/> MVAmin
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

        </div>

        <pre><i class="icon-tag"></i> RESUMEN DE LA BITÁCORA DEL EVENTO: </pre> 
        <div style="margin: 15px;">

          <!-- Si existe ya un resumen de la bitácora agregada por el usuario -->
          <?php if ($resumen_bitacora) : ?>
            <!-- Se agrega el resumen hecho por el usuario -->
            <?php $bitacora = $resumen_bitacora->getDescripcion() ?>
          <?php else : ?>
            <!-- Se agrega el resumen de la averia hecha por las cuadrillas -->
            <?php $bitacora = $evento->getDescAveria() ?>
          <?php endif; ?>
          <textarea name="bitacora" class="input-block-level" rows="3"><?php echo $bitacora ?></textarea>

        </div>

        <pre><i class="icon-tag"></i> ACCIONES Y RECOMENDACIONES: </pre>
        <div style="margin: 15px;" id="acciones">

          <!-- Si existen acciones y recomendaciones hecha por el usuario -->
          <?php if ($acciones_recomendaciones) : ?>
            <!-- Este input es solo para obtener su valor desde minuta.js -->
            <input type="text" id="cant_acciones" value="1" style="display: none"/>
            <div id="accion_agregada">
              <textarea name="acciones" class="input-block-level" rows="3" placeholder="Indique las acciones y recomendaciones" required><?php echo $acciones_recomendaciones->getDescripcion() ?></textarea>
            </div>
          <?php else : ?>
            <!-- Este input es solo para obtener su valor desde minuta.js -->
            <input type="text" id="cant_acciones" value="0" style="display: none"/>
          <?php endif; ?>

        </div>        

        <pre><i class="icon-tag"></i> COMPROMISOS: </pre>
        <div style="margin: 15px;" id="compromisos">

          <!-- Este input es solo para obtener su valor desde minuta.js -->
          <input type="text" id="cant_compromisos" value="<?php echo count($compromisos) ?>" style="display: none"/>
          <!-- Si existen razones ya agregadas por el usuario -->
          <?php if (count($compromisos) > 0) : ?> 

            <?php $i = 0 ?>
            <?php foreach ($compromisos as $compromiso): ?>

              <?php $i++ ?>
              <?php $j = 0 ?>
              <div id="compromiso_agregado">
                <small><b>Duración estimada del compromiso:</b></small>                
                <br><input name="f_duracion_estimada_comp<?php echo $i ?>" type="datetime-local" value="<?php echo substr($compromiso->getFDuracionEstimada(), 0, 10) . "T" . substr($compromiso->getFDuracionEstimada(), 11) ?>" required />
                <textarea name="compromiso<?php echo $i ?>" class="input-block-level" rows="3" placeholder="Indique el compromiso y luego los responsables" required><?php echo $compromiso->getDescripcion(); ?></textarea>
                <?php foreach ($compromiso->getResponsables() as $responsable) : ?>

                  <?php $j++ ?>
                  <select class="span3" name="responsable_compromiso<?php echo $i . $j ?>" required>
                    <option></option>
                    <?php foreach ($data_ue as $ue) : ?>
                      <?php if ($ue->getId() == $responsable->getId()) : ?>
                        <?php echo "<option value='" . $ue->getId() . "' selected>" . $ue->getNombre() . "</option>"; ?>
                      <?php else : ?>
                        <?php echo "<option value='" . $ue->getId() . "'>" . $ue->getNombre() . "</option>"; ?>
                      <?php endif; ?>                      
                    <?php endforeach; ?>
                  </select>

                <?php endforeach; ?>
              </div>

            <?php endforeach; ?>

          <?php endif; ?>

        </div>

        <hr>
        <div align="center">
          <button class="btn btn-small btn-primary" type="submit" >
            <i class="icon-briefcase"></i> GUARDAR DESARROLLO DEL EVENTO
          </button>
          <a href="<?php echo url_for('minuta/inicioDesarrollo') ?>" id="cancelar_proceso" class="btn btn-small">
            <i class="icon-remove"></i> CANCELAR PROCESO
          </a>
        </div>
      </form>
    </td>
  </tr>
</table>