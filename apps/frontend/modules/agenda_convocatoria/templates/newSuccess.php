<?php use_javascript('agenda_convocatoria.js') ?>

<h5>Home >> Nueva agenda convocatoria</h5>

<table border="0" width="100%">        
  <tr>      
    <!-- Primera columna = Filtro-->
    <form id="form_filtrar" action="filtrar" method="POST">
      <td valign="top">
        <?php echo $form['observacion']->renderLabel() ?>
        <?php echo $form['observacion']->render() ?><br>
        <label>Fecha inicial de la busqueda:</label><input type="date" name="saf_agenda_convocatoria[f_ini]" value="2012-06-02"/><br>
        <label>Fecha final de la busqueda:</label> <input type="date" name="saf_agenda_convocatoria[f_fin]" value="2012-07-30" /><br>
        <button class="btn btn-small btn-primary" type="submit">Filtrar</button>
        <img id="loader" src="/images/loader.gif" style="display: none" />
      </td>
    </form>
  
    <!-- Segunda columna = Separacion -->
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    
    <!-- Tercera columna = Resultados -->
    <td valign="top">
      <form id="form_agregar" action="agregar" method="POST">
        <div id="info_aqui">Aquí se mostrarán los resultados de la busqueda!</div>
      </form>
    </td>
  </tr>
</table>