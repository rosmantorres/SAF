<h5 class="muted"><i class="icon-folder-open"></i> LISTA DE AGENDAS </h5>

<h6>
  <a href="<?php echo url_for('@nueva_agenda') ?>">
    <i class="icon-plus"></i>
    Crear una nueva agenda
  </a>
</h6>

<br>
<?php if (count($agendas) > 0) : ?>
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
            <a href="<?php echo url_for('@mostrar_agenda?id=' . $agenda->getId()) ?>">
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
<?php else : ?>
  <i class="icon-info-sign"></i> NO HAY AGENDAS EN ESTOS MOMENTOS!
<?php endif; ?>

