<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('convocatoria/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('convocatoria/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'convocatoria/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['asunto']->renderLabel() ?></th>
        <td>
          <?php echo $form['asunto']->renderError() ?>
          <?php echo $form['asunto'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fecha']->renderLabel() ?></th>
        <td>
          <?php echo $form['fecha']->renderError() ?>
          <?php echo $form['fecha'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['hora_ini']->renderLabel() ?></th>
        <td>
          <?php echo $form['hora_ini']->renderError() ?>
          <?php echo $form['hora_ini'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['hora_fin']->renderLabel() ?></th>
        <td>
          <?php echo $form['hora_fin']->renderError() ?>
          <?php echo $form['hora_fin'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['lugar']->renderLabel() ?></th>
        <td>
          <?php echo $form['lugar']->renderError() ?>
          <?php echo $form['lugar'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['status']->renderLabel() ?></th>
        <td>
          <?php echo $form['status']->renderError() ?>
          <?php echo $form['status'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['motivo_suspencion']->renderLabel() ?></th>
        <td>
          <?php echo $form['motivo_suspencion']->renderError() ?>
          <?php echo $form['motivo_suspencion'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['observacion']->renderLabel() ?></th>
        <td>
          <?php echo $form['observacion']->renderError() ?>
          <?php echo $form['observacion'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['c_caf']->renderLabel() ?></th>
        <td>
          <?php echo $form['c_caf']->renderError() ?>
          <?php echo $form['c_caf'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['created_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['created_at']->renderError() ?>
          <?php echo $form['created_at'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['updated_at']->renderLabel() ?></th>
        <td>
          <?php echo $form['updated_at']->renderError() ?>
          <?php echo $form['updated_at'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
