jQuery('document').ready(function()
{
  jQuery('#form_buscar_agenda').submit(function() 
  {    
    jQuery('button[type="submit"]').hide();
    jQuery('#loader').show();
    jQuery.post(jQuery('#form_buscar_agenda').attr('action'), jQuery('#form_buscar_agenda').serialize(),
        function(datos_devueltos) {
          if (datos_devueltos) {            
            jQuery('#info_aqui').html(datos_devueltos);
            jQuery('button[type="submit"]').show();
            jQuery('#loader').hide();
            jQuery('#id_agenda').val('');
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
      return true;    
    }
    return false;
  })
  
});