<h1>Nueva agenda convocatoria</h1>

<?php echo $form;  //include_partial('form', array('form' => $form)) ?>

<label>Fecha de inicio</label>
<input type="date" value="">
<label>Fecha de fin</label>
<input type="date" value="">
<button class="btn btn-small btn-primary" type="button">Filtrar</button>

<div class="accordion" id="accordion">
<?php include_partial('acordeon',array(
    'id_acordeon' => 'acordeon_1',
    'cabecera' => 'Eventos segun criterios',
    'contenido' => 'eventos' )) ?>
<?php include_partial('acordeon',array(
    'id_acordeon' => 'acordeon_2',
    'cabecera' => 'Eventos restantes',
    'contenido' => 'eventos' )) ?>
</div>
