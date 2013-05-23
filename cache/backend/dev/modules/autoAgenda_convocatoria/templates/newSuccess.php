<?php use_helper('I18N', 'Date') ?>
<?php include_partial('agenda_convocatoria/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Agenda convocatoria', array(), 'messages') ?></h1>

  <?php include_partial('agenda_convocatoria/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('agenda_convocatoria/form_header', array('saf_agenda_convocatoria' => $saf_agenda_convocatoria, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('agenda_convocatoria/form', array('saf_agenda_convocatoria' => $saf_agenda_convocatoria, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('agenda_convocatoria/form_footer', array('saf_agenda_convocatoria' => $saf_agenda_convocatoria, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
