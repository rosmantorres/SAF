<table width="100%" border="1" align="center" >
  <thead style="background-color: #d8d9d7">
    <tr style="background-color: whitesmoke"><th colspan="5"><?php echo $resultset[0]['NOMBRE_UE'] ?></th></tr>
    <tr>
      <th>N°</th>
      <th>CASO</th>
      <th>MINUTA</th>
      <th>STATUS</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php for ($i = 0; $i < count($resultset); $i++) : ?>      
      <tr align="center">
        <td><?php echo $i + 1 ?></td>
        <td>
          RI. <?php
          echo '<b>' . $resultset[$i]['RI'] . '</b>. ' . $resultset[$i]['CIRCUITO'] .
          '. ' . strftime("%A, %d de %B de %Y", strtotime($resultset[$i]['FECHA_CASO']))
          ?>
        </td>
        <td>
          <a href="<?php echo url_for('@visualizar_minuta?id=' . $resultset[$i]['COD_MIN']) ?>">
            <?php echo '(#' . $resultset[$i]['COD_MIN'] . ') ' . utf8_encode(strftime("%A %d de %B de %Y", strtotime($resultset[$i]['F_MINUTA']))) ?>
          </a>
        </td>
        <td>
          <small>
            <?php if ($resultset[$i]['STATUS_COMP'] == 'TERMINADO'): ?> 
              <b style="color: activecaption">Terminado</b>
            <?php elseif ($resultset[$i]['STATUS_COMP'] == 'PENDIENTE'): ?>
              <b style="color: red">Pendiente</b>
            <?php elseif ($resultset[$i]['STATUS_COMP'] == 'CONFIRMACION'): ?>
              <b style="color: #cccccc">Por confirmar</b>
            <?php endif; ?>
          </small>
        </td>
        <td>          
          <a href="#<?php echo $resultset[$i]['ID_COMP'] ?>" data-toggle="modal">ver</a>
        </td>
      </tr> 
      <?php include_partial('modalEdicionYRevisionDeCompromisos', array('resultset' => $resultset, 'i' => $i)) ?>
    <?php endfor; ?>
  </tbody>
</table>
