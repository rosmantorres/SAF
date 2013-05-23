<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $saf_agenda_convocatoria->getId() ?></td>
    </tr>
    <tr>
      <th>Departamento:</th>
      <td><?php echo $saf_agenda_convocatoria->getDepartamento() ?></td>
    </tr>
    <tr>
      <th>F inicio consulta:</th>
      <td><?php echo $saf_agenda_convocatoria->getFInicioConsulta() ?></td>
    </tr>
    <tr>
      <th>F fin consulta:</th>
      <td><?php echo $saf_agenda_convocatoria->getFFinConsulta() ?></td>
    </tr>
    <tr>
      <th>Observacion:</th>
      <td><?php echo $saf_agenda_convocatoria->getObservacion() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $saf_agenda_convocatoria->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $saf_agenda_convocatoria->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('agenda_convocatoria/edit?id='.$saf_agenda_convocatoria->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('agenda_convocatoria/index') ?>">List</a>
