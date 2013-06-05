<table>
  <tbody>
    <tr align="left" >
      <th>Observacion:</th>
      <td><?php echo $saf_agenda_convocatoria->getObservacion() ?></td>
    </tr>
    <tr align="left">
      <th>Fecha de creación:</th>
      <td><?php echo $saf_agenda_convocatoria->getCreatedAt() ?></td>
    </tr>
    <tr align="left">
      <th>Fecha de modificación:</th>
      <td><?php echo $saf_agenda_convocatoria->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<br>
<a href="<?php echo url_for('agenda_convocatoria/edit?id='.$saf_agenda_convocatoria->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('agenda_convocatoria/index') ?>">List</a>
