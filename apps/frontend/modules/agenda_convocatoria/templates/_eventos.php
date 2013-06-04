<!-- 
 Elemento parcial que se encarga de mostrar los eventos en una tabla con los
 datos principales y con opcion de ver los datos secundarios.
-->

<table border ="0" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th># F328</th>
      <th>FECHA</th>      
      <th>REGIÓN</th>
      <th>CIRCUITO</th>
      <th>MVA</th>
      <th>TRABAJO REALIZADO</th>
      <th></th>
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
        <td>
          <a href="#<?php echo $evento->getCEventoD() ?>" data-toggle="modal">
            <?php echo $evento->getCEventoD() ?>              
          </a>
          <?php include_partial('modal', array('evento' => $evento)) ?>
        </td>
        <td><?php echo $evento->getFHoraIni() ?></td>          
        <td><?php echo $evento->getRegion() ?></td>
        <td><?php echo $evento->getCircuito() ?></td>          
        <td><?php echo $evento->getMvaMin() ?></td>          
        <td><?php echo $evento->getTrabajoRealizado() ?></td>
        <td>
          <!-- El nombre del checkbox sera el nombre del cod del evento -->
          <input type="checkbox" name="<?php echo $evento->getCEventoD() ?>" checked="true" />
        </td>        
      </tr>
    <?php endforeach ?>
  </tbody>
</table>