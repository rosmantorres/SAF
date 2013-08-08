<?php if (count($fotos) > 0) : ?>
  <?php foreach ($fotos as $foto) : ?>
    <b><?php echo $foto->getTitulo() ?></b>
    <br>
    <?php echo $foto->getSubTitulo() ?>
    <br>
    <?php echo image_tag('/' . $foto->getDir(), 'size=400x350') ?>
    <br><br>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (count($razones) > 0) : ?>    
  <b>RAZONES POR LAS QUE PASA DE 999MVAmin:</b>
  <br><br>
  <?php foreach ($razones as $razon) : ?>
    <li>
      <?php echo $razon->getSAFRAZONMVAMIN() . ': ' . $razon->getMvaMin() . ' MVAmin' ?>
    </li>
  <?php endforeach; ?>
<?php endif; ?>

<?php if (isset($resumen_bitacora)) : ?> 
  <br>
  <b>RESUMEN DE LA BITÁCORA DEL EVENTO:</b>
  <br><br>
  <pre><?php echo $resumen_bitacora ?></pre>
<?php endif; ?>

<?php if (isset($acciones_recomendaciones)) : ?> 
  <br>
  <b>ACCIONES Y RECOMENDACIONES:</b>
  <br><br>
  <pre><?php echo $acciones_recomendaciones ?></pre>
<?php endif; ?>

<?php if (count($compromisos) > 0) : ?> 
  <br>
  <b>COMPROMISOS:</b><br><br>
  <?php foreach ($compromisos as $compromiso) : ?>
    <small>
      <b><u>Fecha de duración estimada:</u></b> 
      <?php echo $compromiso->getFDuracionEstimada() ?><br>

      <b><u>Responsables:</u></b>
      <?php foreach ($compromiso->getResponsables() as $responsable) : ?>
        <?php echo $responsable . ' ' ?>
      <?php endforeach; ?>
    </small>     
    <pre><?php echo $compromiso->getDescripcion() ?></pre>
  <?php endforeach; ?>
<?php endif; ?>