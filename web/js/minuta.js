var cant_fotos = 0;

jQuery('document').ready(function()
{
  jQuery('#agregar_imagen').click(function()
  {
    cant_fotos++;
    
    campo = '<div id="imagen_agregada">\n\
         <hr>\n\
         <input type="text" class="span4" name="titulo_foto' + cant_fotos + '" placeholder="Indique el titulo" required /><br>\n\
         <input type="text" class="span6" name="sub_titulo_foto'+cant_fotos+'" placeholder="Indique el sub-titulo" /><br>\n\
         <input type="file" name="foto'+cant_fotos+'" required /></div>';

    jQuery('#imagen').append(campo);
    
    VerificarCantFotos();
    
    return false;
  });

  jQuery('#remover_imagen').click(function()
  {
    cant_fotos--;
    
    jQuery('#imagen_agregada:last-child').remove();
    
    VerificarCantFotos();

    return false;
  });
  
});

function VerificarCantFotos() {
  if (cant_fotos == 0)
    jQuery('#remover_imagen').hide();
  else
  {
    jQuery('#remover_imagen').show();
  }
}