var cant_fotos = 0;
var cant_razones = 0;
var cant_acciones_recomendaciones = 0;
var cant_compromisos = 0;
var cant_asistentes = 0;

function VerificarCant()
{
  if (cant_fotos == 0)
    jQuery('#remover_imagen').hide();

  if (cant_fotos > 0)
    jQuery('#remover_imagen').show();

  if (cant_razones == 0)
    jQuery('#remover_razon').hide();

  if (cant_razones > 0)
    jQuery('#remover_razon').show();

  if (cant_acciones_recomendaciones == 0)
  {
    jQuery('#remover_acciones').hide();
    jQuery('#agregar_acciones').show();
  }

  if (cant_acciones_recomendaciones > 0)
  {
    jQuery('#remover_acciones').show();
    jQuery('#agregar_acciones').hide();
  }

  if (cant_compromisos == 0)
    jQuery('#remover_compromiso').hide();

  if (cant_compromisos > 0)
    jQuery('#remover_compromiso').show();

  if (cant_asistentes == 0)
    jQuery('#remover_asistente').hide();

  if (cant_asistentes > 0)
    jQuery('#remover_asistente').show();
}

function Agregar(en, data, cant_respon)
{
  if (en == 'imagen')
  {
    campo = '<div id="imagen_agregada">\n\
              <input type="text" class="span5" name="titulo_foto' + cant_fotos + '" placeholder="Indique el titulo" required /><br>\n\
              <input type="text" class="span6" name="sub_titulo_foto' + cant_fotos + '" placeholder="Indique el sub-titulo" /><br>\n\
              <input type="file" name="foto' + cant_fotos + '" accept="image/png, image/gif, image/jpeg, image/jpg" required>\n\
             </div>';
    jQuery('#imagenes').append(campo);
  }

  if (en == 'razon')
  {
    campo = '<div id="razon_agregada">\n\
               <input type="text" class="span3" name="razon' + cant_razones + '" data-provide="typeahead" data-items="3" data-source=[' + data + '] autocomplete="off" placeholder="Indique razón" required />\n\
               <input type="number" class="span1" name="mva_razon' + cant_razones + '" placeholder="Cant" required/> MVAmin\n\
             </div>';

    jQuery('#razones').append(campo);
  }

  if (en == 'acciones')
  {
    campo = '<div id="accion_agregada">\n\
               <textarea name="acciones" class="input-block-level" rows="3" placeholder="Indique las acciones y recomendaciones" required></textarea>\n\
             </div>';

    jQuery('#acciones').append(campo);
  }

  if (en == 'compromiso')
  {
    var select = ' ';
    for (var i = 1; i <= cant_respon; i++)
    {
      select = select + '<select class="span3" name="responsable_compromiso' + cant_compromisos + i + '" required><option></option>' + data + '</select> ';
    }

    campo = '<div id="compromiso_agregado">\n\
               <small><b>Duración estimada del compromiso:</b></small>\n\
               <br><input name="f_duracion_estimada_comp' + cant_compromisos + '" type="datetime-local" required />\n\
               <textarea name="compromiso' + cant_compromisos + '" class="input-block-level" rows="3" placeholder="Indique el compromiso y luego los responsables" required></textarea> '
            + select +
            '</div>';

    jQuery('#compromisos').append(campo);
  }

  if (en == 'asistente')
  {
    campo = '<div id="asistente_agregado">\n\
                <input type="number" class="span2" name="ci_personal' + cant_asistentes + '" data-provide="typeahead" data-items="4" data-source=[' + data + '] autocomplete="off" placeholder="Indique Cédula ' + cant_asistentes + '" required />\n\
             </div>';

    jQuery('#asistentes').append(campo);
  }
}

jQuery('document').ready(function()
{
  cant_fotos = jQuery('#cant_fotos').val();
  cant_razones = jQuery('#cant_razones').val();
  cant_acciones_recomendaciones = jQuery('#cant_acciones').val();
  cant_compromisos = jQuery('#cant_compromisos').val();
  cant_asistentes = jQuery('#cant_asistentes').val();
  VerificarCant();

  jQuery('#agregar_imagen').click(function()
  {
    cant_fotos++;

    Agregar('imagen');

    VerificarCant();

    return false;
  });

  jQuery('#remover_imagen').click(function()
  {
    cant_fotos--;

    jQuery('#imagen_agregada:last-child').remove();

    VerificarCant();

    return false;
  });

  jQuery('#agregar_razon').click(function()
  {    
    $.ajax({
      type: "POST",
      url: "../../../razones_mvamin",
      data: {},
      success: function(respuesta) {
        if (respuesta)
        {
          cant_razones++;

          Agregar('razon', respuesta);

          VerificarCant();
        }
      }
    });

    return false;
  });

  jQuery('#remover_razon').click(function()
  {
    cant_razones--;

    jQuery('#razon_agregada:last-child').remove();

    VerificarCant();

    return false;
  });

  jQuery('#agregar_acciones').click(function()
  {
    Agregar('acciones');

    jQuery('#agregar_acciones').hide();

    jQuery('#remover_acciones').show();

    return false;
  });

  jQuery('#remover_acciones').click(function()
  {
    jQuery('#accion_agregada:last-child').remove();

    jQuery('#agregar_acciones').show();

    jQuery('#remover_acciones').hide();

    return false;
  });

  jQuery('#agregar_compromiso').click(function()
  {
    var cant = prompt('Ingrese la cantidad de responsables para el compromiso:', 1);

    if (!isNaN(cant) && cant != null && cant > 0)
    {
      $.ajax({
        type: "POST",
        url: "../../../unidad_equipo",
        data: {},
        success: function(respuesta) {
          if (respuesta)
          {
            cant_compromisos++;

            Agregar('compromiso', respuesta, cant);

            VerificarCant();
          }
        }
      });
    }
    else if (isNaN(cant))
      alert('Error:: No introdujo un valor númerico');
    else if (cant == 0)
      alert('Error:: Debe introducir al menos un responsable');

    return false;
  });

  jQuery('#remover_compromiso').click(function()
  {
    cant_compromisos--;

    jQuery('#compromiso_agregado:last-child').remove();

    VerificarCant();

    return false;
  });

  jQuery('#agregar_asistente').click(function()
  {
    $.ajax({
      type: "POST",
      url: "../personal",
      data: {},
      success: function(respuesta) {
        if (respuesta)
        {
          cant_asistentes++;

          Agregar('asistente', respuesta);

          VerificarCant();
        }
      }
    });

    return false;

  });

  jQuery('#remover_asistente').click(function()
  {
    cant_asistentes--;

    jQuery('#asistente_agregado:last-child').remove();

    VerificarCant();

    return false;
  });

  jQuery('#guardar_desarrollo_evento').submit(function()
  {
    if (confirm("¿Desea continuar con el proceso de guardado?")) {
      return true;
    }
    return false;
  });

  jQuery('#cancelar_proceso').click(function()
  {
    if (confirm("¿Desea CANCELAR el proceso de desarrollo?")) {
      return true;
    }
    return false;
  });

  jQuery('#guardar_minuta').submit(function()
  {
    if (cant_asistentes > 0)
    {
      if (confirm("¿Desea continuar con el proceso de guardado?"))
        return true;
    }
    else
      alert('Error:: No agregó ningún asistente.');
    
    return false;
  });
  
  jQuery('#terminar_minuta').click(function()
  {
    if (confirm("Al aceptar se terminará con el proceso de edición de la minuta. ¿Desea continuar?"))
      return true;
    
    return false;
  })
});

