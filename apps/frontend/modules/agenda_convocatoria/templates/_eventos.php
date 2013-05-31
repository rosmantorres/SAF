<!-- 
 Elemento parcial que se encarga de mostrar los eventos en una tabla con los
 datos necesarios por el cliente
-->

<table border ="1" class="table table-hover">
  <thead>
    <tr>
      <th>NUM_F328</th>
      <th>Fecha Inicio</th>
      <th>Fecha Reparacion</th>
      <th>Region</th>
      <th>Circuito</th>
      <th>Nivel</th>
      <th>Kva Int</th>
      <th>Mva Min</th>
      <th>Num Averia</th>
      <th>Desc Averia</th>
      <th>Tipo Falla</th>
      <th>Operador</th>
      <th>Cuadrilla</th>
      <th>Climatologia</th>
      <th>Trabajo Realizado</th>
      <th>Num Roe</th>
      <th>Programador</th>
      <th>Operador Resp</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($eventos as $evento): ?>
      <?php if ($evento->getTipoFalla() == 'IMPREVISTA'): ?>
        <tr class="error">
      <?php endif; ?>
      <?php if ($evento->getTipoFalla() == 'PROGRAMADA'): ?>
        <tr class="success">
      <?php endif; ?>
      <?php if ($evento->getTipoFalla() == 'CAUSA-500'): ?>
        <tr class="info">
      <?php endif; ?>
          <td><?php echo $evento->getCEventoD() ?></td>
          <td><?php echo $evento->getFHoraIni() ?></td>
          <td><?php echo $evento->getFHoraRep() ?></td>
          <td><?php echo $evento->getRegion() ?></td>
          <td><?php echo $evento->getCircuito() ?></td>
          <td><?php echo $evento->getCodNivel() ?></td>
          <td><?php echo $evento->getKvaInt() ?></td>
          <td><?php echo $evento->getMvaMin() ?></td>
          <td><?php echo $evento->getNumAveria() ?></td>
          <td><?php echo $evento->getDescAveria() ?></td>
          <td><?php echo $evento->getTipoFalla() ?></td>
          <td><?php echo $evento->getOperador() ?></td>
          <td><?php echo $evento->getCuadrilla() ?></td>
          <td><?php echo $evento->getClimatologia() ?></td>
          <td><?php echo $evento->getTrabajoRealizado() ?></td>
          <td><?php echo $evento->getNumRoe() ?></td>
          <td><?php echo $evento->getProgramador() ?></td>
          <td><?php echo $evento->getOperadorResp() ?></td>
        </tr>
    <?php endforeach ?>
  </tbody>
</table>
