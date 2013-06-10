<?php //use_javascript('convocatoria.js') ?>

<?php slot('title', 'SAF .::Nueva convocatoria::.') ?>

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
        <a href="prueba" >
          <i class="icon-eye-open"></i>
          ver la agenda de la<br>convocatoria (hasta ahora).
        </a>
      </h6>
      
    </td>
    
    <td valign="top"> 
      
      <form id="form_agregar_eventos_sesion" action="<?php echo url_for('') ?>" method="POST">
        <div id="info_aqui">Aquí se mostrará la agenda buscada!</div>
      </form>
      
    </td>    
  </tr>
</table>

<!--<br>
Fecha de la convocatoria:<br>
<input class="input-medium" type="date">
<input class="input-medium" type="time" value="09:00">
<input class="input-medium" type="time" value="11:59">

<br>
Asunto:<br>
<input class="input-xxlarge" type="text" placeholder="Convocatoria Reunión de Análisis de Fallas en la Red de Distribución">

<br>
Lugar:<br>
<input class="input-xxlarge" type="text" placeholder="Colegio de Ing. Santa Rosa. Piso 3. Ala Oeste">

<br>
Observacion:<br>
<textarea class="input-block-level" rows="4" placeholder=""></textarea>

<br>-->
