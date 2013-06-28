<?php slot('title', 'SAF .::Desarrollo de la reunión::.') ?>
<?php slot('menu_activo_minuta', 'active') ?>

<?php use_javascript('minuta') ?>

<h5 class="muted"><i class="icon-edit"></i> DESARROLLO DEL COMITÉ DE ANALISIS DE FALLAS </h5>

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

      <div align="center" style="margin: 15px;" id="asistentes"></div>
    </td>

    <td>
      <pre><i class="icon-tag"></i> AGENDA DE REUNIÓN </pre>

      <!-- 1. Revisión de los compromisos: -->
      <h6 class="muted"> 
        &nbsp;&nbsp;&nbsp;&nbsp;
        1. Revisión de los compromisos: 
      </h6>
      <div align="center"> <?php echo image_tag('/subidas/compromisos.JPG', 'size=750x750') ?> </div>

      <!-- 2. Revisión y Análisis de las siguientes interrupciones: -->
      <br>
      <h6 class="muted">
        &nbsp;&nbsp;&nbsp;&nbsp;
        2. Revisión y Análisis de las siguientes interrupciones: 
      </h6> 
      <table align="center" width="90%" border="0">
        <tr>
          <td>
            <div class="accordion" id="accordion">
              <?php $cont = 0 ?>
              <?php foreach ($eventos as $evento) : ?>
                <h6><a href="desarrollarEvento?id=<?php echo $evento ?>">
                    <i class="icon-pencil"></i> Editar
                  </a></h6>
                <?php $cabecera = "(" . ++$cont . ") RI. " . $evento->getCEventoD() . " en circuito " . $evento->getCircuito() . " con " . $evento->getMvaMin() . " MVAmin" ?>    
                <?php include_partial('global/acordeon', array('id_acordeon' => $cont, 'cabecera' => $cabecera, 'contenido' => $evento, 'sin_incluir_partial' => true)) ?> 
              <?php endforeach; ?>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<?php
//include_partial('global/eventos', array('eventos' => $eventos, 'no_column_check' => true)) ?>