<?php slot('title', 'SAF .::Desarrollo de la reunión::.') ?>
<?php slot('menu_activo_minuta', 'active') ?>

<?php use_javascript('minuta') ?>

<h5 class="muted"><i class="icon-edit"></i> DESARROLLO DEL COMITÉ DE ANALISIS DE FALLAS </h5>

<br>
<form id="guardar_minuta" action="<?php echo url_for('@guardar_status_minuta?id=' . $minuta) ?>" method="POST" enctype="multipart/form-data">
  <table width="100%" border="0">
    <tr valign="top">
      <td width="20%">
        <pre><i class="icon-tag"></i> ASISTENTES </pre>

        <h6 class="muted">
          &nbsp;&nbsp;
          <a href="" id="agregar_asistente">
            <i class="icon-plus-sign"></i> Agregar
          </a> 
          <br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="" id="remover_asistente" style="display: none">
            <i class="icon-minus-sign"></i> Remover Último <br>
          </a>
        </h6>

        <div align="center" style="margin: 15px;" id="asistentes">
          <!-- Este input es solo para obtener su valor desde minuta.js -->
          <input type="text" id="cant_asistentes" value="<?php echo count($asistentes) ?>" style="display: none"/>
          <!-- Si existen razones ya agregadas por el usuario -->
          <?php if (count($asistentes) > 0) : ?> 
            <?php $i = 0 ?>
            <?php foreach ($asistentes as $asistente): ?>
              <?php $i++ ?>
              <div id="asistente_agregado">
                <input type="number" class="span2" name="ci_personal<?php echo $i ?>" value="<?php echo $asistente->getIdPersonal() ?>" data-provide="typeahead" data-items="4" data-source=[<?php echo $data_asistentes ?>] autocomplete="off" placeholder="Indique Cédula ' +cant_asistentes+ '" required />
              </div>              
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

        <button class="btn btn-small btn-primary" type="submit">
          <abbr title="Guarda el status actual de la minuta">
            <i class="icon-briefcase"></i> GUARDAR
          </abbr>
        </button>        
        /
        <a href="<?php echo url_for('@finalizar_minuta?id=' . $minuta) ?>" id="terminar_minuta" class="btn btn-small btn-success">
          <abbr title="Se termina la edición de la minuta y se guarda el resultado en PDF">
            <i class="icon-hdd"></i> LISTO! (pdf) 
          </abbr>
        </a>

        <small>
          <p align="justify">
            <b><u>Nota</u></b>:  Es importante GUARDAR solo cuando se piense que 
            ya se tiene todo el desarrollo de la minuta terminado para proceder con 
            el boton de Listo! (pdf), esto por razones de rendimiento.
          </p>
        </small>
      </td>
      <td>&nbsp;&nbsp;</td>
      <td>
        <pre><i class="icon-tag"></i> AGENDA DE REUNIÓN </pre>

        <table border="0" width="90%" align="center">
          <tr align="center">
            <td>
              <!-- 1. Revisión del status de los compromisos: -->
              <h6 class="muted"> 1. Revisión del status de los compromisos: </h6>
              <div style="width:95%; height:250px; border-width: 1px; border-style: solid; border-color: #ddd; ">
                <?php if ($minuta_obj->getImgCompromisos()): ?>
                  <?php echo image_tag('/' . $minuta_obj->getImgCompromisos()) ?>
                <?php endif; ?>
              </div>
              <input type="file" name="foto1" accept="image/png, image/gif, image/jpeg, image/jpg" />
            </td>
            <td>
              <!-- 2. Revisión del status de las asistencias: -->
              <h6 class="muted"> 2. Revisión del status de las asistencias: </h6>
              <div style="width:95%; height:250px; border-width: 1px; border-style: solid; border-color: #ddd; ">
                <?php if ($minuta_obj->getImgAsistencias()): ?>
                  <?php echo image_tag('/' . $minuta_obj->getImgAsistencias()) ?>
                <?php endif; ?>
              </div>
              <input type="file" name="foto2" accept="image/png, image/gif, image/jpeg, image/jpg" />
            </td>
          </tr>
        </table> 

        <!-- 3. Revisión y Análisis de las siguientes interrupciones: -->
        <br>
        <h6 align="center" class="muted">3. Revisión y Análisis de las siguientes interrupciones: </h6> 
        <table align="center" width="90%" border="0">
          <tr>
            <td>
              <div class="accordion" id="accordion">
                <?php $cont = 0 ?>
                <?php foreach ($eventos as $evento) : ?>
                  <h6>
                    <a href="<?php echo url_for('@desarrollar_evento?id=' . $evento . '&id_convocatoria=' . $convocatoria) ?>">
                      <i class="icon-pencil"></i> Editar
                    </a>
                    <?php if (Doctrine_Core::getTable('SAF_EVENTO_CONVOCATORIA')->getEventoConvocatoria($evento, $convocatoria)->getStatus() == 'analizado'): ?> 
                      (<i class="icon-ok"></i>) 
                    <?php endif; ?>                  
                    <pre><?php echo "(" . ++$cont . ") RI. " . $evento->getCEventoD() . " en circuito " . $evento->getCircuito() . " con " . $evento->getMvaMin() . " MVAmin" ?></pre>
                  </h6>
                  <?php include_partial('global/acordeon', array('id_acordeon' => $cont, 'cabecera' => '', 'contenido' => $evento, 'sin_incluir_partial' => true)) ?> 
                <?php endforeach; ?>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</form>