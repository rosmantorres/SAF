<?php slot('title', 'SAF .::Vista Convocatoria::.') ?>
<?php slot('menu_activo_minuta', 'active') ?>

<?php use_javascript('minuta') ?>

<?php $cabecera = "RI. " . $evento->getCEventoD() . " - Circuito " . $evento->getCircuito() . " con " . $evento->getMvaMin() . " MVAmin" ?>

<table width="100%" border="0">
  <tr align="center" style="background-color: #ffffff">
    <td width="25%"><h4 class="muted"><u>MENÚ DE OPCIONES</u></h4></td>
    <td width="75%"><h4 class="muted"><?php echo $cabecera ?></h4></td>
  </tr>
  <tr valign="top">
    <td>
      <h6 class="muted">
        <a href="" id="agregar_imagen">
          <i class="icon-plus-sign"></i> Agregar Imagén
        </a> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="" id="remover_imagen" style="display: none">
          <i class="icon-minus-sign"></i> Remover Última Imagén
        </a>
        
        <br>
        <a href="" id="agregar_razon">
          <i class="icon-plus-sign"></i> Agregar Razón
        </a> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="" id="remover_razon" style="display: none">
          <i class="icon-minus-sign"></i> Remover Última Razón
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
      <form action="minuta/procesarEvento" method="POST" enctype="multipart/form-data">        
        <pre><i class="icon-tag"></i> IMÁGENES: (Formatos válidos gif, jpeg, jpg, png)</pre>
        <div style="margin: 15px;" id="imagenes"></div>
        
        <pre><i class="icon-tag"></i> RAZONES POR LA QUE SUPERA LOS 999 MVA-MIN: </pre> 
        <div style="margin: 15px;" id="razones"></div>
        
        <pre><i class="icon-tag"></i> RESUMEN DE LA BITÁCORA DEL EVENTO: </pre> 
        <div style="margin: 15px;">
          <textarea name="bitacora" class="input-block-level" rows="8"><?php echo $evento->getDescAveria() ?></textarea>
        </div>
        
        <pre><i class="icon-tag"></i> ACCIONES Y RECOMENDACIONES: </pre>
        <div style="margin: 15px;" id="acciones"></div>        
        
        <pre><i class="icon-tag"></i> COMPROMISOS: </pre>
        <div style="margin: 15px;" id="compromisos"></div>
        
        <hr>
        <button class="btn btn-small btn-primary" type="submit" style="alignment-adjust: ">
          <i class="icon"></i> Enviar
        </button>
      </form>
    </td>
  </tr>
</table>