<?php slot('title', 'SAF .::Lista de Minutas::.') ?>
<?php slot('menu_activo_minuta','active') ?>

<h5 class="muted"><i class="icon-folder-open"></i> LISTA DE MINUTAS </h5>

<?php if (count($minutas) > 0) : ?>
  <br>
  <table class="table table-bordered table-hover">
    <thead style="background-color: #d8d9d7">
      <tr>
        <th>N° MINUTA</th>
        <th>N° CONVOCATORIA</th>
        <th>FECHA DE CREACIÓN</th>
        <th>FECHA DE MODIFICACIÓN</th>
        <th>STATUS</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($minutas as $minuta): ?>
        <tr>
          <td>
            <a href="<?php echo url_for('@inicio_desarrollo?id=' . $minuta->getIdConvocatoria()) ?>">
              <?php echo $minuta->getCodMin() ?>
            </a>
          </td>
          <td>
            <a href="<?php echo url_for('@mostrar_convocatoria?id=' . $minuta->getIdConvocatoria()) ?>">
              <?php echo $minuta->getIdConvocatoria() ?>
            </a>            
          </td>
          <td><?php echo $minuta->getCreatedAt() ?></td>
          <td><?php echo $minuta->getUpdatedAt() ?></td>
          <td>
            <small>
              <?php if ($minuta->getLista() == 0): ?> 
                <b style="color: #149bdf">Ejecución</b>
              <?php elseif ($minuta->getLista() != 0): ?>
                <b>Terminada</b>              
              <?php endif; ?>
            </small>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<?php else : ?>

  <i class="icon-info-sign"></i> NO HAY MINUTAS CREADAS EN ESTOS MOMENTOS!
  
<?php endif; ?>
