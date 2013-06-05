<h5 class="muted"><i class="icon-folder-open"></i> LISTA DE AGENDAS </h5>

<table class="table table-bordered table-hover">
  <thead style="background-color: #d8d9d7">
    <tr>
      <th>#</th>
      <th>ID</th>
      <th>OBSERACIÓN</th>
      <th>FECHA DE CREACIÓN</th>
      <th>FECHA DE MODIFICACIÓN</th>
    </tr>
  </thead>
  <tbody>
    <?php $item = 0 ?>
    <?php foreach ($agendas as $agenda): ?>
      <?php $item = $item + 1 ?>
      <tr>
        <td><?php echo $item ?></td>
        <td>
          <a href="<?php echo url_for('agenda_convocatoria/show?id=' . $agenda->getId()) ?>">
            <?php echo $agenda->getId() ?>
          </a>
        </td>
        <td><?php echo $agenda->getObservacion() ?></td>
        <td><?php echo $agenda->getCreatedAt() ?></td>
        <td><?php echo $agenda->getUpdatedAt() ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('agenda_convocatoria/new') ?>">New</a>
