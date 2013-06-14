<?php use_javascript('convocatoria.js') ?>

<?php slot('title', 'SAF .::Nueva convocatoria::.') ?>
<?php slot('menu_activo_convocatoria','active') ?>

<h5 class="muted"><i class="icon-plus-sign"></i> NUEVA CONVOCATORIA </h5>

<table>
  <tr>
    <td valign="top" width='220px'>  
      <h6>
        <i class="icon-flag"></i> (agendas pendientes): <br>
        11 - 12 - 13
      </h6>
      
      <br>
      <form id="form_buscar_agenda" action="<?php echo url_for('@cargar_agenda') ?>" method="POST">

        <h6>Cargar eventos de la agenda:</h6>
        <input id="id_agenda" class="input-medium" type="number" name="id_agenda" required/>

        <br>
        <img id="loader" src="/images/loader.gif" style="display: none" />
        
        <button class="btn btn-small btn-primary" type="submit">
          <i class="icon-search"></i> Buscar
        </button>

      </form>

      <h6>
        <a href="<?php echo url_for('@vista_preliminar_convocatoria') ?>" >
          <i class="icon-eye-open"></i> vista preliminar de la convocatoria
        </a>
      </h6>      
    </td>    
    <td valign="top">       
      <form id="form_agregar_eventos_convocatoria" action="<?php echo url_for('@agregar_eventos_convocatoria') ?>" method="POST">
        
        <div id="info_aqui">Aquí se mostrará la agenda buscada!</div>
        
      </form>      
    </td>    
  </tr>
</table>