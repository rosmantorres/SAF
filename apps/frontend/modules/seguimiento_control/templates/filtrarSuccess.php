<?php for ($j = 0; $j < count($array_resultset); $j++) : ?>
  <?php include_partial('compromisosDetalladosDeLaUnidad', array('resultset' => $array_resultset[$j])) ?>
  <hr>
<?php endfor; ?>
        