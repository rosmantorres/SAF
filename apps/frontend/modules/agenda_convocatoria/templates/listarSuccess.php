<?php slot('title', 'SAF .::Lista de agendas::.') ?>
<?php slot('menu_activo_agenda', 'active') ?>

<h5 class="muted"><i class="icon-folder-open"></i> LISTA DE AGENDAS </h5>

<h6>
  <a href="<?php echo url_for('@nueva_agenda') ?>">
    <i class="icon-plus"></i> Crear una nueva agenda
  </a>
</h6>

<?php if (count($agendas) > 0) : ?>

  <h6 align="right"><i class="icon-flag"></i> (agendas pendientes)</h6>
  <table class="table table-bordered table-hover">
    <thead style="background-color: #d8d9d7">
      <tr>
        <th>N°</th>
        <th width="720px">OBSERVACIONES</th>
        <th>FECHA DE CREACIÓN</th>
        <th>FECHA DE MODIFICACIÓN</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($agendas as $agenda): ?>
        <tr>
          <td>
            <a href="<?php echo url_for('@mostrar_agenda?id=' . $agenda->getId()) ?>">
              <?php echo $agenda->getId() ?>
            </a>
          </td>
          <td><?php echo $agenda->getObservacion() ?></td>
          <td><?php echo $agenda->getCreatedAt() ?></td>
          <td><?php echo $agenda->getUpdatedAt() ?></td>
          <td>
            <?php if ($agenda->getPendiente() == 1) : ?>
              <i class="icon-flag"></i>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<?php else : ?>

  <i class="icon-info-sign"></i> NO HAY AGENDAS EN ESTOS MOMENTOS!
  
<?php endif; ?>