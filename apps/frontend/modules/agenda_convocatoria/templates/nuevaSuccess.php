<?php use_javascript('agenda_convocatoria.js') ?>

<?php slot('title', 'SAF .::Nueva agenda::.') ?>
<?php slot('menu_activo_agenda','active') ?>

<h5 class="muted"><i class="icon-search"></i> BUSQUEDA DE EVENTOS </h5>

<br>
<table border="0" width="100%">        
  <tr>      
    <!-- Primera columna = Filtro -->  
    <td valign="top" width='240px'>   
      <form id="form_filtrar" action="<?php echo url_for('@filtrar_agenda') ?>" method="POST">
        Fecha inicial de la busqueda:
        <input id="f_ini" type="date" name="saf_agenda_convocatoria[f_ini]" />
        
        Fecha final de la busqueda:
        <input id="f_fin" type="date" name="saf_agenda_convocatoria[f_fin]" />

        <br><br>
        Codigo del evento:
        <input id="c_evento" type="number" name="saf_agenda_convocatoria[c_evento]" />        

        <br><br>
        <img id="loader" src="/images/loader.gif" style="display: none" />

        <button class="btn btn-small btn-primary" type="submit">
          <i class="icon-search"></i> Filtrar
        </button> 

        <h6>
          <a href="<?php echo url_for('@vista_preliminar_agenda') ?>" >
            <i class="icon-eye-open"></i> 
            vista preliminar de la agenda
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
      <form id="form_agregar_eventos_sesion" action="<?php echo url_for('@agregar_eventos_agenda') ?>" method="POST">
        <div id="info_aqui">Aquí se mostrarán los resultados de la busqueda!</div>
      </form>
    </td>
  </tr>
</table>