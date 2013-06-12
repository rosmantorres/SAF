<?php use_javascript('convocatoria.js') ?>

<?php slot('title', 'SAF .::Nueva convocatoria::.') ?>
<?php slot('menu_activo_convocatoria','active') ?>

<h5 class="muted"><i class="icon-plus-sign"></i> NUEVA CONVOCATORIA </h5>

<br>
<table>
  <tr>
    <td valign="top" width='220px'>
      
      <form id="form_buscar_agenda" action="cargarEventosDeAgenda" method="POST">
        <div id="busqueda">
          <h6>
            Cargar eventos de la agenda:<br>
            <input id="id_agenda" class="input-medium" type="number" name="id_agenda" required/>
          </h6>
          <img id="loader" src="/images/loader.gif" style="display: none" />
          <button class="btn btn-small btn-primary" type="submit">
            <i class="icon-search"></i> Buscar
          </button>
        </div>
      </form>

      <br>
      <h6>
        <a href="<?php echo url_for('@vista_preliminar_convocatoria') ?>" >
          <i class="icon-eye-open"></i>
          vista preliminar de la convocatoria
        </a>
      </h6>
      
    </td>
    
    <td valign="top"> 
      
      <form id="form_agregar_eventos_sesion" action="agregarEventosALaConvocatoria" method="POST">
        <div id="info_aqui">Aquí se mostrará la agenda buscada!</div>
      </form>
      
    </td>    
  </tr>
</table>