// require jQuery normally
const $ = require('jquery');
// create global $ and jQuery variables
global.$ = global.jQuery = $;
import 'jquery-confirm';

$('.deleteLink').click(function(){
    
    var nombre = $(this).data('nombreUsuario');
    var url = $(this).data('url');
    $.confirm({
        title: '¡Atencion!',
        type: 'red',
        content: '¿Eliminar el usuario '+nombre+'?',
        theme:'material',
        buttons: {
            confirmar: {
                text: 'Confirmar',
                btnClass: 'btn btn-success',
                action: function () {
                    window.location.href =  url;
                },
            },
            cancelar:{
                text: 'Cancelar',
                btnClass: 'btn btn-danger',
                action: function () {
                    
                },
            }        
        }
    });
});
