<?php slot('menu_activo_seguimiento_control', 'active') ?>

<?php if (count($array_resultset) == 0) : ?>
  <?php echo 'No se encontraron resultados!' ?>
<?php endif; ?>

<?php for ($j = 0; $j < count($array_resultset); $j++) : ?>
  <?php include_partial('compromisosDetalladosDeLaUnidad', array('resultset' => $array_resultset[$j])) ?>
  <hr>
<?php endfor; ?>
        