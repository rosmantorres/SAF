<h1>Nueva agenda convocatoria</h1>

<?php //echo $form;  //include_partial('form', array('form' => $form)) ?>

<?php echo $form->renderFormTag('filtrar') ?>
  <table border="0">
    <tfoot>
      <tr>
        <td colspan="2">          
          <button class="btn btn-small btn-primary" type="submit">Filtrar</button>
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
      <tr>
        <td>
          Fecha Inicial: <input type="date" name="saf_agenda_convocatoria[f_ini]" />
        </td>
        <td>
          Fecha Final: <input type="date" name="saf_agenda_convocatoria[f_fin]" />
        </td>
      </tr>
    </tbody>
  </table>
</form>

<?php /* 
<div class="accordion" id="accordion">
  <?php
  include_partial('acordeon', array(
      'id_acordeon' => 'acordeon_1',
      'cabecera' => 'Eventos segun criterios',
      'contenido' => 'eventos'))
  ?>
  <?php
  include_partial('acordeon', array(
      'id_acordeon' => 'acordeon_2',
      'cabecera' => 'Eventos restantes',
      'contenido' => 'eventos'))
  ?>
</div>
*/ ?>