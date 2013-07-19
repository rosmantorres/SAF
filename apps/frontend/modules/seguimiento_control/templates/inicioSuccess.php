<?php use_javascript('seguimiento_control') ?>

<h5 class="muted"><i class="icon-search"></i> FILTROS DE COMPROMISOS </h5>

<br>

<table border="0" width="100%">   
  <tr>      
    <!-- Primera columna = Filtro -->  
    <td valign="top" width='240px'>   
      <form id="form_filtrar" action="<?php echo url_for('') ?>" method="POST">
        Busqueda por unidad:
        <select>
          <option>TODAS</option>
        </select>
        <br>
        
        Busqueda por status:
        <select>
          <option>TODAS</option>
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
      <form id="" action="<?php echo url_for('') ?>" method="POST">
        <div id="info_aqui">
          <!--Aquí se mostrarán los resultados de la busqueda!-->
          <?php for ($j = 0; $j < count($array_resultset); $j++) : ?>
            <?php include_partial('compromisosDetalladosDeLaUnidad', array('resultset' => $array_resultset[$j])) ?>
            <hr>
          <?php endfor; ?>
        </div>
      </form>
    </td>
  </tr>
</table