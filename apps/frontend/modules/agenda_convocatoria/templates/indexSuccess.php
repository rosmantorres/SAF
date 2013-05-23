<h1>Saf agenda convocatori as List</h1>

<table class="table table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Departamento</th>
      <th>F inicio consulta</th>
      <th>F fin consulta</th>
      <th>Observacion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($saf_agenda_convocatori_as as $saf_agenda_convocatoria): ?>
    <tr>
      <td><a href="<?php echo url_for('agenda_convocatoria/show?id='.$saf_agenda_convocatoria->getId()) ?>"><?php echo $saf_agenda_convocatoria->getId() ?></a></td>
      <td><?php echo $saf_agenda_convocatoria->getDepartamento() ?></td>
      <td><?php echo $saf_agenda_convocatoria->getFInicioConsulta() ?></td>
      <td><?php echo $saf_agenda_convocatoria->getFFinConsulta() ?></td>
      <td><?php echo $saf_agenda_convocatoria->getObservacion() ?></td>
      <td><?php echo $saf_agenda_convocatoria->getCreatedAt() ?></td>
      <td><?php echo $saf_agenda_convocatoria->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('agenda_convocatoria/new') ?>">New</a>
