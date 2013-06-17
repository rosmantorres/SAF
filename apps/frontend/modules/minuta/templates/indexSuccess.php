<?php slot('title', 'SAF .::Vista Convocatoria::.') ?>
<?php slot('menu_activo_minuta', 'active') ?>

<?php use_javascript('minuta') ?>

<!--<form id="" action="" method="POST">

  <div class="accordion" id="accordion">
    <?php // $cont = 0 ?>
    <?php // foreach ($eventos as $evento) : ?>
      <?php // $cabecera = "(" . ++$cont . ") RI. " . $evento->getCEventoD() . " en circuito " . $evento->getCircuito() . " con " . $evento->getMvaMin() . " Mva Min" ?>
      <?php // include_partial('global/acordeon', array('id_acordeon' => $cont, 'cabecera' => $cabecera, 'contenido' => $evento, 'sin_incluir_partial' => true)) ?>
    <?php // endforeach; ?>
  </div>

  <button class="btn btn-small btn-primary" type="submit">
    <i class="icon"></i> enviar
  </button>

</form>-->

<h6 class="muted">
  <a href="" id="agregar_imagen">
    <i class="icon-plus-sign"></i> Agregar Foto
  </a> /
  <a href="" id="remover_imagen" style="display: none">
    <i class="icon-plus-sign"></i> Remover Última Foto
  </a>
</h6>

<form id="" action="minuta/xxx" method="POST">
<div id="imagen"></div>
<button class="btn btn-small btn-primary" type="submit">
    <i class="icon"></i> enviar
</button>
</form>