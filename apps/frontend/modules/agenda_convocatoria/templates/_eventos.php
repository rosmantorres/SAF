<!-- 
 Elemento parcial que se encarga de mostrar los eventos en una tabla con los
 datos necesarios por el cliente
-->
<table class="table table-hover">
  <thead>
    <tr>
      <th>NUM_F328</th>
      <th>Nivel</th>
      <th>Cod Sist</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($eventos as $evento): ?>
    <tr class="success">
      <td><?php echo $evento->getNumF328() ?></td>
      <td><?php echo $evento->getNivelSistema() ?></td>
      <td><?php echo $evento->getCodSistema() ?></td>
    </tr>
    <?php endforeach ?>
    <tr class="error">
      <td>IMPREVISTA</td>
      <td>...</td>
      <td>...</td>
    </tr>
  </tbody>
</table>


