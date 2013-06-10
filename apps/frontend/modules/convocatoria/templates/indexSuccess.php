<?php slot('title', 'SAF .::Lista de convocatorias::.') ?>

<h5 class="muted"><i class="icon-folder-open"></i> LISTA DE CONVOCATORIAS </h5>

<h6>
  <a href="<?php echo url_for('@nueva_convocatoria') ?>">
    <i class="icon-plus"></i>
    Crear una nueva convocatoria
  </a>
</h6>

<br>
<?php if (count($convocatorias) > 0) : ?>
  <table class="table table-bordered table-hover">
    <thead style="background-color: #d8d9d7">
      <tr>
        <th>#</th>
        <th>ID</th>
        <th>ASUNTO</th>
        <th>FECHA</th>
        <th>HORA</th>
        <th>LUGAR</th>
        <th>STATUS</th>        
        <th>OBSERVACION</th>
        <th>COD CAF</th>        
        <th>FECHA DE CREACIÓN</th>
        <th>FECHA DE MODIFICACIÓN</th>
      </tr>
    </thead>
    <tbody>
      <?php $item = 0 ?>
      <?php foreach ($convocatorias as $convocatoria): ?>
        <?php $item = $item + 1 ?>
        <tr>
          <td><?php echo $item ?></td>
          <td>
            <a href="<?php echo url_for('@mostrar_agenda?id=' . $convocatoria->getId()) ?>">
              <?php echo $convocatoria->getId() ?>
            </a>
          </td>
          <td><?php echo $convocatoria->getAsunto() ?></td>
          <td><?php echo $convocatoria->getFecha() ?></td>
          <td><?php echo $convocatoria->getHoraIni().' - '.$convocatoria->getHoraFin() ?></td>
          <td><?php echo $convocatoria->getLugar() ?></td>
          <td><?php echo $convocatoria->getStatus() ?></td>
          <td><?php echo $convocatoria->getObservacion() ?></td>
          <td><?php echo $convocatoria->getCCaf() ?></td>
          <td><?php echo $convocatoria->getCreatedAt() ?></td>
          <td><?php echo $convocatoria->getUpdatedAt() ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php else : ?>
  <i class="icon-info-sign"></i> NO HAY CONVOCATORIAS EN ESTOS MOMENTOS!
<?php endif; ?>

