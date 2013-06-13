<?php slot('title', 'SAF .::Lista de convocatorias::.') ?>
<?php slot('menu_activo_convocatoria','active') ?>

<h5 class="muted"><i class="icon-folder-open"></i> LISTA DE CONVOCATORIAS </h5>

<h6>
  <a href="<?php echo url_for('@nueva_convocatoria') ?>">
    <i class="icon-plus"></i> Crear una nueva convocatoria
  </a>
</h6>

<br>
<?php if (count($convocatorias) > 0) : ?>

  <table class="table table-bordered table-hover">
    <thead style="background-color: #d8d9d7">
      <tr>
        <th width="25px">N°</th>
        <th>ASUNTO</th>
        <th width="75px">FECHA</th>
        <th width="90px">HORA</th>
        <th>LUGAR</th>
        <th>STATUS</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($convocatorias as $convocatoria): ?>
        <tr>
          <td>
            <a href="<?php echo url_for('@mostrar_convocatoria?id=' . $convocatoria->getId()) ?>">
              <?php echo $convocatoria->getId() ?>
            </a>
          </td>
          <td><?php echo $convocatoria->getAsunto() ?></td>
          <td><?php echo substr($convocatoria->getFecha(), 0, 10) ?></td>
          <td><?php echo $convocatoria->getHoraIni().' a '.$convocatoria->getHoraFin() ?></td>
          <td><?php echo $convocatoria->getLugar() ?></td>
          <td>
            <small>
              <?php if ($convocatoria->getStatus() == 'ACTIVA'): ?> 
                <b style="color: green">Activa</b>
              <?php elseif ($convocatoria->getStatus() == 'EJECUCION'): ?>
                <b style="color: #149bdf">Ejecución</b>
              <?php elseif ($convocatoria->getStatus() == 'TERMINADA'): ?>
                <b>Terminada</b>
              <?php elseif ($convocatoria->getStatus() == 'SUSPENDIDA'): ?>
                <b style="color: red">Suspendida</b>
              <?php endif; ?>
            </small>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<?php else : ?>

  <i class="icon-info-sign"></i> NO HAY CONVOCATORIAS EN ESTOS MOMENTOS!
  
<?php endif; ?>
