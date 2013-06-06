<?php use_javascript('agenda_convocatoria.js') ?>

<h5 class="muted"><i class="icon-search"></i> BUSQUEDA DE EVENTOS </h5>

<br>
<table border="0" width="100%">        
  <tr>      
    <!-- Primera columna = Filtro -->  
    <td valign="top" width='25%'>   
      <form id="form_filtrar" action="<?php echo url_for('@filtrar_agenda') ?>" method="POST">
        Fecha inicial de la busqueda:
        <input type="date" name="saf_agenda_convocatoria[f_ini]" value="2012-06-02">
        
        Fecha final de la busqueda:
        <input type="date" name="saf_agenda_convocatoria[f_fin]" value="2012-06-04" />

        <br><br>
        Codigo del evento:
        <input type="text" name="saf_agenda_convocatoria[c_evento]" />

        <br><br>
        <img id="loader" src="/images/loader.gif" style="display: none" />

        <button class="btn btn-small btn-primary" type="submit">
          <i class="icon-search"></i> Filtrar
        </button> 

        <h6>
          <a href="<?php echo url_for('@mi_sesion_agenda') ?>" style="right: ">
            <i class="icon-eye-open"></i>
            ver eventos en mi sesión
          </a>
        </h6>
        
        <br>
        <i class="icon-arrow-left"></i> 
        <a href="<?php echo url_for('@index_agenda') ?>">
          Regresar
        </a>
      </form>
    </td>

    <!-- Segunda columna = Resultados -->
    <td valign="top">      
      <form id="form_agregar_eventos_sesion" action="<?php echo url_for('@eventos_sesion_agenda') ?>" method="POST">
        <div id="info_aqui">Aquí se mostrarán los resultados de la busqueda!</div>
      </form>
    </td>
  </tr>
</table>