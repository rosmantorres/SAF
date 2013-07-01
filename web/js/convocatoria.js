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
  
  jQuery('#form_agregar_eventos_convocatoria').submit(function() 
  {
    if (confirm("¿Realmente quieres agregar estos eventos a tu convocatoria?")){
      jQuery.post(jQuery('#form_agregar_eventos_convocatoria').attr('action'), 
      jQuery('#form_agregar_eventos_convocatoria').serialize(),
        function(datos_devueltos) {
          if (datos_devueltos) {
            jQuery('#info_aqui').html(datos_devueltos);
          }
        });      
    }
    return false;
  });
  
  jQuery('#form_guardar_convocatoria').submit(function() 
  {
    if (confirm("¿Desea continuar con el proceso de guardado?")){
      return true;    
    }
    return false;
  });
  
  jQuery('#realizar_comite').click(function()
  {
    if (confirm("¿Deseas comenzar con el CAF?")){
      return true;    
    }
    return false;
  });
  
  jQuery('#suspender_convocatoria').click(function()
  {
    if (confirm("La convocatoria se suspenderá por siempre. ¿Deseas continuar?")){
      var motivo = prompt('Motivo de la suspencion:');
      if (motivo != '' && motivo != null)
        document.location.href = $(this).val() + '&motivo=' + motivo;
      else
        alert('Error:: No introdujo ningun motivo para la convocatoria');
    }
    return false;
  })
});