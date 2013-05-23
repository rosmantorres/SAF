<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($saf_agenda_convocatoria->getId(), 'saf_agenda_convocatoria_edit', $saf_agenda_convocatoria) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_departamento">
  <?php echo $saf_agenda_convocatoria->getDepartamento() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_f_inicio_consulta">
  <?php echo false !== strtotime($saf_agenda_convocatoria->getFInicioConsulta()) ? format_date($saf_agenda_convocatoria->getFInicioConsulta(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_f_fin_consulta">
  <?php echo false !== strtotime($saf_agenda_convocatoria->getFFinConsulta()) ? format_date($saf_agenda_convocatoria->getFFinConsulta(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_observacion">
  <?php echo $saf_agenda_convocatoria->getObservacion() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($saf_agenda_convocatoria->getCreatedAt()) ? format_date($saf_agenda_convocatoria->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($saf_agenda_convocatoria->getUpdatedAt()) ? format_date($saf_agenda_convocatoria->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
