//-- Cuando el DOM esta listo...
//-- Hay un listener que se encargará de saber cuando se intente
//   ejecutar el submit del form, asi evitamos el uso del onclick()
//   dentro del html haciendo uso de HIJAX (JavaScript no obsructivo)...
//-- Se envia la peticion post a la accion indicada en el atributo action,
//   del formulario, se envia el formulario serializado y se obtiene los 
//   datos devueltos por dicha accion, imprimiendose en un selector del css.

jQuery('document').ready(function()
{
  jQuery('#form_filtrar').submit(function() 
  {
    jQuery('button[type="submit"]').hide();
    jQuery('#loader').show();
    jQuery.post(jQuery('#form_filtrar').attr('action'), jQuery('#form_filtrar').serialize(),
        function(datos_devueltos) {
          if (datos_devueltos) {
            jQuery('#info_aqui').html(datos_devueltos);
            jQuery('button[type="submit"]').show();
            jQuery('#loader').hide();
          }
        });

    return false;
  });
  
  jQuery('#form_agregar_eventos_sesion').submit(function() 
  {
    if (confirm("¿Realmente quieres agregar estos eventos a tu sesión?")){
      jQuery.post(jQuery('#form_agregar_eventos_sesion').attr('action'), 
      jQuery('#form_agregar_eventos_sesion').serialize(),
        function(datos_devueltos) {
          if (datos_devueltos) {
            jQuery('#info_aqui').html(datos_devueltos);
          }
        });      
    }
    return false;
  })
  
  jQuery('#form_agenda_guardar').submit(function() 
  {
    if (confirm("¿Desea continuar con el proceso de guardado?")){
      jQuery.post(jQuery('#form_agenda_guardar').attr('action'), 
      jQuery('#form_agenda_guardar').serialize(),
        function(datos_devueltos) {
          if (datos_devueltos) {
            jQuery('.sf_content').html(datos_devueltos);
          }
        });      
    }
    return false;
  })
  
});