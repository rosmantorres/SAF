<?php use_javascript('agenda_convocatoria.js') ?>

<h4 class="muted">Home >> Nueva agenda convocatoria</h4>
<br>
<table border="0" width="100%">        
  <tr>      
    <!-- Primera columna = Filtro -->
    <form id="form_filtrar" action="filtrar" method="POST">
      <td valign="top" width='25%'>
        <?php echo $form['observacion']->renderLabel() ?>
        <?php echo $form['observacion']->render() ?><br>
        <label>Fecha inicial de la busqueda:</label><input type="date" name="saf_agenda_convocatoria[f_ini]" value="2012-06-02"/><br>
        <label>Fecha final de la busqueda:</label> <input type="date" name="saf_agenda_convocatoria[f_fin]" value="2012-06-04" /><br>
        <br><img id="loader" src="/images/loader.gif" style="display: none" />
        <button class="btn btn-small btn-primary" type="submit">
          <i class="icon-search"></i> Filtrar
        </button> 
        <h6>
          <a href="prueba" style="right: ">
            <i class="icon-eye-open"></i>
            ver eventos en mi sesión
          </a>
        </h6>
      </td>
    </form>
  
    
    <!-- Tercera columna = Resultados -->
    <td valign="top">      
      <form id="form_agregar" action="guardarHistEventosChecked" method="POST">
        <div id="info_aqui">Aquí se mostrarán los resultados de la busqueda!</div>
      </form>
    </td>
  </tr>
</table>