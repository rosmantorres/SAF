<?php slot('menu_activo_seguimiento_control', 'active') ?>

<?php use_javascript('seguimiento_control') ?>

<h5 class="muted"><i class="icon-search"></i> FILTROS DE COMPROMISOS </h5>

<br>

<table border="0" width="100%">   
  <tr>      
    <!-- Primera columna = Filtro -->  
    <td valign="top" width='240px'>   
      <form id="form_filtrar" action="<?php echo url_for('seguimiento_control/filtrar') ?>" method="POST">
        Busqueda por unidad:
        <select name="unidad">
          <option value='TODAS'>----TODAS----</option>
          <?php foreach ($unidades as $unidad) : ?>
            <?php echo '<option value="' . $unidad->getId() . '">' . $unidad . '</option>' ?>
          <?php endforeach; ?>
        </select>
        <br>

        Busqueda por status:
        <select name="status">
          <option value='TODOS'>----TODOS----</option>
          <option>PENDIENTE</option>
          <option>CONFIRMACION</option>
          <option>TERMINADO</option>
        </select>

        <br><br>
        <img id="loader" src="/images/loader.gif" style="display: none" />
        <button class="btn btn-small btn-primary" type="submit">
          <i class="icon-search"></i> Filtrar
        </button> 
      </form>
    </td>
    <!-- Segunda columna = Resultados -->
    <td valign="top">      
      <div id="info_aqui">
        Aquí se mostrarán los resultados de la busqueda!          
      </div>   
    </td>
  </tr>
</table